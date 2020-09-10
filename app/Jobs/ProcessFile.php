<?php

namespace App\Jobs;

use App\Services\FileValidation;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPVideoToolkit\Config;
use PHPVideoToolkit\Image;
use PHPVideoToolkit\ImageFormat_Gif;
use PHPVideoToolkit\ImageFormat_Jpg;
use PHPVideoToolkit\Timecode;
use PHPVideoToolkit\Video;
use PHPVideoToolkit\VideoFormat;
use Symfony\Component\HttpFoundation\File\File;

class ProcessFile implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $tries = 1;

	public $timeout = 0;

	private $userId;
	private $file;
	private $originalFile;
	private $directory;
	/**
	 * @var array
	 */
	private $videoPaths;
	private $imagePaths;

	private $fileExtension;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($file, $userId, $originalFile, $directory)
	{
		$this->userId       = $userId;
		$this->originalFile = $originalFile;
		$this->directory    = $directory;

		$this->fileExtension = pathinfo(\storage_path('app/' . $this->originalFile), PATHINFO_EXTENSION);

		$this->videoPaths = [
			'original' => storage_path('app/' . $this->originalFile),
			'thumb'    => storage_path('app/files-to-process/' . $this->directory . '/thumbnail.jpeg'),
			'thumb-hd' => storage_path('app/files-to-process/' . $this->directory . '/thumbnail-hd.jpeg'),
			'hd'       => storage_path('app/files-to-process/' . $this->directory . '/transcoded-hd.mp4'),
			'sd'       => storage_path('app/files-to-process/' . $this->directory . '/transcoded-sd.mp4'),
		];
		$this->imagePaths = [
			'original' => storage_path('app/' . $this->originalFile),
			'thumb'    => storage_path('app/files-to-process/' . $this->directory . '/thumbnail.jpeg'),
			'hd'       => storage_path('app/files-to-process/' . $this->directory . '/hd.jpeg'),
			'sd'       => storage_path('app/files-to-process/' . $this->directory . '/sd.jpeg'),
		];

		$this->file = $file;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (app()->environment() === 'local') {
			$config = new Config([
				'ffmpeg'         => 'C:/ffmpeg/bin/ffmpeg.exe',
				'ffprobe'        => 'C:/ffmpeg/bin/ffprobe.exe',
				'temp_directory' => \storage_path('temp'),
			], true);
		}
		$filePath = \storage_path('app/' . $this->originalFile);
		$fileType = app(FileValidation::class)->fileType(\mime_content_type($filePath));

		//dump(\mime_content_type(\storage_path('app/' . $this->originalFile)));

		if ($fileType === 'image') {
			$imageInfo = getimagesize($filePath);

			if ($imageInfo === false) {
				throw new Exception('This isnt an image file...');
			}

			if ($imageInfo[2] === IMAGETYPE_GIF) {
				$this->handleGif();
			} else {
				$this->handleImage();
			}
			Storage::disk('processing')->deleteDirectory($this->directory);
		} elseif ($fileType === 'video') {
			$this->handleVideo();
		} else {
			$this->handleRegularFile();
			Storage::disk('processing')->deleteDirectory($this->directory);
		}

	}

	public function handleGif()
	{
		//Save HD original
		$image  = new Image($this->imagePaths['original']);
		$format = new ImageFormat_Gif();
		$format->setVideoFrameRate(12);

		$image->save($this->imagePaths['hd'], $format);

		//Save LD version
		$image      = new Image($this->imagePaths['original']);
		$format     = new ImageFormat_Gif();
		$format->setVideoFrameRate(12);
		$dimensions = $image->readDimensions();
		$format->setVideoDimensions($dimensions['width'] / 2, $dimensions['height'] / 2);
		$image->save($this->imagePaths['sd'], $format);

		//Save thumbnail
		$image      = new Image($this->imagePaths['original']);
		$format     = new ImageFormat_Jpg();
		$dimensions = $image->readDimensions();
		$format->setVideoDimensions($dimensions['width'] / 4, $dimensions['height'] / 4);
		$image->save($this->imagePaths['thumb'], $format);

		//Save files to minio storage
		Storage::cloud()->putFileAs($this->directory, new File($this->imagePaths['thumb']), 'thumb.jpeg', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->imagePaths['hd']), 'hd.gif', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->imagePaths['sd']), 'sd.gif', 'public');

		//Update the file information that is stored in the database
		$this->file->mime_type     = mime_content_type($this->imagePaths['hd']);
		$this->file->type          = app(FileValidation::class)->fileType($this->file->mime_type);
		$this->file->hd            = "{$this->directory}/hd.gif";
		$this->file->sd            = "{$this->directory}/sd.gif";
		$this->file->thumb         = "{$this->directory}/thumb.jpeg";
		$this->file->thumb_hd      = "{$this->directory}/hd.jpeg";
		$this->file->size_in_bytes = (filesize($this->imagePaths['hd']) + filesize($this->imagePaths['sd']) + filesize($this->imagePaths['thumb']));
		$this->file->status        = 'complete';
		$this->file->save();
	}

	public function handleImage()
	{
		//Save HD original
		$image  = new Image($this->imagePaths['original']);
		$format = new ImageFormat_Jpg();
		$image->save($this->imagePaths['hd'], $format);

		//Save LD version
		$image      = new Image($this->imagePaths['original']);
		$format     = new ImageFormat_Jpg();
		$dimensions = $image->readDimensions();
		$format->setVideoDimensions($dimensions['width'] / 2, $dimensions['height'] / 2);
		$image->save($this->imagePaths['sd'], $format);

		//Save thumbnail
		$image      = new Image($this->imagePaths['original']);
		$format     = new ImageFormat_Jpg();
		$dimensions = $image->readDimensions();
		$format->setVideoDimensions($dimensions['width'] / 4, $dimensions['height'] / 4);
		$image->save($this->imagePaths['thumb'], $format);

		//Save files to minio storage
		Storage::cloud()->putFileAs($this->directory, new File($this->imagePaths['thumb']), 'thumb.jpeg', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->imagePaths['hd']), 'hd.jpeg', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->imagePaths['sd']), 'sd.jpeg', 'public');

		//Update the file information that is stored in the database
		$this->file->mime_type     = mime_content_type($this->imagePaths['hd']);
		$this->file->type          = app(FileValidation::class)->fileType($this->file->mime_type);
		$this->file->hd            = "{$this->directory}/hd.jpeg";
		$this->file->sd            = "{$this->directory}/sd.jpeg";
		$this->file->thumb         = "{$this->directory}/thumb.jpeg";
		$this->file->thumb_hd      = "{$this->directory}/hd.jpeg";
		$this->file->size_in_bytes = (filesize($this->imagePaths['hd']) + filesize($this->imagePaths['sd']) + filesize($this->imagePaths['thumb']));
		$this->file->status        = 'complete';
		$this->file->save();
	}

	public function handleVideo()
	{

		$client = new \GuzzleHttp\Client();
		$client->post(env('APP_ENV') === 'local' ? 'http://127.0.0.1:3333/process' : 'https://processing.shotsaver.io/process', [
			'form_params' => [
				'directory' => $this->directory,
				'folder'    => \storage_path('app/files-to-process/' . $this->directory),
				'file'      => storage_path('app/' . $this->originalFile),
				'file_id'   => $this->file->id,
				'key'       => env('SECURE_KEY'),
			],
		]);

		return;


		$video = new Video($this->videoPaths['original']);

		$od = $video->getOptimalDimensions(1920, 1080);

		//Create transcoded 1920x1080 video
		$outputFormat = new VideoFormat();
		$outputFormat->setVideoFrameRate(30);
		$outputFormat->setAudioCodec('aac');
		$outputFormat->setVideoCodec('h264');
		$outputFormat->setAudioChannels(1);
		$outputFormat->setVideoBitrate(($od['padded_width'] * 1.5) + 500 . 'k');
		$outputFormat->setAudioBitrate('128k');
		$outputFormat->setVideoDimensions($od['padded_width'], $od['padded_height']);
		$video->save($this->videoPaths['hd'], $outputFormat);

		//Create 1920x1080 hd thumbnail
		$video        = new Video($this->videoPaths['hd']);
		$outputFormat = new VideoFormat();
		$od           = $video->getOptimalDimensions(1920, 1080);
		$outputFormat->setVideoDimensions($od['padded_width'], $od['padded_height']);
		$video->extractFrame(new Timecode(2))
			->save($this->videoPaths['thumb-hd'], $outputFormat);

		//Create 640x360 ld thumbnail
		$video        = new Video($this->videoPaths['hd']);
		$outputFormat = new VideoFormat();
		$od           = $video->getOptimalDimensions(640, 360);
		$outputFormat->setVideoDimensions($od['padded_width'], $od['padded_height']);
		$video->extractFrame(new Timecode(2))
			->save($this->videoPaths['thumb'], $outputFormat);


		//Create 1280x720 video (low def)
		$video        = new Video($this->videoPaths['hd']);
		$od           = $video->getOptimalDimensions(1280, 720);
		$outputFormat = new VideoFormat();
		$outputFormat->setVideoDimensions($od['padded_width'], $od['padded_height']);
		$outputFormat->setVideoBitrate(($od['padded_width'] * 1.5) + 500 . 'k');
		$video->save($this->videoPaths['sd'], $outputFormat);

		//Save files to minio storage
		Storage::cloud()->putFileAs($this->directory, new File($this->videoPaths['thumb']), 'thumb.jpeg', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->videoPaths['thumb-hd']), 'thumb-hd.jpeg', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->videoPaths['hd']), 'hd.mp4', 'public');
		Storage::cloud()->putFileAs($this->directory, new File($this->videoPaths['sd']), 'sd.mp4', 'public');

		//Update the file information that is stored in the database
		$this->file->mime_type     = mime_content_type($this->videoPaths['hd']);
		$this->file->type          = app(FileValidation::class)->fileType($this->file->mime_type);
		$this->file->extension     = $this->fileExtension;
		$this->file->hd            = "{$this->directory}/hd.mp4";
		$this->file->sd            = "{$this->directory}/sd.mp4";
		$this->file->thumb         = "{$this->directory}/thumb.jpeg";
		$this->file->thumb_hd      = "{$this->directory}/thumb-hd.jpeg";
		$this->file->size_in_bytes = ((filesize($this->videoPaths['hd']) + filesize($this->videoPaths['sd'])) + filesize($this->videoPaths['thumb']));
		$this->file->status        = 'complete';
		$this->file->save();

	}

	public function handleRegularFile()
	{
		$filePath = storage_path('app/' . $this->originalFile);

		$fileName = Str::random() . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

		$fileInfo = Storage::cloud()->putFileAs($this->directory, new File($filePath), $fileName, 'public');

		//dump($fileInfo);

		//Update the file information that is stored in the database
		$this->file->mime_type = mime_content_type($filePath);
		$this->file->extension = $this->fileExtension;
		$this->file->hd        = $fileInfo;
		/* $this->file->sd            = "{$this->directory}/sd.mp4";
		 $this->file->thumb         = "{$this->directory}/thumb.jpeg";
		 $this->file->thumb_hd      = "{$this->directory}/thumb-hd.jpeg";*/
		$this->file->size_in_bytes = filesize($filePath);
		$this->file->status        = 'complete';

		if ($codeInfo = app(FileValidation::class)->isCodeFile($this->fileExtension)) {
			$this->file->meta = $codeInfo;
			$this->file->type = 'code';
		} else {
			$this->file->type = app(FileValidation::class)->fileType($this->file->mime_type);
		}

		$this->file->save();

	}

	public function failed(Exception $exception)
	{

		$this->file->status = 'failed';
		$this->file->meta   = [
			'message' => $exception->getMessage(),
			'trace'   => $exception->getTrace(),
			'line'    => $exception->getLine(),
		];

		$this->file->save();
	}
}

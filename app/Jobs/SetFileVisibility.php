<?php

namespace App\Jobs;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Storage;

class SetFileVisibility implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $fileId;
	private $file;

	/**
	 * Create a new job instance.
	 *
	 * @param $fileId
	 */
    public function __construct($fileId)
    {
	    $this->fileId = $fileId;
	    $this->file   = File::find($fileId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	//Set the S3 visibility
        if($this->file->private) {
        	$this->file->setPrivate();
        } else {
        	$this->file->setPublic();
        }

		//Delete the temporary folder that was created to process the files...
	    Storage::disk('processing')->deleteDirectory($this->file->name);

        //Now we set the file as complete
        $this->file->status = 'complete';
        $this->file->save();

        //We're all done, dispatch the webhooks
	    dispatch(new SendWebhooks($this->file->id));
    }
}

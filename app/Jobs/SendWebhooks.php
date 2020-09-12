<?php

namespace App\Jobs;

use App\File;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWebhooks implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $fileId;
	/**
	 * @var File|null
	 */
	private $file;

	public $tries = 5;

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
		try {
			$user = User::whereId($this->file->user_id)->first();

			if($user->webhook_url === null)
			{
				return $this->delete();
			}
			$client = new \GuzzleHttp\Client();
			$url    = "{$user->webhook_url}?secret={$user->webhook_key}";
			$client->post($url, [
				'form_params' => [
					'fileInfo' => json_encode($this->file),
					'url'      => $this->file->file($this->file->hd ? 'hd' : 'sd'),
				],
			]);
		} catch(\Exception $exception) {
			\Log::error($exception->getMessage());
		}
	}
}

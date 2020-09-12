<?php

namespace App\Jobs;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWebhooks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $fileId;
	/**
	 * @var File|null
	 */
	private $file;

	/**
	 * Create a new job instance.
	 *
	 * @param $fileId
	 */
    public function __construct($fileId)
    {
	    $this->fileId = $fileId;
	    $this->file = File::find($fileId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}

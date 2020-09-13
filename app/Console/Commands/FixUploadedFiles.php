<?php

namespace App\Console\Commands;

use App\File;
use Illuminate\Console\Command;

class FixUploadedFiles extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'files:fix';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This command will set the file visibility correctly for all previously uploaded files';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{

		$bar = $this->output->createProgressBar(File::count());
		$bar->start();

		File::orderBy('id', 'desc')->chunk(100, function ($files) use ($bar) {
			foreach ($files as $file) {
				if ($file->private) {
					$file->setPrivate();
				} else {
					$file->setPublic();
				}
				$bar->advance();
			}

		});
	}
}

<?php

namespace App\Http\Controllers;

use App\File;
use App\Jobs\SendWebhooks;
use App\Jobs\SetFileVisibility;
use Illuminate\Http\Request;

class FileProcessing extends Controller
{
	/**
	 * This endpoint is called when node has completed/failed the processing
	 *
	 * Processing our webhooks in a job means that if they fail, we can retry x times
	 */
	public function callback()
	{
		if(!File::whereId(request('file_id'))->first())
			return response()->json(['message' => 'File not found.'], 404);

		dispatch(new SetFileVisibility(request('file_id')));
    }
}

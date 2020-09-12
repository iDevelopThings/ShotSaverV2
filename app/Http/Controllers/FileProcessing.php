<?php

namespace App\Http\Controllers;

use App\File;
use App\Jobs\SendWebhooks;
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
		if(!File::find(request('file_id')))
			return response()->json(['message' => 'File not found.'], 404);

		dispatch(new SendWebhooks(request('file_id')));
    }
}

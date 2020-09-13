<?php

namespace App\Http\Controllers;

use App\File;
use App\Jobs\SendWebhooks;
use App\Jobs\SetFileVisibility;
use Illuminate\Http\Request;

class FileProcessing extends Controller
{
	/**
	 * Instead of calling a job which will set our file visibility
	 * We're going to do it synchronously, since it glitches the frontend
	 * Before we're done with the node side, we'll call this endpoint do the final steps
	 * Otherwise our frontend bugs out... but it also makes sense
	 */
	public function finish()
	{
		$file = File::whereId(request('file_id'))->first();
		if(!$file)
			return response()->json(['message' => 'File not found.'], 404);

		$file->finishProcessing();

		return response()->json(['message' => 'Complete']);
	}

	/**
	 * This endpoint is called when node has completed/failed the processing
	 *
	 * Processing our webhooks in a job means that if they fail, we can retry x times
	 */
	public function callback()
	{
		if(!File::whereId(request('file_id'))->first())
			return response()->json(['message' => 'File not found.'], 404);


		//We're all done, dispatch the webhooks
		dispatch(new SendWebhooks(request('file_id')));

		return response()->json(['message' => 'Complete']);
    }
}

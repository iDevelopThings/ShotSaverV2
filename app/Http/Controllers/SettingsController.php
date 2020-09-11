<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function account()
    {
        return view('account-settings.account');
    }

    public function saveAccount()
    {
        $this->validate(request(), [
            'password' => 'required|confirmed|min:8',
        ]);

        $user = request()->user();

        $user->password = Hash::make(request('password'));
        $user->save();

        return back()->with('success', 'Successfully changed password.');
    }

    public function api()
    {
        return view('account-settings.api');
    }

    public function webhooks()
    {
        return view('account-settings.webhooks');
    }

    public function saveWebhooks()
    {
	    $this->validate(request(), [
		    'webhook_url' => 'nullable|active_url',
	    ]);

	    $user = request()->user();

	    $user->webhook_url = request('webhook_url');
	    if($user->webhook_url !== null && request()->has('webhook_key') && request('webhook_key') === null) {
	    	$user->webhook_key = \Str::random();
	    }
	    $user->save();

	    return back()->with('success', 'Successfully updated webhook url.');
    }

    public function uploadPreferences()
    {
        return view('account-settings.upload-preferences');
    }

    public function saveUploadPreferences()
    {
        $user = auth()->user();

        $private = request('private');
        $low_def_only = request('low_def_only');

        $user->low_def_only = ($private === null ? false : true);
        $user->private_uploads = ($low_def_only === null ? false : true);
        $user->save();

        return back();
    }
}

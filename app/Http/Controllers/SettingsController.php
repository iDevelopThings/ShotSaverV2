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

    public function uploadPreferences()
    {
        return view('account-settings.upload-preferences');
    }

    public function saveUploadPreferences()
    {
        $user = auth()->user();

        $private = request('private');

        $user->private_uploads = ($private === null ? false : true);
        $user->save();

        return back();
    }
}

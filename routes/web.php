<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/file/{file}', 'FileController@view')->name('view-file');
Route::get('/files/{file}/download', 'FileController@download')->name('download-file');

Route::middleware('auth')->group(function () {
    Route::get('/uploads', 'FileController@uploads')->name('home');
    Route::get('/favourites', 'FileController@favourites')->name('favourites');

    Route::post('/files/{file}/favourite', 'FileController@favouriteToggle')->name('favourite-file');
    Route::post('/files/{file}/edit', 'FileController@edit')->name('edit-file');

    Route::get('/settings/account', 'SettingsController@account')->name('settings.account');
    Route::post('/settings/account', 'SettingsController@saveAccount')->name('settings.save-account');
    Route::get('/settings/api', 'SettingsController@api')->name('settings.api');
    Route::get('/settings/webhooks', 'SettingsController@webhooks')->name('settings.webhooks');
    Route::post('/settings/webhooks', 'SettingsController@saveWebhooks')->name('settings.save-webhooks');
    Route::get('/settings/upload-preferences', 'SettingsController@uploadPreferences')->name('settings.upload-preferences');
    Route::post('/settings/upload-preferences', 'SettingsController@saveUploadPreferences')->name('settings.save-upload-preferences');
});

<?php

if (config('clara.install.route-available'))
{
    Route::group(['middleware' => 'web'], function()
    {
        Route::get('install', 'CeddyG\ClaraInstaller\Http\Controllers\InstallController@installBdd');
        Route::post('install', 'CeddyG\ClaraInstaller\Http\Controllers\InstallController@storeBdd');
    });
}
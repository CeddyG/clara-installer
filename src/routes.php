<?php

Route::get('install', 'CeddyG\ClaraInstaller\Http\Controllers\InstallController@installBdd');
Route::post('install', 'CeddyG\ClaraInstaller\Http\Controllers\InstallController@storeBdd');
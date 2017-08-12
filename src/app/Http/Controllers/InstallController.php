<?php

namespace App\Http\Controllers;

use App\Services\Clara\Installer\Install;
use App\Events\Installer\AfterInstallEvent;
use App\Events\Installer\BeforeInstallEvent;
use App\Http\Requests\InstallRequest;

class InstallController extends Controller
{
    public function installBdd()
    {
        $sPageTitle = 'Installation';
        
        return view('install', compact('sPageTitle'));
    }
    
    public function storeBdd(InstallRequest $oRequest)
    {
        try 
        {
            event(new BeforeInstallEvent());
            Install::storeBdd($oRequest->all());
            event(new AfterInstallEvent($oRequest->all()));
        }
        catch(\Exception $e)
        {
            return redirect('install')
                ->with('error', $e->getMessage())
                ->withInput();
        }
        
        return redirect('admin/entity');
    }
}

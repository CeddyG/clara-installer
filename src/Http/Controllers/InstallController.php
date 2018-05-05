<?php

namespace CeddyG\ClaraInstaller\Http\Controllers;

use CeddyG\ClaraInstaller\Install;
use App\Http\Controllers\Controller;
use CeddyG\ClaraInstaller\Events\AfterInstallEvent;
use CeddyG\ClaraInstaller\Events\BeforeInstallEvent;
use CeddyG\ClaraInstaller\Http\Requests\InstallRequest;

class InstallController extends Controller
{
    public function installBdd()
    {
        $sPageTitle = 'Installation';
        
        return view('clara-install::install', compact('sPageTitle'));
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

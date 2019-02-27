<?php

namespace CeddyG\ClaraInstaller\Listeners;

use App\Models\User;
use Sentinel;

class SentinelSubscriber
{
    public function validate($oEvent) 
    {
        app('CeddyG\ClaraSentinel\Http\Requests\UserRequest');
    }

    public function store($oEvent) 
    {
        self::storeAdmin($oEvent->aInputs);
    }
    
    private static function storeAdmin($aInputs)
    {
    	$iUserCount = User::count();

    	if($iUserCount == 0)
		{
			$oRole = self::storeAdminGroup();
		
		    $oUser = Sentinel::register($aInputs, true);
		    $oUser->roles()
			    ->attach($oRole);
		    $oUser->save();
		
		    self::connectionAdmin($aInputs, $aInputs);
		}
    }
    
    public static function storeAdminGroup()
    {
        //Add admin group
        $oRole = Sentinel::getRoleRepository()
            ->createModel()
            ->create(
                [
                    'name'  => 'Admin',
                    'slug'  => 'admin',
                ]
        );
            
        $oRole->addPermission('*')
            ->save();
        
        return $oRole;
    }
    
    private static function connectionAdmin($aCredentials, $aInputs)
    {
        $bRemember  = array_key_exists('remember', $aInputs);
        
        // Connect admin user
        Sentinel::authenticate($aCredentials, $bRemember);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $oEvent
     */
    public function subscribe($oEvent)
    {
        $oEvent->listen(
            'CeddyG\ClaraInstaller\Events\BeforeInstallEvent',
            'CeddyG\ClaraInstaller\Listeners\SentinelSubscriber@validate'
        );

        $oEvent->listen(
            'CeddyG\ClaraInstaller\Events\AfterInstallEvent',
            'CeddyG\ClaraInstaller\Listeners\SentinelSubscriber@store'
        );
    }

}

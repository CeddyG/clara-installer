<?php
namespace CeddyG\ClaraInstaller;

use Illuminate\Support\ServiceProvider;

use Event;
use CeddyG\ClaraInstaller\Listeners\SentinelSubscriber;

/**
 * Description of EntityServiceProvider
 *
 * @author CeddyG
 */
class InstallerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->publishesConfig();
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->publishesView();
        $this->publishesMigrations();
        
        Event::subscribe(SentinelSubscriber::class);
    }
	
	/**
	 * Publish config file.
	 * 
	 * @return void
	 */
	private function publishesConfig()
	{
		$sConfigPath = __DIR__ . '/../config/clara.install.php';
        if (function_exists('config_path')) 
		{
            $sPublishPath = config_path('clara.install.php');
        } 
		else 
		{
            $sPublishPath = base_path('config/clara.install.php');
        }
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara.install.config');
	}
    
    private function publishesView()
	{
        $sResources = __DIR__.'/../resources/views';

        $this->publishes([
            $sResources => resource_path('views/vendor/clara-install')
        ], 'clara.install.views');
        
        $this->loadViewsFrom($sResources, 'clara-install');
	}
    
    private function publishesMigrations()
    {
        $sMigration = realpath(__DIR__.'/database');

        $this->publishes([
            $sMigration => base_path().'/database'
        ], 'clara.install.migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.install.php', 'clara.install'
        );
    }
}

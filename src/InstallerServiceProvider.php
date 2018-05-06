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
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->publishesView();
        $this->publishesMigrations();
        
        Event::subscribe(SentinelSubscriber::class);
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
        //
    }
}

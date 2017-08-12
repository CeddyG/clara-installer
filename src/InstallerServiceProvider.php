<?php
namespace CeddyG\ClaraInstaller;

use Illuminate\Support\ServiceProvider;

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
        // Publish services
        $sApp = realpath(__DIR__.'/app');

        $this->publishes([
            $sApp => base_path().'/app',
        ], 'services');

        // Publish stubs
        $sResources = realpath(__DIR__.'/resources');

        $this->publishes([
            $sResources => base_path().'/resources',
        ], 'stubs');
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

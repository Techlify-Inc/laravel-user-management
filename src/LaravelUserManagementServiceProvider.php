<?php

namespace TechlifyInc\LaravelUserManagement;

use Illuminate\Support\ServiceProvider;

/**
 * Description of LaravelUserManagementServiceProvider
 *
 * @author 
 */
class LaravelUserManagementServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LaravelUserManagement::class, function ()
        {
            return new LaravelUserManagement();
        });

        $this->app->alias(LaravelUserManagement::class, 'laravel-user-management');
    }

}

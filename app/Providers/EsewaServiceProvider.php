<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nujan\Esewa\Esewa;

class EsewaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind the eSewa class to the service container
        $this->app->singleton(Esewa::class, function ($app) {
            return new Esewa();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish the eSewa configuration file
        $this->publishes([
            __DIR__ . '/../config/esewa.php' => config_path('esewa.php'),
        ]);
    }
}
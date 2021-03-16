<?php

namespace Bickyraj\Ssf;

use Illuminate\Support\ServiceProvider;

class SsfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'bickyraj');
        $this->publishes([
            __DIR__ . '/migrations' => base_path('database/migrations/'),
        ]);
    }
}

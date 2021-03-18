<?php

namespace BickyRaj\Ssf;

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
        $this->mergeConfigFrom(__DIR__ . '/config/api.php', 'ssf_api_url');
        $this->mergeConfigFrom(__DIR__ . '/config/auth.php', 'ssf_auth');
        // $this->app->singleton(Ssf::class, function ($app) {
        //     return new Ssf($app->make(Ssf::class));
        // });
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
        // $this->loadViewsFrom(__DIR__ . '/views', 'bickyraj');
        $this->publishes([
            __DIR__ . '/database/migrations' => base_path('database/migrations/'),
        ], 'migrations');
    }
}

<?php

namespace Dasim\LaravelLatte;

use Illuminate\Support\ServiceProvider;
use Latte;

class LatteProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('latte.engine', function ($app) {
            $latte = new Latte\Engine;
            $latte->setTempDirectory($app['config']['view.compiled']);
            return $latte;
        });
        $this->app->singleton('latte.globals', function ($app) {
            return new LatteGlobals;
        });

        $this->app->bind('view', function ($app) {
            return new LatteFactory($app);
        });
    }
}

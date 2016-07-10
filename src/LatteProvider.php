<?php

namespace wodCZ\LaravelLatte;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\FileViewFinder;
use Latte;

class LatteProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Application $app)
    {

        $view = $app['view'];
        $resolver = $app['view.engine.resolver'];

        $view->addExtension('latte', 'latte');

        $resolver->register('latte', function () use ($app) {
            return new LatteEngineBridge($app['latte.engine']);
        });

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

            $latte->setAutoRefresh($app['config']['app.debug']);
            $latte->setTempDirectory($app['config']['view.compiled']);
            return $latte;
        });

        # override view.finder as we need to register latte extension
        # would be replaced with extension registration in boot if view.finder is not registered with bind()
        $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];

            $fileViewFinder = new FileViewFinder($app['files'], $paths);
            $fileViewFinder->addExtension('latte');
            return $fileViewFinder;
        });

    }
}

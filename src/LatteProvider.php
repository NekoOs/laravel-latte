<?php

namespace NekoOs\LaravelLatte;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Latte;

class LatteProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public function register()
    {
        $this->app->singleton('latte.engine', function ($app) {
            $latte = new Latte\Engine;

            $latte->setAutoRefresh($app['config']['app.debug']);
            $latte->setTempDirectory($app['config']['view.compiled']);
            return $latte;
        });

        $this->app->resolving('view', function (Factory $viewFactory, Application $app) {

            if ($viewFactory instanceof \Illuminate\View\Factory) {
                $viewFactory->addExtension('latte', 'latte', function () use ($app) {
                    return new LatteEngineBridge($app['latte.engine']);
                });
            } else {
                throw new \InvalidArgumentException('Can\'t register Latte\Engine, ' . get_class($viewFactory) . ' view factory is not supported.');
            }
        });
    }
}

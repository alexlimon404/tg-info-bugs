<?php

namespace AlexLimon404\TgInfoBugs;

use Illuminate\Support\ServiceProvider;

class TgInfoBugsServiceProvider extends ServiceProvider
{
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['tg-info-bugs'];
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tg-info-bugs.php', 'tg-info-bugs');

        $this->app->bind('tg-info-bugs', function ($app) {
            return new TgInfoBugs($app['config']['tg-info-bugs']);
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/tg-info-bugs.php' => config_path('tg-info-bugs.php'),
            ], 'config');
        }
    }

}

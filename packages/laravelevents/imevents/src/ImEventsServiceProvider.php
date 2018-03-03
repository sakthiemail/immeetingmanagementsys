<?php

namespace Laravelevents\ImEvents;

use Illuminate\Support\ServiceProvider;

class ImEventsServiceProvider extends ServiceProvider
{

    protected $namespace = 'Laravelevents\ImEvents\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'imevents');
        $this->publishes([
            __DIR__.'/../migrations/' => base_path('/database/migrations'),
            __DIR__.'/views/' => base_path('resources/views/laravelevents/imevents'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['router']->group(['namespace' => $this->namespace], function () {
            require __DIR__.'/routes.php';
        });
    }
}

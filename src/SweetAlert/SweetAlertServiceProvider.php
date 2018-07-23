<?php

namespace UxWeb\SweetAlert;

use Illuminate\Support\ServiceProvider;

class SweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'UxWeb\SweetAlert\SessionStore',
            'UxWeb\SweetAlert\LaravelSessionStore'
        );

        $this->app->singleton('uxweb.sweet-alert', function () {
            return $this->app->make('UxWeb\SweetAlert\SweetAlertNotifier');
        });

        config([
            'config/sweet-alert.php',
        ]);
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'sweet');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/sweet'),
            __DIR__.'/../config/sweet-alert.php' => config_path('sweet-alert.php'),
        ]);
    }
}

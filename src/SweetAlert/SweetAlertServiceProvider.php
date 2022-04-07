<?php

namespace erfan\SweetAlert;

use Illuminate\Support\ServiceProvider;

class SweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'sweet');

        $this->publishes([
            __DIR__ . '/../config/sweet-alert.php' => config_path('sweet-alert.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/sweet'),
        ], 'views');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sweet-alert.php',
            'sweet-alert'
        );

        $this->app->bind(
            'erfan\SweetAlert\SessionStore',
            'erfan\SweetAlert\LaravelSessionStore'
        );

        $this->app->bind('erfan.sweet-alert', function () {
            return $this->app->make('erfan\SweetAlert\SweetAlertNotifier');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'erfan\SweetAlert\SessionStore',
            'erfan.sweet-alert',
        ];
    }
}

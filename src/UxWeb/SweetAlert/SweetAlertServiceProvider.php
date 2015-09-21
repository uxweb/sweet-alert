<?php

namespace UxWeb\SweetAlert;

use Illuminate\Support\ServiceProvider;

class SweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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

        $this->app->singleton('uxweb.sweet-alert', function() {
            return $this->app->make('UxWeb\SweetAlert\SweetAlertNotifier');
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('uxweb/sweetalert', 'sweet');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['uxweb.sweet-alert'];
    }
}

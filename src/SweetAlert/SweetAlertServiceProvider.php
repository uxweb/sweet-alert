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
            SessionStore::class,
            LaravelSessionStore::class
        );

        $this->app->singleton('uxweb.sweet-alert', function() {
            return $this->app->make(SweetAlertNotifier::class);
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'sweet');

        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/sweet-alert')
        ]);
    }
}

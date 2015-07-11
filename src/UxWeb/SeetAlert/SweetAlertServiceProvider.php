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
            $this->app->make(SweetAlertNotifier::class);
        });
    }
}

<?php

namespace Hackerff\LaravelCustomForm;

use Illuminate\Support\ServiceProvider;

class CustomFieldProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            \dirname(__DIR__) . '/config/favorite.php' => config_path('custom_form.php'),
        ], 'config');

        $this->publishes([
            \dirname(__DIR__) . '/migrations/' => database_path('migrations'),
        ], 'migrations');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(\dirname(__DIR__) . '/migrations/');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            \dirname(__DIR__) . '/config/custom_form.php',
            'custom_form'
        );
    }
}

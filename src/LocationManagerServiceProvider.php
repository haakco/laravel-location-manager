<?php

declare(strict_types=1);

namespace HaakCo\LocationManager;

use HaakCo\LocationManager\Console\Commands\CountryAdd;
use HaakCo\LocationManager\Console\Commands\CurrencyAdd;
use HaakCo\LocationManager\Console\Commands\TimezoneAddAll;
use Illuminate\Support\ServiceProvider;

class LocationManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'haakco');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'haakco');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/locationmanager.php', 'locationmanager');

        // Register the service the package provides.
        $this->app->singleton('locationmanager', function ($app) {
            return new LocationManager;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['locationmanager'];
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/locationmanager.php' => config_path('locationmanager.php'),
        ], 'locationmanager.config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'locationmanager.migrations');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/haakco'),
        ], 'locationmanager.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/haakco'),
        ], 'locationmanager.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/haakco'),
        ], 'locationmanager.views');*/

        // Registering package commands.
        $this->commands([CountryAdd::class, CurrencyAdd::class, TimezoneAddAll::class]);
    }
}

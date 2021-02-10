<?php

namespace Jubayed\GhEnvato;

use Illuminate\Support\ServiceProvider as ServiceProviderBase;

class GhEnvatoServiceProvider extends ServiceProviderBase
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'gh-envato');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'gh-envato');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
        if ($this->app->runningInConsole()) {

            // Publishing the config.
            $this->publishes([
                __DIR__.'/../config/gh-envato.php' => config_path('gh-envato.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/gh-envato'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/gh-envato'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/gh-envato'),
            ], 'lang');*/

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/gh-envato.php', 'gh-envato');
    }

}

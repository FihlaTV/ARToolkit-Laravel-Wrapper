<?php

namespace JapSeyz\ArToolkit;

use Illuminate\Support\ServiceProvider;

class ArToolkitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'artoolkit');
    }
}

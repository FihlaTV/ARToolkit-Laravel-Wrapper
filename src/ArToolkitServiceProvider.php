<?php

namespace JapSeyz\ARToolkit;

use Illuminate\Support\ServiceProvider;

class ARToolkitServiceProvider extends ServiceProvider
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

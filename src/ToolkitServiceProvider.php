<?php

namespace JapSeyz\Ar;

use Illuminate\Support\ServiceProvider;

class ToolkitServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__.'/../config/artoolkit.php', 'artoolkit');
    }
}

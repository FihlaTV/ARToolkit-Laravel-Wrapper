<?php

namespace JapSeyz\ArToolkit;

use Illuminate\Support\Facades\Facade;

class ArToolkitFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'artoolkit';
    }
}

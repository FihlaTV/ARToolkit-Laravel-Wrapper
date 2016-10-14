<?php

namespace JapSeyz\Ar;

use Illuminate\Support\Facades\Facade;

class ToolkitFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'toolkit';
    }
}

<?php

namespace Saverty\ErrorsHandling\Facades;

use Illuminate\Support\Facades\Facade;
class ErrorsHandling extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'errors_handling';
    }
}

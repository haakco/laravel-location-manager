<?php

namespace HaakCo\LocationManager\Facades;

use Illuminate\Support\Facades\Facade;

class LocationManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'LocationManager';
    }
}

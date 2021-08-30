<?php

declare(strict_types=1);

namespace HaakCo\LocationManager\Facades;

use Illuminate\Support\Facades\Facade;

class LocationManager extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'LocationManager';
    }
}

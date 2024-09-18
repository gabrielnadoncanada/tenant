<?php

namespace Devlense\FilamentTenant\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Devlense\FilamentTenant\FilamentTenant
 */
class FilamentTenant extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Devlense\FilamentTenant\FilamentTenant::class;
    }
}

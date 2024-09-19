<?php

namespace Devlense\FilamentTenant\Concerns;

use Filament\Facades\Filament;

trait HasTenant
{
    /**
     * Get the column name that references the tenant in the model.
     */
    public static function getTenantForeignKey(): string
    {
        return config('filament-tenant.relation_foreign_key');
    }

    /**
     * Get the tenant model class.
     *
     * @return string
     */
    public static function getTenantModelClass()
    {
        return config('filament-tenant.model', 'model');
    }

    /**
     * Get the current tenant instance from Filament.
     */
    public static function getCurrentTenant(): mixed
    {
        return \Filament\Facades\Filament::getTenant();
    }
}

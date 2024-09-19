<?php

namespace Devlense\FilamentTenant\Concerns;

use Filament\Facades\Filament;

trait Multitenancy
{
    protected static function bootMultiTenancy()
    {
        static::creating(function ($model) {
            $tenant = Filament::getTenant();

            if (is_null($model->{static::getTenantForeignKey()}) && $tenant !== null) {
                $model->{static::getTenantForeignKey()} = $tenant->id;
            }
        });

        if (Filament::getTenant() != null) {
            static::addGlobalScope('by_tenant', function (Builder $builder) {
                $builder->where(static::getTenantForeignKey(), Filament::getTenant()->id);
            });
        }
    }
}

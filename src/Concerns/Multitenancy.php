<?php

namespace Devlense\FilamentTenant\Concerns;

use Devlense\FilamentTenant\FilamentTenant;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;

trait Multitenancy
{
    protected static function bootMultiTenancy()
    {
        static::creating(function ($model) {
            $tenant = Filament::getTenant();

            if (is_null($model->{FilamentTenant::getTenantForeignKey()}) && $tenant !== null) {
                $model->{FilamentTenant::getTenantForeignKey()} = $tenant->id;
            }
        });

        if (Filament::getTenant() != null) {
            static::addGlobalScope('by_tenant', function (Builder $builder) {
                $builder->where(FilamentTenant::getTenantForeignKey(), Filament::getTenant()->id);
            });
        }
    }
}

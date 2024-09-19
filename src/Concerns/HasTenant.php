<?php

namespace Devlense\FilamentTenant\Concerns;

use Filament\Facades\Filament;

trait HasTenant
{
    /**
     * Get the column name that references the tenant in the model.
     */
    protected static function getTenantForeignKey(): string
    {
        return config('filament-tenant.relation_foreign_key');
    }

    /**
     * Get the tenant model class.
     *
     * @return string
     */
    protected static function getTenantModelClass()
    {
        return config('filament-tenant.model', 'model');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(static::getTenantModelClass(), static::getTenantForeignKey());
    }

    /**
     * Get the current tenant instance from Filament.
     */
    protected static function getCurrentTenant(): mixed
    {
        return Filament::getTenant();
    }

    /**
     * Automatically assign the tenant ID when creating the model.
     */
    protected static function bootHasTenancy()
    {
        static::creating(function ($model) {
            $tenant = static::getCurrentTenant();

            if (is_null($model->{static::getTenantForeignKey()}) && $tenant !== null) {
                $model->{static::getTenantForeignKey()} = $tenant->id;
            }
        });
    }
}

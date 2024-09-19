<?php

namespace Devlense\FilamentTenant\Concerns;

use Filament\Facades\Filament;

trait HasTenant
{
    /**
     * Get the column name that references the tenant in the model.
     *
     * @return string
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
        return config('filament-tenant.relation_table_name', 'model');
    }


    public function tenant(): BelongsTo
    {
        return $this->belongsTo(static::getTenantModelClass(), static::getTenantForeignKey());
    }

    /**
     * Get the current tenant instance from Filament.
     *
     * @return mixed
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

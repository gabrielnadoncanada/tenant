<?php

namespace Devlense\FilamentTenant;

class FilamentTenant {
    public static function getTenantModelClass()
    {
        return config('filament-tenant.model', 'model');
    }

    public static function getTenantForeignKey(): string
    {
        return config('filament-tenant.relation_foreign_key');
    }

}

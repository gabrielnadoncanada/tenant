<?php

namespace Devlense\FilamentTenant;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentTenantPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-tenant';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            Devlense\FilamentTenant\Resources\TenantResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}

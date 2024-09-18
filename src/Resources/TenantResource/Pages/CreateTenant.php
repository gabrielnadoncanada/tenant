<?php

namespace Devlense\FilamentTenant\Resources\TenantResource\Pages;

use Devlense\FilamentTenant\Resources\TenantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;
}

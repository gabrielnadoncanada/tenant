<?php

return [
    'table_name' => 'tenants',
    'relation_table_name' => 'tenant_user',
    'relation_foreign_key' => 'tenant_id',
    'model' => Devlense\FilamentTenant\Models\Tenant::class,
];

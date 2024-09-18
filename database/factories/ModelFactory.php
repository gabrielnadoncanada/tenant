<?php

namespace Devlense\FilamentTenant\Database\Factories;

use Bezhanov\Faker\ProviderCollectionHelper;
use Devlense\FilamentTenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    public function definition()
    {
        ProviderCollectionHelper::addAllProvidersTo($this->faker);

        return [
            Tenant::TITLE => $this->faker->company,
            Tenant::EMAIL => $this->faker->unique()->companyEmail,
        ];
    }
}

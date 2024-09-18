<?php

namespace Devlense\FilamentTenant\Database\Factories;

use App\Enums\Currency;
use App\Enums\MeasurementSystem;
use Devlense\FilamentTenant\Models\Tenant;
use Bezhanov\Faker\ProviderCollectionHelper;
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

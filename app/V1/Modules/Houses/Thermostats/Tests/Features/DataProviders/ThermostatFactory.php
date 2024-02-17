<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Tests\Features\DataProviders;

use App\V1\Modules\Houses\Owners\Tests\Features\DataProviders\OwnerFactory;
use App\V1\Modules\Houses\Thermostats\Domain\Models\Thermostat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThermostatFactory extends Factory
{
    protected $model = Thermostat::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'owner_id' => OwnerFactory::new(),
        ];
    }
}

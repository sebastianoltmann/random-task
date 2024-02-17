<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Tests\Features\DataProviders;

use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemperatureLogFactory extends Factory
{
    protected $model = TemperatureLog::class;

    public function definition(): array
    {
        return [
            'thermostat_id' => ThermostatFactory::new(),
            'temperature' => $this->faker->randomFloat(2, 0, 100),
            'logged_at' => $this->faker->dateTime,
        ];
    }
}

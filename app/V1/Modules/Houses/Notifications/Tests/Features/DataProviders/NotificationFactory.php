<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Tests\Features\DataProviders;

use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Owners\Tests\Features\DataProviders\OwnerFactory;
use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;
use App\V1\Modules\Houses\Thermostats\Tests\Features\DataProviders\TemperatureLogFactory;
use App\V1\Modules\Houses\Thermostats\Tests\Features\DataProviders\ThermostatFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        $owner = OwnerFactory::new()->create();
        
        return [
            'owner_id' => $owner->id,
            'status' => StatusEnum::INIT,
            'message' => $this->faker->text,
            'notifiable_type' => TemperatureLog::class,
            'notifiable_id' => TemperatureLogFactory::new()->for(
                ThermostatFactory::new()->create([
                    'owner_id' => $owner,
                ])
            ),
        ];
    }
}

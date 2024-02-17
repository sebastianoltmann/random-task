<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Tests\Features\UI\Http\Controllers\ThermostatTemperatureLogController;

use App\V1\Modules\Houses\Thermostats\Domain\Models\Thermostat;
use App\V1\Modules\Houses\Thermostats\Tests\Features\DataProviders\ThermostatFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreActionTest extends TestCase
{
    use DatabaseTransactions;

    private ThermostatFactory $thermostatFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thermostatFactory = $this->app->make(ThermostatFactory::class);
    }

    public function testStoreTemperatureLogWithoutNotification(): void
    {
        // given
        /** @var Thermostat $givenThermostat */
        $givenThermostat = $this->thermostatFactory->createOne();

        $givenDate = now();
        $givenTemperature = 20.5;

        $this->postJson(
            route('houses.thermostats.temperatureLog.store'),
            [
                'device_id' => $givenThermostat->id->toString(),
                'temperature' => $givenTemperature,
                'date' => $givenDate->getTimestamp(),
            ]
        )
            ->assertCreated()
            ->assertJson([
                'message' => __('thermostat::messages.temperature_log_created'),
            ]);

        $this->assertDatabaseHas('thermostat_temperature_logs', [
            'thermostat_id' => $givenThermostat->id,
            'temperature' => $givenTemperature,
            'logged_at' => $givenDate,
        ]);
    }

    public function testStoreTemperatureLogWithNotification(): void
    {
        // given
        /** @var Thermostat $givenThermostat */
        $givenThermostat = $this->thermostatFactory->createOne();

        $givenDate = now();
        $givenTemperature = config('houses.thermostats.notifications.mix_temperature') - 1;

        // when
        $this->postJson(
            route('houses.thermostats.temperatureLog.store'),
            [
                'device_id' => $givenThermostat->id->toString(),
                'temperature' => $givenTemperature,
                'date' => $givenDate->getTimestamp(),
            ]
        )
            ->assertCreated()
            ->assertJson([
                'message' => __('thermostat::messages.temperature_log_created'),
            ]);

        // then
        $this->assertDatabaseHas('thermostat_temperature_logs', [
            'thermostat_id' => $givenThermostat->id,
            'temperature' => $givenTemperature,
            'logged_at' => $givenDate,
        ]);

        $this->assertDatabaseCount('house_notifications', 1);
    }
}

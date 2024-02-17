<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Tests\Units\Domain\Aggregates;

use App\V1\Modules\Houses\Owners\Domain\Models\Owner;
use App\V1\Modules\Houses\Thermostats\Domain\Aggregates\TemperatureNotificationAggregate;
use App\V1\Modules\Houses\Thermostats\Domain\Events\InitThermostatNotificationEvent;
use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;
use App\V1\Modules\Houses\Thermostats\Domain\Models\Thermostat;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\Facades\Event;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

/**
 * @see TemperatureNotificationAggregate
 */
class TemperatureNotificationAggregateTest extends TestCase
{
    private ConfigRepository $configRepository;
    private EventDispatcher $eventDispatcher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configRepository = $this->createMock(ConfigRepository::class);
        $this->eventDispatcher = $this->createMock(EventDispatcher::class);

    }

    public function testDispatchCommandWhenTemperatureIsLessThenConfig()
    {
        Event::fake();

        $givenMinTemperature = 15;

        $givenOwner = new Owner([
            'id' => Uuid::uuid4(),
            'first_name' => 'Test',
            'last_name' => 'Test',
            'phone' => '+699122333',
            'email' => 'test@gmail.com',
        ]);

        $givenThermostat = new Thermostat([
            'id' => Uuid::uuid4(),
            'owner_id' => $givenOwner->id,
            'name' => 'test',
        ]);

        $givenThermostat->setRelation('owner', $givenOwner);

        $givenTemperatureLog = new TemperatureLog([
            'id' => Uuid::uuid4(),
            'thermostat_id' => $givenThermostat->id,
            'temperature' => 14,
        ]);

        $givenTemperatureLog->setRelation('thermostat', $givenThermostat);

        $this->configRepository->expects($this->once())
            ->method('get')
            ->willReturn($givenMinTemperature);

        $this->eventDispatcher->expects($this->once())
            ->method('dispatch');

        $aggregate = new TemperatureNotificationAggregate(
            $this->configRepository,
            $this->eventDispatcher,
        );

        $aggregate->storing($givenTemperatureLog);

        Event::dispatched(InitThermostatNotificationEvent::class);
    }

    public function testNotDispatchCommandWhenTemperatureIsLessThenConfig()
    {
        Event::fake();

        $givenMinTemperature = 15;

        $givenOwner = new Owner([
            'id' => Uuid::uuid4(),
            'first_name' => 'Test',
            'last_name' => 'Test',
            'phone' => '+699122333',
            'email' => 'test@gmail.com',
        ]);

        $givenThermostat = new Thermostat([
            'id' => Uuid::uuid4(),
            'owner_id' => $givenOwner->id,
            'name' => 'test',
        ]);

        $givenThermostat->setRelation('owner', $givenOwner);

        $givenTemperatureLog = new TemperatureLog([
            'id' => Uuid::uuid4(),
            'thermostat_id' => $givenThermostat->id,
            'temperature' => 16,
        ]);

        $givenTemperatureLog->setRelation('thermostat', $givenThermostat);

        $this->configRepository->expects($this->once())
            ->method('get')
            ->willReturn($givenMinTemperature);

        $aggregate = new TemperatureNotificationAggregate(
            $this->configRepository,
            $this->eventDispatcher,
        );

        $aggregate->storing($givenTemperatureLog);

        Event::assertNotDispatched(InitThermostatNotificationEvent::class);
    }
}

<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Tests\Units\Application\Commands\Handlers;

use App\V1\Modules\Houses\Thermostats\Application\Commands\Handlers\StoreTemperatureLogCommandHandler;
use App\V1\Modules\Houses\Thermostats\Application\Commands\StoreTemperatureLogCommand;
use App\V1\Modules\Houses\Thermostats\Domain\Models\Thermostat;
use App\V1\Modules\Houses\Thermostats\Infrastructure\Repositories\TemperatureLogRepository;
use App\V1\Modules\Houses\Thermostats\Infrastructure\Repositories\ThermostatRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class StoreTemperatureLogCommandHandlerTest extends TestCase
{
    private ThermostatRepository $thermostatRepository;
    private TemperatureLogRepository $temperatureLogRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thermostatRepository = $this->createMock(ThermostatRepository::class);
        $this->temperatureLogRepository = $this->createMock(TemperatureLogRepository::class);
    }

    public function testHandle(): void
    {
        // given
        $givenCommand = new StoreTemperatureLogCommand(
            Uuid::uuid4(),
            random_int(0, 100),
            now(),
        );

        $givenOwnerId = Uuid::uuid4();

        $givenThermostat = new Thermostat([
            'id' => $givenCommand->deviceId,
            'owner_id' => $givenOwnerId,
            'name' => 'test',
        ]);

        // then
        $this->thermostatRepository
            ->expects($this->once())
            ->method('getOneById')
            ->with($givenCommand->deviceId)
            ->willReturn($givenThermostat);

        $this->temperatureLogRepository
            ->expects($this->once())
            ->method('save');

        $handler = new StoreTemperatureLogCommandHandler(
            $this->thermostatRepository,
            $this->temperatureLogRepository
        );

        // when
        $handler->handle($givenCommand);
    }
}

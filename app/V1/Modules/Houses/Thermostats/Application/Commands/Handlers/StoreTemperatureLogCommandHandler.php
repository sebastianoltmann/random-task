<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Application\Commands\Handlers;

use App\V1\Core\Application\Command\CommandHandlerInterface;
use App\V1\Core\Application\Command\CommandInterface;
use App\V1\Modules\Houses\Thermostats\Application\Commands\StoreTemperatureLogCommand;
use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;
use App\V1\Modules\Houses\Thermostats\Infrastructure\Repositories\TemperatureLogRepository;
use App\V1\Modules\Houses\Thermostats\Infrastructure\Repositories\ThermostatRepository;

final readonly class StoreTemperatureLogCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ThermostatRepository $thermostatRepository,
        private TemperatureLogRepository $temperatureLogRepository
    ) {
    }

    /**
     * @param StoreTemperatureLogCommand $command
     */
    public function handle(CommandInterface $command): void
    {
        $thermostat = $this->thermostatRepository->getOneById($command->deviceId);

        $temperatureLog = new TemperatureLog([
            'thermostat_id' => $thermostat->id,
            'temperature' => $command->temperature,
            'logged_at' => $command->date,
        ]);

        $this->temperatureLogRepository->save($temperatureLog);
    }
}

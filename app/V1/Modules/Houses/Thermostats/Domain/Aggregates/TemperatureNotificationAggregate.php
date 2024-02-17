<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Aggregates;

use App\V1\Modules\Houses\Thermostats\Domain\Events\InitThermostatNotificationEvent;
use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;

final readonly class TemperatureNotificationAggregate
{
    public function __construct(
        private ConfigRepository $config,
        private EventDispatcher $dispatcher,
    ) {
    }

    public function storing(TemperatureLog $log): void
    {
        $minTemperature = $this->config->get('houses.thermostats.notifications.mix_temperature', 15);

        if ($log->temperature < $minTemperature) {
            $thermostat = $log->thermostat;

            $this->dispatcher->dispatch(
                new InitThermostatNotificationEvent(
                    $thermostat->owner,
                    $log,
                )
            );
        }
    }
}

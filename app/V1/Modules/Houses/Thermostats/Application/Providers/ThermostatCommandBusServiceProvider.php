<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Application\Providers;

use App\V1\Core\Application\Providers\CommandBusServiceProvider;
use App\V1\Modules\Houses\Notifications\Application\Commands\Handlers\StoreNotificationCommandHandler;
use App\V1\Modules\Houses\Notifications\Application\Commands\StoreNotificationCommand;
use App\V1\Modules\Houses\Thermostats\Application\Commands\Handlers\StoreTemperatureLogCommandHandler;
use App\V1\Modules\Houses\Thermostats\Application\Commands\StoreTemperatureLogCommand;

class ThermostatCommandBusServiceProvider extends CommandBusServiceProvider
{
    protected array $commands = [
        StoreTemperatureLogCommand::class => StoreTemperatureLogCommandHandler::class,
        StoreNotificationCommand::class => StoreNotificationCommandHandler::class,
    ];
}

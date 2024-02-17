<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats;

use App\V1\Core\Application\Providers\ModuleServiceProvider;
use App\V1\Modules\Houses\Thermostats\Application\Providers\ThermostatCommandBusServiceProvider;
use App\V1\Modules\Houses\Thermostats\Application\Providers\ThermostatEventServiceProvider;
use App\V1\Modules\Houses\Thermostats\Application\Providers\ThermostatRouteServiceProvider;

class ThermostatModuleServiceProvider extends ModuleServiceProvider
{
    public const MODULE_NAME = 'thermostat';

    public function moduleName(): string
    {
        return self::MODULE_NAME;
    }

    public function register(): void
    {
        parent::register();

        $this->app->register(ThermostatRouteServiceProvider::class);
        $this->app->register(ThermostatCommandBusServiceProvider::class);
        $this->app->register(ThermostatEventServiceProvider::class);
    }
}

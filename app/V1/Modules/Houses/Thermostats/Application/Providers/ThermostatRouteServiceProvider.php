<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Application\Providers;

use App\V1\Core\Application\Providers\RouteServiceProvider;
use App\V1\Modules\Houses\Thermostats\UI\Http\Controllers\ThermostatTemperatureLogController;
use Illuminate\Contracts\Routing\Registrar;

class ThermostatRouteServiceProvider extends RouteServiceProvider
{
    protected bool $prefix = false;

    protected function registerRoutes(Registrar $router): void
    {
        $router->post('temperature', [ThermostatTemperatureLogController::class, 'store'])
            ->name('houses.thermostats.temperatureLog.store');
    }
}

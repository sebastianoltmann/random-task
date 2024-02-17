<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Application\Providers;

use App\V1\Core\Application\Providers\EventServiceProvider;
use App\V1\Modules\Houses\Thermostats\Domain\Events\Subscribers\TemperatureLogSubscriber;

class ThermostatEventServiceProvider extends EventServiceProvider
{
    protected $subscribe = [
        TemperatureLogSubscriber::class,
    ];
}

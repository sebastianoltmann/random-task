<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Events\Subscribers;

use App\V1\Modules\Houses\Thermostats\Domain\Events\Listeners\CreateTemperatureNotificationListener;
use App\V1\Modules\Houses\Thermostats\Domain\Events\TemperatureLogHasBeenCreated;
use Illuminate\Contracts\Events\Dispatcher;

class TemperatureLogSubscriber
{
    public function subscribe(Dispatcher $dispatcher): void
    {
        $dispatcher->listen(
            TemperatureLogHasBeenCreated::class,
            CreateTemperatureNotificationListener::class
        );
    }
}

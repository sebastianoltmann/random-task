<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Events\Listeners;

use App\V1\Modules\Houses\Thermostats\Domain\Aggregates\TemperatureNotificationAggregate;
use App\V1\Modules\Houses\Thermostats\Domain\Events\TemperatureLogHasBeenCreated;

final readonly class CreateTemperatureNotificationListener
{
    public function __construct(
        private TemperatureNotificationAggregate $aggregate
    ) {
    }

    public function handle(TemperatureLogHasBeenCreated $event): void
    {
        $this->aggregate->storing($event->temperatureLog);
    }
}

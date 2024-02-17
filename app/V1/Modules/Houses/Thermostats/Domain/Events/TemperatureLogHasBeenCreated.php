<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Events;

use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;

final readonly class TemperatureLogHasBeenCreated
{
    public function __construct(
        public TemperatureLog $temperatureLog
    ) {
    }
}

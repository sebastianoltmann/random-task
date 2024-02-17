<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Infrastructure\Repositories;

use App\V1\Core\Infrastructure\Repositories\Eloquent\EloquentModelRepository;
use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;

/**
 * @extends EloquentModelRepository<TemperatureLog>
 */
class TemperatureLogRepository extends EloquentModelRepository
{
    public function model(): TemperatureLog
    {
        return new TemperatureLog();
    }
}

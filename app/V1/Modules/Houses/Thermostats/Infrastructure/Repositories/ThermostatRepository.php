<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Infrastructure\Repositories;

use App\V1\Core\Infrastructure\Repositories\Eloquent\EloquentModelRepository;
use App\V1\Modules\Houses\Thermostats\Domain\Models\Thermostat;

/**
 * @extends EloquentModelRepository<Thermostat>
 */
class ThermostatRepository extends EloquentModelRepository
{
    public function model(): Thermostat
    {
        return new Thermostat();
    }
}

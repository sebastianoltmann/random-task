<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Models;

use App\V1\Core\Domain\Models\Model;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;
use App\V1\Shared\Casts\UuidCast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property UuidInterface $owner_id
 * @property string $name
 * @property Owner $owner
 * @property Collection<TemperatureLog> $logs
 */
class Thermostat extends Model
{
    protected $fillable = [
        'owner_id', 'name',
    ];

    protected $casts = [
        'owner_id' => UuidCast::class,
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(TemperatureLog::class);
    }

    public function newCollection(array $models = []): ThermostatCollection
    {
        return new ThermostatCollection($models);
    }
}

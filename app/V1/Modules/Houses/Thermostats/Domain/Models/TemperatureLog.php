<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Models;

use App\V1\Core\Domain\Models\Model;
use App\V1\Modules\Houses\Notifications\Domain\Models\NotifiableInterface;
use App\V1\Modules\Houses\Thermostats\Domain\Events\TemperatureLogHasBeenCreated;
use App\V1\Shared\Casts\UuidCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Stringable;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property UuidInterface $thermostat_id
 * @property float $temperature
 * @property Carbon $logged_at
 * @property Thermostat $thermostat
 */
class TemperatureLog extends Model implements NotifiableInterface
{
    protected $table = 'thermostat_temperature_logs';

    protected $fillable = [
        'thermostat_id', 'temperature', 'logged_at',
    ];

    protected $casts = [
        'thermostat_id' => UuidCast::class,
        'logged_at' => 'datetime',
        'temperature' => 'float',
    ];

    protected $dispatchesEvents = [
        'created' => TemperatureLogHasBeenCreated::class,
    ];

    public function thermostat(): BelongsTo
    {
        return $this->belongsTo(Thermostat::class);
    }

    public function message(): Stringable
    {
        return new Stringable($this->getMessage());
    }

    private function getMessage(): string
    {
        return sprintf(
            "Attention! The temperature of the thermostat %s has dropped below the allowed value and now is %s degrees.",
            $this->thermostat->name,
            (string)$this->temperature
        );
    }
}

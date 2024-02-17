<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Models;

use App\V1\Core\Domain\Models\Model;
use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Events\NotificationHasBeenFailedEvent;
use App\V1\Modules\Houses\Notifications\Domain\Events\NotificationHasBeenSentEvent;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;
use App\V1\Modules\Houses\Thermostats\Domain\Models\TemperatureLog;
use App\V1\Shared\Casts\UuidCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property UuidInterface $owner_id
 * @property UuidInterface $notifiable_id
 * @property string $notifiable_type
 * @property StatusEnum $status
 * @property string $message
 * @property string|null $error_message
 * @property Carbon|null $sent_at
 * @property NotifiableInterface|TemperatureLog $notifiable
 * @property Owner $owner
 */
class Notification extends Model
{
    protected $table = 'house_notifications';

    protected $fillable = [
        'owner_id', 'notifiable_type', 'notifiable_id', 'status',
        'message', 'error_message', 'sent_at',
    ];

    protected $casts = [
        'owner_id' => UuidCast::class,
        'notifiable_id' => UuidCast::class,
        'status' => StatusEnum::class,
        'sent_at' => 'datetime',
    ];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public function isSent(): bool
    {
        return $this->status === StatusEnum::SENT;
    }

    public function isFailed(): bool
    {
        return $this->status === StatusEnum::ERROR;
    }

    public function setAsSent(): self
    {
        $this->fill([
            'status' => StatusEnum::SENT,
            'sent_at' => Carbon::now(),
        ]);

        event(new NotificationHasBeenSentEvent($this));

        return $this;
    }

    public function setAsFailed(string $errorMessage): self
    {
        $this->fill([
            'status' => StatusEnum::ERROR,
            'sent_at' => Carbon::now(),
            'error_message' => $errorMessage,
        ]);

        event(new NotificationHasBeenFailedEvent($this));

        return $this;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}

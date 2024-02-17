<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Events;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;

final readonly class NotificationHasBeenSentEvent
{
    public function __construct(
        public Notification $notification
    ) {
    }
}

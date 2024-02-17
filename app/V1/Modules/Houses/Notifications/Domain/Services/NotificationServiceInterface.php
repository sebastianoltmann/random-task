<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Services;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;

interface NotificationServiceInterface
{
    public function send(Notification $notification): void;
}

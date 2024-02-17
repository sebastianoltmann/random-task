<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Strategies;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;

class SmsNotifierStrategy implements NotifyStrategyInterface
{
    public function notify(Owner $owner, Notification $notification): void
    {
        // TODO: Implement notify() method.
    }
}

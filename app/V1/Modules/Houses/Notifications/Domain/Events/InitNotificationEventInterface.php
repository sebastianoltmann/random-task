<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Events;

use App\V1\Modules\Houses\Notifications\Domain\Models\NotifiableInterface;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;

interface InitNotificationEventInterface
{
    public function owner(): Owner;

    public function notifiable(): NotifiableInterface;
}

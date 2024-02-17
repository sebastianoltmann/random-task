<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\Domain\Events;

use App\V1\Modules\Houses\Notifications\Domain\Events\InitNotificationEventInterface;
use App\V1\Modules\Houses\Notifications\Domain\Models\NotifiableInterface;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;

final readonly class InitThermostatNotificationEvent implements InitNotificationEventInterface
{
    public function __construct(
        private Owner $owner,
        private NotifiableInterface $notifiable
    ) {
    }

    public function owner(): Owner
    {
        return $this->owner;
    }

    public function notifiable(): NotifiableInterface
    {
        return $this->notifiable;
    }
}


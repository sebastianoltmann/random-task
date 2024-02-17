<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Tests\Units\Domain\Services;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Domain\Services\NotificationService;
use App\V1\Modules\Houses\Notifications\Domain\Strategies\EmailNotifierStrategy;
use App\V1\Modules\Houses\Notifications\Domain\Strategies\SmsNotifierStrategy;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;
use Tests\TestCase;

/**
 * @see NotificationService
 */
class NotificationServiceTest extends TestCase
{
    public function testCheckExecutedAllGivenStrategies(): void
    {
        // given
        $notification = new Notification();
        $notification->setRelation('owner', new Owner());

        $emailNotifier = $this->createMock(EmailNotifierStrategy::class);
        $smsNotifier = $this->createMock(SmsNotifierStrategy::class);

        $emailNotifier->expects($this->once())
            ->method('notify')
            ->with($notification->owner, $notification);

        $smsNotifier->expects($this->once())
            ->method('notify')
            ->with($notification->owner, $notification);

        $service = new NotificationService($emailNotifier, $smsNotifier);

        $service->send($notification);
    }
}

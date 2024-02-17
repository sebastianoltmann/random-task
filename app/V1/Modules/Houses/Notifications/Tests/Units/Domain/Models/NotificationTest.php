<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Tests\Units\Domain\Models;

use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Events\NotificationHasBeenSentEvent;
use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * @see Notification
 */
class NotificationTest extends TestCase
{
    public function testSetAsSent(): void
    {
        Event::fake();

        $notification = new Notification();

        $notification->setAsSent();

        $this->assertEquals(StatusEnum::SENT, $notification->status);
        $this->assertNotNull($notification->sent_at);

        Event::dispatched(NotificationHasBeenSentEvent::class);
    }

    public function testSetAsFailed(): void
    {
        $givenErrorMessage = 'error message';

        $notification = new Notification();

        $notification->setAsFailed($givenErrorMessage);

        $this->assertEquals(StatusEnum::ERROR, $notification->status);
        $this->assertNotNull($notification->sent_at);
        $this->assertEquals($givenErrorMessage, $notification->error_message);
    }
}

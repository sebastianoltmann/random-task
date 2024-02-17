<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Tests\Units\Domain\Strategies;

use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Domain\Strategies\EmailNotifierStrategy;
use App\V1\Modules\Houses\Notifications\Infrastructure\Repositories\NotificationRepository;
use App\V1\Modules\Houses\Owners\Tests\Features\DataProviders\OwnerFactory;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Mail\MailManager;
use Tests\TestCase;

class EmailNotifierStrategyTest extends TestCase
{
    private ConfigRepository $configRepository;
    private MailManager $mailManager;
    private NotificationRepository $notificationRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ownerFactory = $this->app->make(OwnerFactory::class);

        $this->configRepository = $this->createMock(ConfigRepository::class);
        $this->notificationRepository = $this->createMock(NotificationRepository::class);

        $this->mailManager = $this->getMockBuilder(MailManager::class)
            ->disableOriginalConstructor()
            ->addMethods(['send'])
            ->getMock();
    }

    public function testSuccessfullyNotify(): void
    {
        //given
        $owner = $this->ownerFactory->make();

        $notification = new Notification([
            'message' => 'Test message',
            'owner_id' => $owner->id,
        ]);
        $notification->setRelation('owner', $owner);

        $this->configRepository->expects($this->exactly(2))
            ->method('get')
            ->willReturn('');

        $this->mailManager->expects($this->once())
            ->method('send');

        // when
        $strategy = new EmailNotifierStrategy(
            $this->configRepository,
            $this->mailManager,
            $this->notificationRepository
        );

        $strategy->notify($owner, $notification);

        //then
        $this->assertTrue($notification->isSent());
        $this->assertEquals(StatusEnum::SENT, $notification->status);
        $this->assertEquals(null, $notification->error_message);
        $this->assertNotNull($notification->sent_at);
    }

    public function testErrorOnSendingNotification(): void
    {
        //given
        $owner = $this->ownerFactory->make();

        $notification = new Notification([
            'message' => 'Test message',
            'owner_id' => $owner->id,
        ]);
        $notification->setRelation('owner', $owner);

        $exception = new \Exception('Test exception');

        $this->configRepository->expects($this->exactly(2))
            ->method('get')
            ->willReturn('');

        $this->mailManager->expects($this->once())
            ->method('send')
            ->willThrowException($exception);

        // when
        $strategy = new EmailNotifierStrategy(
            $this->configRepository,
            $this->mailManager,
            $this->notificationRepository
        );

        $strategy->notify($owner, $notification);

        //then
        $this->assertTrue($notification->isFailed());
        $this->assertEquals(StatusEnum::ERROR, $notification->status);
        $this->assertEquals($exception->getMessage(), $notification->error_message);
        $this->assertNotNull($notification->sent_at);
    }
}

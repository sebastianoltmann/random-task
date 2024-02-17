<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Tests\Features\UI\CLI\Commands;

use App\V1\Modules\Houses\Notifications\Domain\Enums\StatusEnum;
use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Tests\Features\DataProviders\NotificationFactory;
use App\V1\Modules\Houses\Notifications\UI\CLI\Commands\SendingNotificationCommand;
use App\V1\Modules\Houses\Thermostats\Tests\Features\DataProviders\TemperatureLogFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SendingNotificationCommandTest extends TestCase
{
    use DatabaseTransactions;

    private NotificationFactory $notificationFactory;
    private TemperatureLogFactory $temperatureLogFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->notificationFactory = $this->app->make(NotificationFactory::class);
    }

    public function testHandle(): void
    {
        /** @var Notification $notification */
        $this->notificationFactory->createOne();

        $this->artisan(SendingNotificationCommand::class)
            ->assertSuccessful();

        $this->assertDatabaseHas('house_notifications', [
            'status' => StatusEnum::SENT,
        ]);
    }
}

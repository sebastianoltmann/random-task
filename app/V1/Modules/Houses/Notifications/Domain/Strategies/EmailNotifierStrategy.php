<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Strategies;

use App\V1\Modules\Houses\Notifications\Domain\Models\Notification;
use App\V1\Modules\Houses\Notifications\Domain\Strategies\Emails\NotificationEmail;
use App\V1\Modules\Houses\Notifications\Infrastructure\Repositories\NotificationRepository;
use App\V1\Modules\Houses\Owners\Domain\Models\Owner;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\MailManager;
use Throwable;

class EmailNotifierStrategy implements NotifyStrategyInterface
{
    public function __construct(
        private readonly ConfigRepository $configRepository,
        private readonly MailManager $mailManager,
        private readonly NotificationRepository $notificationRepository
    ) {
    }

    public function notify(Owner $owner, Notification $notification): void
    {
        $email = new NotificationEmail();

        $from = new Address(
            $this->configRepository->get('mail.from.address'),
            $this->configRepository->get('mail.from.name')
        );

        $to = new Address($owner->email->value(), $owner->full_name);

        $envelope = (new Envelope())
            ->from($from)
            ->to($to);

        $email->setEnvelope($envelope)
            ->setContent(new Content(
                htmlString: $notification->message
            ));

        try {
            $this->mailManager->send($email);

            $notification->setAsSent();
        } catch (Throwable $e) {
            $notification->setAsFailed($e->getMessage());
        }

        $this->notificationRepository->save($notification);
    }
}

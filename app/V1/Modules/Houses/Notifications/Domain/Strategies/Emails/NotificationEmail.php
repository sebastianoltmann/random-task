<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Notifications\Domain\Strategies\Emails;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable implements ShouldQueue
{
    use SerializesModels;

    private Envelope $envelope;
    private Content $content;

    public function setContent(Content $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function setEnvelope(Envelope $envelope): self
    {
        $this->envelope = $envelope;

        return $this;
    }

    public function envelope(): Envelope
    {
        return $this->envelope;
    }
}

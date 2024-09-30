<?php

namespace App\Mail;

use App\Models\UserInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class UserInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private UserInvitation $invitation)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            subject: 'Invitation pour rejoindre la Fresque du Bénévolat',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $acceptUrl = URL::signedRoute(
            'filament.app.invitation',
            [
                'token' => $this->invitation->code,
            ],
        );

        ray($acceptUrl);

        return new Content(
            markdown: 'mail.auth.user-invitation',
            with: [
                'acceptUrl' => $acceptUrl,
            ],
        );
    }
}

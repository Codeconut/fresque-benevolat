<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnimatorHasAcceptedInvitation extends Notification implements ShouldQueue
{
    use Queueable;

    public string $tag = 'user-animator-has-accepted-invitation';

    /**
     * Create a new notification instance.
     */
    public function __construct() {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Bienvenue dans l’équipe des animateurs de la Fresque du Bénévolat ! ')
            ->markdown('mail.animator.animator-has-accepted-invitation', [
                'url' => route('filament.admin.pages.dashboard'),
                'notifiable' => $notifiable,
            ])
            ->tag($this->tag);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\Fresque;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FresqueApplicationCreated extends Notification
{
    use Queueable;

    public $tag;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Fresque $fresque)
    {
        $this->tag = 'fresque-application-created';
    }

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
            ->subject('Votre inscription à la fresque du bénévolat du ' . $this->fresque->full_date . ' est validée 🥳')
            ->markdown('mail.fresque-application.created', [
                'url' =>  route('fresques.show', ['fresque' => $this->fresque]),
                'fresque' => $this->fresque,
                'notifiable' => $notifiable
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

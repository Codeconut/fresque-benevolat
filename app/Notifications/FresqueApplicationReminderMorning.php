<?php

namespace App\Notifications;

use App\Models\Fresque;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FresqueApplicationReminderMorning extends Notification implements ShouldQueue
{
    use Queueable;

    public $tag;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->tag = 'fresque-application-reminder-morning';
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
        $fresque = $notifiable->fresque;
        $fresqueDate = Carbon::parse($fresque->date)->translatedFormat('d F Y');

        return (new MailMessage)
            ->subject('La Fresque du Bénévolat, c’est aujourd’hui ✌🏻')
            ->markdown('mail.fresque-application.reminder-morning', [
                'url' =>  route('fresques.show', ['fresque' => $fresque]),
                'fresque' => $fresque,
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

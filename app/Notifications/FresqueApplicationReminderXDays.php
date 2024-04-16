<?php

namespace App\Notifications;

use App\Models\Fresque;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FresqueApplicationReminderXDays extends Notification implements ShouldQueue
{
    use Queueable;

    public $tag;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Fresque $fresque)
    {
        $this->tag = 'fresque-application-reminder-x-days';
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

        $diffInDays = floor(abs(Carbon::parse($this->fresque->date)->diffInDays()));

        return (new MailMessage)
            ->subject('La fresque du bénévolat, c’est dans ' . $diffInDays . ' jours !')
            ->markdown('mail.fresque-application.reminder-x-days', [
                'url' =>  route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable]),
                'fresque' => $this->fresque,
                'notifiable' => $notifiable,
                'diffInDays' => $diffInDays,
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

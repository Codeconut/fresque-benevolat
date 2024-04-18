<?php

namespace App\Notifications;

use App\Models\Fresque;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ActionsBlock;
use Illuminate\Notifications\Slack\SlackMessage;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;

class FresqueApplicationConfirmPresence extends Notification implements ShouldQueue
{
    use Queueable;

    public $tag;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Fresque $fresque)
    {
        $this->tag = 'fresque-application-confirm-presence';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     $fresqueDate = Carbon::parse($this->fresque->date)->translatedFormat('d F Y');

    //     return (new MailMessage)
    //         ->subject('Votre inscription à la fresque du bénévolat du ' . $fresqueDate . ' est validée 🥳')
    //         ->markdown('mail.fresque-application.created', [
    //             'url' =>  route('fresques.show', ['fresque' => $this->fresque]),
    //             'fresque' => $this->fresque,
    //             'notifiable' => $notifiable
    //         ])
    //         ->tag($this->tag);
    // }

    public function toSlack(object $notifiable): SlackMessage
    {
        $context = $notifiable->fresque->full_date . ' à ' . $notifiable->fresque->place->city . ' - ' . $notifiable->fresque->place->name;

        return (new SlackMessage)
            ->sectionBlock(function (SectionBlock $block) use ($notifiable) {
                $block->text('*' . $notifiable->full_name . '* a confirmé sa présence à la fresque du bénévolat ! 👊')->markdown();
            })
            ->contextBlock(function (ContextBlock $block) use ($context) {
                $block->text($context)->markdown();
            });
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

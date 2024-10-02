<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

class NotificationManualExecuted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private string $object, private string $to)
    {
        //
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

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->sectionBlock(function (SectionBlock $block) {
                $block->text('*'.auth()->user()->name.'* a envoyé une notification manuelle à '.$this->to.' ! 📩')->markdown();
            })
            ->contextBlock(function (ContextBlock $block) {
                $block->text($this->object);
            });
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;

class TaskSchedulingExecuted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private string $object, private int $count)
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
            ->sectionBlock(function (SectionBlock $block) use ($notifiable) {
                if ($this->count === 1) {
                    $block->text('*' . $this->count . '* notification a été envoyée ! 📩')->markdown();
                } else {
                    $block->text('*' . $this->count . '* notifications ont été envoyées ! 📩')->markdown();
                }
            })
            ->contextBlock(function (ContextBlock $block) {
                $block->text($this->object)->markdown();
            });
    }
}

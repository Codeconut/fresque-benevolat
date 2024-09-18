<?php

namespace App\Notifications;

use App\Models\Fresque;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

class FresqueCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user, public Fresque $fresque)
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
                $block->text('*'.$this->user->name.'* a créé une nouvelle fresque du bénévolat ! 💥')->markdown();
            })
            ->contextBlock(function (ContextBlock $block) {
                $block->text($this->fresque->full_date.' à '.$this->fresque->place->city.' ('.$this->fresque->place->name.')');
            });
    }
}

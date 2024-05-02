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

class FresqueApplicationPostFresqueEngagementUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $tag;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->tag = 'fresque-application-post-fresque-engagement';
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
        $context = $notifiable->fresque->full_date . ' à ' . $notifiable->fresque->place->city . ' - ' . $notifiable->fresque->place->name;

        return (new SlackMessage)
            ->sectionBlock(function (SectionBlock $block) use ($notifiable) {
                switch ($notifiable->post_fresque_engagement) {
                    case 'yes':
                        $block->text('*' . $notifiable->full_name . '* a réalisé une mission d’engagement ! 🔥')->markdown();
                        break;
                    case 'no_but_soon':
                        $block->text('*' . $notifiable->full_name . '* va bientôt réaliser une mission d’engagement ! C’est en bonne voie 👊')->markdown();
                        break;
                    case 'not_yet':
                        $block->text('*' . $notifiable->full_name . '* n’a pas encore réalisé une mission d’engagement ! 😥')->markdown();
                        break;
                }
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

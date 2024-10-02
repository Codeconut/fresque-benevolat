<?php

namespace App\Filament\Actions;

use App\Notifications\NotificationManualExecuted;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Notification as FacadeNotification;

class FresqueApplicationSendMail extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'fresque-application-send-mail';
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Define the action's name and label
        $this->label('Notifier')
            ->icon('heroicon-o-envelope')
            ->modalHeading(fn ($record) => "Envoyer une notification à $record->full_name")
            ->modalSubmitActionLabel('Envoyer')
            ->action(function (array $data, $record) {

                if (! auth()->user()->hasRole('admin')) {
                    abort(403, 'Vous n\'avez pas les droits pour effectuer cette action');
                }

                // Send the mail logic based on the selected mail type
                $mailType = $data['mail_type'];

                // Here you would send your email, for now we will just send a notification
                switch ($mailType) {
                    case 'fresque-application-created':
                        $record->notify(new \App\Notifications\FresqueApplicationCreated);
                        break;
                    case 'fresque-application-reminder-x-days':
                        $record->notify(new \App\Notifications\FresqueApplicationReminderXDays);
                        break;
                    case 'fresque-application-reminder-morning':
                        $record->notify(new \App\Notifications\FresqueApplicationReminderMorning);
                        break;
                    case 'fresque-application-feedback-j-3':
                        $record->notify(new \App\Notifications\FresqueApplicationFeedbackJ3);
                        break;
                    case 'fresque-application-feedback-s-3':
                        $record->notify(new \App\Notifications\FresqueApplicationFeedbackS3);
                        break;
                    case 'fresque-application-feedback-s-6':
                        $record->notify(new \App\Notifications\FresqueApplicationFeedbackS6);
                        break;
                    case 'fresque-application-feedback-s-12':
                        $record->notify(new \App\Notifications\FresqueApplicationFeedbackS12);
                        break;
                    default:
                        abort(404, 'Notification not found');
                }

                $options = $this->getOptions();

                FacadeNotification::route('slack', config('services.slack.notifications.channel'))
                    ->notify(new NotificationManualExecuted($options[$mailType], $record->full_name));

                Notification::make()
                    ->title('Notification envoyée !')
                    ->body("La notification a bien été envoyée à $record->full_name.")
                    ->success()
                    ->send();
            });

        // Define the form fields (the select list)
        $this->form([
            Forms\Components\Select::make('mail_type')
                ->label('Sélectionner le template de mail')
                ->options($this->getOptions())
                ->required(),
        ]);
    }

    protected function getOptions(): array
    {
        return [
            'fresque-application-created' => 'Ton inscription à la fresque du bénévolat du XX est validée 🥳',
            'fresque-application-reminder-x-days' => '[J-2] La fresque du bénévolat, c’est dans 2 jours !',
            'fresque-application-reminder-morning' => '[J-0] La Fresque du Bénévolat, c’est aujourd’hui ✌🏻',
            'fresque-application-feedback-j-3' => '[J+3] 🧩 Fresque du Bénévolat : Et après ? Ton guide mémo dans ce mail',
            'fresque-application-feedback-s-3' => '[S+3], comment se passe ton parcours bénévole ? 💁🏻',
            'fresque-application-feedback-s-6' => '[S+6] XX, quelles sont les nouvelles depuis ta dernière Fresque du Bénévolat ?',
            'fresque-application-feedback-s-12' => '[S+12] XX, quelles sont les nouvelles depuis ta dernière Fresque du Bénévolat ?',
        ];
    }
}

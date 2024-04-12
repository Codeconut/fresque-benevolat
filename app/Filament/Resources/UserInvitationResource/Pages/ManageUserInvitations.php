<?php

namespace App\Filament\Resources\UserInvitationResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Models\UserInvitation;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\UserInvitationResource;

class ManageUserInvitations extends ManageRecords
{
    protected static string $resource = UserInvitationResource::class;

    protected static ?string $title = 'Invitations';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false)
                ->mutateFormDataUsing(function (array $data): array {
                    $data['code'] = substr(md5(rand(0, 9) . $data['email'] . time()), 0, 32);;
                    return $data;
                })
                ->before(function (Actions\CreateAction $action, array $data) {
                    $user = User::where('email', $data['email'])->first();
                    if ($user) {
                        Notification::make()
                            ->danger()
                            ->title('L\'utilisateur existe déjà')
                            ->body('Cet email a déjà été utilisé pour un utilisateur sur la plateforme')
                            ->persistent()
                            ->send();

                        $action->halt();
                    }
                })
                ->after(function (UserInvitation $record) {
                    Mail::to($record->email)->send(new UserInvitationMail($record));
                })
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Invitation envoyée')
                        ->body('Une invitation par e-mail a été envoyée avec succès à l\'utilisateur'),
                ),
        ];
    }
}

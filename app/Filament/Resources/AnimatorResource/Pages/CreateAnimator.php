<?php

namespace App\Filament\Resources\AnimatorResource\Pages;

use App\Filament\Resources\AnimatorResource;
use App\Mail\UserInvitationMail;
use App\Models\UserInvitation;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateAnimator extends CreateRecord
{
    protected static string $resource = AnimatorResource::class;

    public function getTitle(): string
    {
        return 'Ajouter un animateur';
    }

    public function getRelationManagers(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCreateAndInviteFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Ajouter')
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function getCreateAndInviteFormAction(): Action
    {
        return Action::make('create_invite')
            ->label('Ajouter & inviter')
            ->requiresConfirmation()
            ->action('createAndInvite');
    }

    public function createAndInvite(): void
    {

        $formData = $this->form->getState();

        $this->create();

        $userInvitation = UserInvitation::create([
            'email' => $formData['email'],
            'code' => substr(md5(rand(0, 9).$formData['email'].time()), 0, 32),
            'role' => 'animator',
        ]);

        Mail::to($formData['email'])->send(new UserInvitationMail($userInvitation));

        Notification::make()
            ->success()
            ->title('Invitation envoyée')
            ->body('Une invitation par e-mail a été envoyée avec succès à l\'animateur');

    }
}

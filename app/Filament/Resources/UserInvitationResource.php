<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserInvitationResource\Pages;
use App\Mail\UserInvitationMail;
use App\Models\UserInvitation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class UserInvitationResource extends Resource
{
    protected static ?string $model = UserInvitation::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Paramètres';

    protected static ?string $navigationLabel = 'Invitations';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->rules('iunique:user_invitations,email')
                    ->required()
                    ->autofocus(),
                Forms\Components\Select::make('role')
                    ->required()
                    ->options([
                        'admin' => 'Admin',
                        'animator' => 'Animator',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d M Y à H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('resend')
                    ->label('Renvoyer')
                    ->icon('heroicon-o-inbox-stack')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-inbox-stack')
                    ->modalHeading('Renvoyer l\'invitation')
                    ->modalSubmitActionLabel('Renvoyer')
                    ->action(function (UserInvitation $record) {
                        Mail::to($record->email)->send(new UserInvitationMail($record));
                        Notification::make()
                            ->success()
                            ->title('Invitation envoyée')
                            ->body('L\'invitation a été envoyée avec succès au destinataire.')
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUserInvitations::route('/'),
        ];
    }
}

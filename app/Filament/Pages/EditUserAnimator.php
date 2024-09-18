<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class EditUserAnimator extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Ma fiche animateur';

    protected static ?string $navigationGroup = 'Mon compte';

    protected static string $view = 'filament.pages.edit-user-animator';

    protected static ?string $title = 'Ma fiche animateur';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()->animator()->exists();
    }

    public function mount(): void
    {
        $this->form->fill(auth()->user()->animator->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                    ->columnSpanFull()
                    ->directory('animators')
                    ->image()
                    ->maxSize(2048)
                    ->imageEditor()
                    ->imageEditorViewportWidth('600')
                    ->imageEditorViewportHeight('600')
                    ->imageResizeTargetWidth('200')
                    ->imageResizeTargetHeight('200')
                    ->imageEditorAspectRatios([
                        '1:1',
                    ]),
                Forms\Components\TextInput::make('email')
                    ->maxLength(255)->required()->email(),
                Forms\Components\TextInput::make('first_name')->label('Prénom')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('last_name')->label('Nom')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('mobile')
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip')->label('Code postal')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')->label('Ville')
                    ->maxLength(255),
                Forms\Components\Select::make('professional_status')->label('Statut professionnel')
                    ->options(config('taxonomies.animators.professional_status'))
                    ->native(false),
                Forms\Components\Select::make('availability')->label('Disponibilités')
                    ->options(config('taxonomies.animators.availability'))
                    ->multiple()
                    ->native(false),

            ])->columns(3)
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            auth()->user()->animator->update($data);

        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}

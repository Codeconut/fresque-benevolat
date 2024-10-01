<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class AnimatorProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $layout = 'filament-panels::components.layout.simple';

    protected static string $view = 'filament.pages.animator-profile';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()->animator()->exists();
    }

    public function getTitle(): string
    {
        return 'Ma fiche animateur';
    }

    public function hasLogo(): bool
    {
        return true;
    }

    public function mount(): void
    {
        $this->form->fill(auth()->user()->animator->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\FileUpload::make('photo')
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
                \Filament\Forms\Components\TextInput::make('mobile')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('zip')->label('Code postal')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('city')->label('Ville')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\Select::make('professional_status')->label('Statut professionnel')
                    ->required()
                    ->options(config('taxonomies.animators.professional_status'))
                    ->native(false),
                \Filament\Forms\Components\Select::make('availability')->label('Disponibilités')
                    ->required()
                    ->options(config('taxonomies.animators.availability'))
                    ->multiple()
                    ->native(false),
            ])->columns(1)
            ->statePath('data');

    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->size('xl')
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

        $currentUser = auth()->user();

        if ($currentUser->has_agreed_terms_at === null) {
            ray('redirect to terms');
            $this->redirect(route('filament.app.animator.charte'));

            return;
        }

        $this->redirect(route('filament.admin.pages.dashboard'));

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}

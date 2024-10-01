<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AnimatorProfileCharte extends Page
{
    protected static string $layout = 'filament-panels::components.layout.simple';

    protected static string $view = 'filament.pages.animator-profile-charte';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()->animator()->exists();
    }

    public function getTitle(): string
    {
        return 'Charte de la Fresque du Bénévolat';
    }

    public function hasLogo(): bool
    {
        return true;
    }

    public function save(): void
    {
        $currentUser = User::find(auth()->user()->id);

        if (! $currentUser->has_agreed_terms_at) {
            $currentUser->has_agreed_terms_at = now();
            $currentUser->save();

            Notification::make()
                ->success()
                ->title('Merci d’avoir accepté la charte !')
                ->send();
        }

        $this->redirect(route('filament.admin.pages.dashboard'));

    }
}

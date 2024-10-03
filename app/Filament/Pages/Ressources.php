<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Ressources extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.ressources';

    protected static ?int $navigationSort = 5;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('animator');
    }

    public function getSubheading(): ?string
    {
        return 'Retrouvez tous les documents utiles pour vos animations';
    }
}

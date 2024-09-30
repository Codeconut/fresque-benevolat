<?php

namespace App\Filament\Resources\AnimatorResource\Pages;

use App\Filament\Resources\AnimatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAnimators extends ManageRecords
{
    protected static string $resource = AnimatorResource::class;

    protected static ?string $title = 'Animateurs';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Ajouter un animateur'),
        ];
    }
}

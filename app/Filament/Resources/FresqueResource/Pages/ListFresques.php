<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFresques extends ListRecords
{
    protected static string $resource = FresqueResource::class;

    protected static ?string $breadcrumb = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Créer une fresque'),
        ];
    }
}

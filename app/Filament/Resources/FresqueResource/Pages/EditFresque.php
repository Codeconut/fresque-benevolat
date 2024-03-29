<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFresque extends EditRecord
{
    protected static string $resource = FresqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Action\SaveAction::make(),
            // Actions\DeleteAction::make(),
            // Actions\ForceDeleteAction::make(),
            // Actions\RestoreAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [
            // RelationManagers\ApplicationsRelationManager::class,
        ];
    }
}

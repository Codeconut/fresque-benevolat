<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\FresqueResource\RelationManagers;

class ViewFresque extends ViewRecord
{
    protected static string $resource = FresqueResource::class;

    public function getSubheading(): ?string
    {
        return route('fresques.show', $this->record);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\ActionGroup::make([
                Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => FresqueResource::getUrl('activities', ['record' => $record])),
                Actions\DeleteAction::make(),
            ])->iconButton(),
        ];
    }
}

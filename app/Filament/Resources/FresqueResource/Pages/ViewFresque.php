<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewFresque extends ViewRecord
{
    protected static string $resource = FresqueResource::class;

    protected static string $view = 'filament.pages.view-fresque';

    public function getSubheading(): ?string
    {
        return $this->record->place?->name.' - '.$this->record->full_date;
    }

    public function getTitle(): string|Htmlable
    {
        return 'Fresque #'.$this->record->id;
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

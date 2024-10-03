<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class ViewFresque extends ViewRecord
{
    protected static string $resource = FresqueResource::class;

    protected static string $view = 'filament.pages.view-fresque';

    // public function getSubheading(): ?string
    // {
    //     return $this->record->place?->name.' - '.$this->record->full_date;
    // }

    public function getHeader(): ?View
    {
        return view('filament.components.header-fresque', ['record' => $this->record]);
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
                Actions\Action::make('manage')->label('Liste des participants')->icon('heroicon-o-users')->url(fn ($record) => FresqueResource::getUrl('manage', ['record' => $record])),
                Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => FresqueResource::getUrl('activities', ['record' => $record])),
                Actions\DeleteAction::make(),
            ])->iconButton(),
        ];
    }
}

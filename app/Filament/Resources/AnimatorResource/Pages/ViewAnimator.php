<?php

namespace App\Filament\Resources\AnimatorResource\Pages;

use App\Filament\Resources\AnimatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewAnimator extends ViewRecord
{
    protected static string $resource = AnimatorResource::class;

    protected static string $view = 'filament.pages.view-animator';

    public function getTitle(): string|Htmlable
    {
        return $this->record->full_name;
    }

    public function getSubheading(): ?string
    {
        if ($this->record->user) {
            return 'Dernière connexion : '.$this->record->user->last_online_at->diffForHumans();
        }

        return 'Pas de compte utilisateur associé';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\ActionGroup::make([
                Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => AnimatorResource::getUrl('activities', ['record' => $record])),
                Actions\DeleteAction::make(),
            ])->iconButton(),
        ];
    }
}

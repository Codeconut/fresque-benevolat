<?php

namespace App\Filament\Resources\AnimatorResource\Pages;

use App\Filament\Resources\AnimatorResource;
use Filament\Resources\Pages\EditRecord;

class EditAnimator extends EditRecord
{
    protected static string $resource = AnimatorResource::class;

    public function getTitle(): string
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

    public function getRelationManagers(): array
    {
        return [];
    }
}

<?php

namespace App\Filament\Resources\AnimatorResource\Pages;

use App\Filament\Resources\AnimatorResource;
use Filament\Resources\Pages\EditRecord;

class EditAnimator extends EditRecord
{
    protected static string $resource = AnimatorResource::class;

    public function getRelationManagers(): array
    {
        return [];
    }
}

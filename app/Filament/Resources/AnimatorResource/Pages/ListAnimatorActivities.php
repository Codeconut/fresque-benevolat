<?php

namespace App\Filament\Resources\AnimatorResource\Pages;

use App\Filament\Resources\AnimatorResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListAnimatorActivities extends ListActivities
{
    protected static string $resource = AnimatorResource::class;

    public function canRestoreActivity(): bool
    {
        return false;
    }
}

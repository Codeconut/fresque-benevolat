<?php

namespace App\Filament\Resources\FresqueApplicationResource\Pages;

use App\Filament\Resources\FresqueApplicationResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListFresqueApplicationActivities extends ListActivities
{
    protected static string $resource = FresqueApplicationResource::class;

    public function canRestoreActivity(): bool
    {
        return false;
    }
}

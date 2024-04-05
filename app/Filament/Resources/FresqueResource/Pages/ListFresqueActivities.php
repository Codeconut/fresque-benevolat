<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListFresqueActivities extends ListActivities
{
    protected static string $resource = FresqueResource::class;

    public function canRestoreActivity(): bool
    {
        return false;
    }
}

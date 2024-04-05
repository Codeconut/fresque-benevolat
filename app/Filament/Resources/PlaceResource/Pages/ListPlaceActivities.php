<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListPlaceActivities extends ListActivities
{
    protected static string $resource = PlaceResource::class;

    public function canRestoreActivity(): bool
    {
        return false;
    }
}

<?php

namespace App\Filament\Resources\FresqueApplicationFeedbackResource\Pages;

use App\Filament\Resources\FresqueApplicationFeedbackResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListFresqueApplicationFeedbackActivities extends ListActivities
{
    protected static string $resource = FresqueApplicationFeedbackResource::class;

    public function canRestoreActivity(): bool
    {
        return false;
    }
}

<?php

namespace App\Filament\Resources\FresqueApplicationResource\Pages;

use App\Filament\Resources\FresqueApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFresqueApplications extends ManageRecords
{
    protected static string $resource = FresqueApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

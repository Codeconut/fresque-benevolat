<?php

namespace App\Filament\Resources\FresqueApplicationFeedbackResource\Pages;

use App\Filament\Resources\FresqueApplicationFeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFresqueApplicationFeedback extends ManageRecords
{
    protected static string $resource = FresqueApplicationFeedbackResource::class;

    protected static ?string $title = 'Témoignages';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

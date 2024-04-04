<?php

namespace App\Filament\Resources\FresqueApplicationResource\Pages;

use App\Filament\Resources\FresqueApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListFresqueApplications extends ListRecords
{
    protected static string $resource = FresqueApplicationResource::class;

    protected static ?string $title = 'Participations';
}

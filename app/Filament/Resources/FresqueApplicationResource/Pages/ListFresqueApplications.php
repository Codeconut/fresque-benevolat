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

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'all' => Tab::make('All'),
    //         'incoming' => Tab::make('Incoming')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->fresqueIncoming()),
    //         'passed' => Tab::make('Passed')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->fresquePassed()),
    //     ];
    // }
}

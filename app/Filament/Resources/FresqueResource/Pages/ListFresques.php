<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListFresques extends ListRecords
{
    protected static string $resource = FresqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'all' => Tab::make('All'),
    //         'incoming' => Tab::make('Incoming')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->incoming()),
    //         'passed' => Tab::make('Passed')
    //             ->modifyQueryUsing(fn (Builder $query) => $query->passed()),
    //     ];
    // }
}

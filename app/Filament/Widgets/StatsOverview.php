<?php

namespace App\Filament\Widgets;

use App\Models\Fresque;
use App\Models\FresqueApplication;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        $user = auth()->user();

        return [
            Stat::make('Fresques', Fresque::managedBy($user)->count()),
            Stat::make('Participations', FresqueApplication::managedBy($user)->count()),
        ];
    }
}

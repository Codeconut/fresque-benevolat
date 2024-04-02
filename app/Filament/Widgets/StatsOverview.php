<?php

namespace App\Filament\Widgets;

use App\Models\Animator;
use App\Models\Fresque;
use App\Models\FresqueApplication;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Fresques', Fresque::count()),
            Stat::make('Animators', Animator::count()),
            Stat::make('Applications', FresqueApplication::count()),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\FresqueApplication;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LastFresqueApplications extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Les dernières participations créées')
            ->query(
                FresqueApplication::query()
                    ->managedBy(auth()->user())
                    ->limit(5)
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Participant')
                    ->description(fn (FresqueApplication $application) => $application->full_name),
                Tables\Columns\TextColumn::make('fresque.full_date')
                    ->label('Fresque')
                    ->description(fn (FresqueApplication $application) => $application->fresque?->place?->city.' - '.$application->fresque?->place?->name),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y à H:i')
                    ->label('Créé le'),
            ])->paginated(false);
    }
}

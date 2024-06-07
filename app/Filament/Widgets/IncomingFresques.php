<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\FresqueResource\Pages;
use App\Models\Fresque;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class IncomingFresques extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Les 3 prochaines fresques à venir')
            ->query(
                Fresque::query()
                    ->limit(3)
                    ->incoming()
                    ->orderBy('date', 'asc')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->label('')
                    ->square()
                    ->grow(false),
                Tables\Columns\TextColumn::make('place.name')
                    ->label('Lieu')
                    ->description(fn (Fresque $fresque) => $fresque?->place?->full_address),
                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->description(fn (Fresque $fresque) => $fresque->schedules),

                Tables\Columns\ViewColumn::make('applications')->label('Participations')->view('tables.columns.fresque-application-summary'),
                Tables\Columns\ViewColumn::make('places')->label('Participants')->alignCenter()->view('tables.columns.fresque-places'),
                Tables\Columns\ImageColumn::make('animators.photo')
                    ->label('Animateurs')
                    ->circular()
                    ->stacked(),
            ])
            ->recordUrl(
                fn (Fresque $record): string => Pages\ViewFresque::getUrl([$record->id]),
            )
            ->paginated(false);
    }
}

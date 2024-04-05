<?php

namespace App\Filament\Widgets;

use App\Models\Fresque;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\IconColumn;
use App\Filament\Resources\FresqueResource\Pages;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;

class IncomingFresques extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Fresque::query()
                    ->incoming()
            )
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->label('')
                    ->square()
                    ->grow(false),
                Tables\Columns\TextColumn::make('place.name')
                    ->label('Lieu')
                    ->searchable(['places.name', 'places.full_address'])
                    ->description(fn (Fresque $fresque) => $fresque?->place?->full_address),
                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->description(fn (Fresque $fresque) => $fresque->schedules),
                Tables\Columns\TextColumn::make('places_left')->label('Places restantes')
                    ->suffix(' places ')
                    ->description(fn (Fresque $fresque) => 'sur ' . $fresque->places . ' au total'),
                ToggleIconColumn::make('is_online')->label('En ligne')->alignCenter(),
                ToggleIconColumn::make('is_registration_open')->label('Inscriptions')->alignCenter(),
                ToggleIconColumn::make('is_private')->label('Privée')->alignCenter()
                    ->onIcon('heroicon-s-lock-closed')
                    ->offIcon('heroicon-o-lock-open'),
                Tables\Columns\ImageColumn::make('animators.photo')
                    ->label('Animateurs')
                    ->searchable(['animators.email', 'animators.first_name', 'animators.last_name'])
                    ->circular()
                    ->stacked(),
            ])
            ->recordUrl(
                fn (Fresque $record): string => Pages\ViewFresque::getUrl([$record->id]),
            );
    }
}

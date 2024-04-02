<?php

namespace App\Filament\Widgets;

use App\Models\Fresque;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

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
                    ->label('Place')
                    ->description(fn (Fresque $fresque) => $fresque?->place?->full_address),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d M Y')
                    ->description(fn (Fresque $fresque) => $fresque->schedules),
                Tables\Columns\TextColumn::make('places_left')
                    ->suffix(' slots left')
                    ->label('Slots')
                    ->description(fn (Fresque $fresque) => 'from ' . $fresque->places),
                Tables\Columns\TextColumn::make('is_online')
                    ->label('Visibility')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Online' : 'Offline')
                    ->color(fn (string $state): string => match ($state) {
                        '' => 'gray',
                        '0' => 'gray',
                        '1' => 'success',
                    }),
                Tables\Columns\TextColumn::make('is_registration_open')
                    ->label('Inscriptions')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Open' : 'Closed')
                    ->color(fn (string $state): string => match ($state) {
                        '' => 'gray',
                        '0' => 'gray',
                        '1' => 'success',
                    }),
                Tables\Columns\ImageColumn::make('animators.photo')
                    ->label('Animators')
                    ->searchable(['animators.email', 'animators.first_name', 'animators.last_name'])
                    ->circular()
                    ->stacked(),
            ]);
    }
}

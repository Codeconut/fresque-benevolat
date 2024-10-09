<?php

namespace App\Filament\Resources\AnimatorResource\RelationManagers;

use App\Filament\Resources\FresqueResource\Pages\ViewFresque;
use App\Models\Fresque;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FresquesRelationManager extends RelationManager
{
    protected static string $relationship = 'fresques';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
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
                Tables\Columns\TextColumn::make('is_online')
                    ->label('En ligne ?')
                    ->badge()
                    ->color(fn (bool $state): string => match ($state) {
                        false => 'gray',
                        true => 'success',
                    })
                    ->formatStateUsing(fn (bool $state): string => $state ? 'En ligne' : 'Hors ligne'),
            ])
            ->recordUrl(
                fn (Fresque $record): string => ViewFresque::getUrl([$record->id]),
            )
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}

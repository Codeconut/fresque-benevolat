<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueApplicationFeedbackResource\Pages;
use App\Filament\Resources\FresqueApplicationFeedbackResource\RelationManagers;
use App\Models\FresqueApplicationFeedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FresqueApplicationFeedbackResource extends Resource
{
    protected static ?string $model = FresqueApplicationFeedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Témoignages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('fresque_application_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\TextInput::make('rating')
                    ->numeric(),
                Forms\Components\KeyValue::make('questions')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([


                Tables\Columns\ImageColumn::make('application.photo')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('application.email')
                    ->label('Participant')
                    ->description(fn (FresqueApplicationFeedback $feedback) => $feedback->application?->full_name),
                Tables\Columns\TextColumn::make('application.fresque.full_date')
                    ->label('Fresque')
                    ->description(fn (FresqueApplicationFeedback $feedback) => $feedback->application?->fresque->place->city . ' - ' . $feedback->application?->fresque->place->name),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y à H:i')
                    ->label('Créé le'),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                // Tables\Actions\ForceDeleteAction::make(),
                // Tables\Actions\RestoreAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => FresqueApplicationFeedbackResource::getUrl('activities', ['record' => $record])),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFresqueApplicationFeedback::route('/'),
            'activities' => Pages\ListFresqueApplicationFeedbackActivities::route('/{record}/activities'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
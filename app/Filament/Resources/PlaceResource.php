<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Models\Place;
use App\Services\AdresseDataGouvFr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Lieux';

    protected static ?string $navigationGroup = 'Paramètres';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom du lieu')
                    ->maxLength(255)->columnSpanFull()->required(),
                Forms\Components\Select::make('geocoding')
                    ->suffixIcon('heroicon-o-map-pin')
                    ->columnSpanFull()
                    ->label('Sélectionner l’addresse du lieu')
                    ->searchable()
                    ->searchPrompt('Rechercher une adresse avec api-adresse.data.gouv.fr')
                    ->reactive()
                    ->dehydrated(false)
                    ->getSearchResultsUsing(function ($query) {
                        $features = AdresseDataGouvFr::search(['q' => $query, 'limit' => 6]);

                        return $features
                            ->mapWithKeys(fn ($feature) => [
                                $feature['properties']['label'] => $feature['properties']['label'],
                            ])
                            ->toArray();
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        $feature = AdresseDataGouvFr::search(['q' => $state, 'limit' => 1])->first();
                        $set('full_address', $feature['properties']['label']);
                        $set('street', $feature['properties']['name']);
                        $set('zip', $feature['properties']['postcode']);
                        $set('city', $feature['properties']['city']);
                        $set('longitude', $feature['geometry']['coordinates'][0]);
                        $set('latitude', $feature['geometry']['coordinates'][1]);
                    }),
                Forms\Components\TextInput::make('full_address')
                    ->label('Adresse complète')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('zip')
                    ->label('Code postal')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('city')
                    ->label('Ville')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('street')
                    ->label('N° Rue')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\MarkdownEditor::make('summary')
                    ->label('Résumé')
                    ->columnSpanFull()
                    ->hidden(! auth()->user()->hasRole('admin')),
                Forms\Components\FileUpload::make('photos')
                    ->required()
                    ->columnSpanFull()
                    ->directory('places')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    //->optimize('webp')
                    ->imageEditor()
                    ->imageEditorViewportWidth('744')
                    ->imageEditorViewportHeight('430')
                    ->hidden(! auth()->user()->hasRole('admin')),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photos')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->square()
                    ->limit(1)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom du lieu')
                    ->description(fn (Place $place) => $place->full_address)
                    ->searchable(['name', 'full_address']),
                Tables\Columns\TextColumn::make('fresques_count')
                    ->suffix(' fresque(s)')
                    ->label('# Fresques')
                    ->counts('fresques')
                    ->description(fn (Place $place) => 'dont '.$place->fresques()->incoming()->count().' à venir'),
                Tables\Columns\TextColumn::make('nextFresque.full_date')
                    ->label('Prochaine fresque')
                    ->description(fn (Place $place) => $place->nextFresque?->places_left.' places restantes'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->modalHeading('Lieu'),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => PlaceResource::getUrl('activities', ['record' => $record])),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                //     Tables\Actions\ForceDeleteBulkAction::make(),
                //     Tables\Actions\RestoreBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePlaces::route('/'),
            'activities' => Pages\ListPlaceActivities::route('/{record}/activities'),
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

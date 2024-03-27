<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueResource\Pages;
use App\Filament\Resources\FresqueResource\RelationManagers;
use App\Models\Address;
use App\Models\Fresque;
use App\Services\AdresseDataGouvFr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FresqueResource extends Resource
{
    protected static ?string $model = Fresque::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom de la fresque')
                    ->required(),
                Forms\Components\DatePicker::make('date'),
                Forms\Components\TimePicker::make('start_at')->seconds(false)->minutesStep(5),
                Forms\Components\TimePicker::make('end_at')->seconds(false)->minutesStep(5),
                Forms\Components\Select::make('address_id')
                    ->label('Lieu')
                    ->relationship(name: 'address', titleAttribute: 'name')
                    ->searchable(['name', 'full_address'])
                    ->getOptionLabelFromRecordUsing(fn (Address $address) => "{$address->name} - {$address->full_address}")
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255)->columnSpanFull(),
                        Forms\Components\Select::make('geocoding')
                            ->suffixIcon('heroicon-o-map-pin')
                            ->columnSpanFull()
                            ->label('Rechercher un lieu')
                            ->searchable()
                            ->searchPrompt('Rechercher une adresse avec api-adresse.data.gouv.fr')
                            ->reactive()
                            ->dehydrated(false)
                            ->getSearchResultsUsing(function ($query) {
                                $features = AdresseDataGouvFr::search(['q' => $query, 'limit' => 6]);
                                return $features
                                    ->mapWithKeys(fn ($feature) => [
                                        $feature['properties']['label'] => $feature['properties']['label']
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
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('zip')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('street')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('latitude')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('longitude')
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\FileUpload::make('cover')->directory('fresques')
                    ->image()
                    ->maxSize(1024)
                    ->imageEditor()
                    ->imageEditorViewportWidth('1920')
                    ->imageEditorViewportHeight('1080')
                    ->imageEditorAspectRatios([
                        '16:9',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom'),
                Tables\Columns\TextColumn::make('address.name')
                    ->label('Lieu')
                    ->description(fn (Fresque $fresque) => $fresque?->address?->full_address),
                // Tables\Columns\TextColumn::make('user.full_name')
                //     ->label('Utilisateur')
                //     ->searchable(['first_name', 'last_name', 'email']),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d M Y')
                    ->description(fn (Fresque $fresque) => $fresque->schedules),
                Tables\Columns\TextColumn::make('state')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                    })
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                fn (Fresque $fresque): string => Pages\ViewFresque::getUrl([$fresque->id]),
            );;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFresques::route('/'),
            'create' => Pages\CreateFresque::route('/create'),
            'view' => Pages\ViewFresque::route('/{record}'),
            'edit' => Pages\EditFresque::route('/{record}/edit'),
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

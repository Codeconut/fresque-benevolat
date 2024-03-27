<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use App\Services\AdresseDataGouvFr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom du lieu')
                    ->description(fn (Address $address) => $address->full_address)
                    ->searchable(),
                Tables\Columns\TextColumn::make('fresques_count')
                    ->label('# Freques')->counts('fresques')
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
            'index' => Pages\ManageAddresses::route('/'),
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

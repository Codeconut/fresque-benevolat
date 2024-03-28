<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueResource\Pages;
use App\Filament\Resources\FresqueResource\RelationManagers;
use App\Models\Address;
use App\Models\Fresque;
use App\Services\AdresseDataGouvFr;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Builder as FormBuilder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class FresqueResource extends Resource
{
    protected static ?string $model = Fresque::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Contents';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make('Informations')
                                    ->schema([
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
                                        Forms\Components\Select::make('animators')
                                            ->label('Animateurs')
                                            ->multiple()
                                            ->relationship('animators', 'email'),
                                        Forms\Components\MarkdownEditor::make('summary'),
                                    ]),
                                Forms\Components\Section::make('Page builder')
                                    ->description('Créez votre page en ajoutant des blocs de contenu')
                                    ->schema([
                                        FormBuilder::make('content')->hiddenLabel()->blocks([
                                            FormBuilder\Block::make('heading')
                                                ->schema([
                                                    TextInput::make('content')
                                                        ->label('Heading')
                                                        ->required(),
                                                    Select::make('level')
                                                        ->options([
                                                            'h1' => 'Heading 1',
                                                            'h2' => 'Heading 2',
                                                            'h3' => 'Heading 3',
                                                            'h4' => 'Heading 4',
                                                            'h5' => 'Heading 5',
                                                            'h6' => 'Heading 6',
                                                        ])
                                                        ->required(),
                                                ])
                                                ->columns(2),
                                            FormBuilder\Block::make('paragraph')
                                                ->schema([
                                                    Textarea::make('content')
                                                        ->label('Paragraph')
                                                        ->required(),
                                                ]),
                                            FormBuilder\Block::make('image')
                                                ->schema([
                                                    FileUpload::make('url')
                                                        ->label('Image')
                                                        ->image()
                                                        ->maxSize(1024)
                                                        ->imageEditor()
                                                        ->imageEditorAspectRatios([
                                                            '16:9',
                                                            '4:3',
                                                        ])
                                                        ->required(),
                                                    TextInput::make('alt')
                                                        ->label('Alt text')
                                                        ->required(),
                                                ]),
                                        ])
                                    ])

                            ])->columnSpan(2),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make('Dates et horaires')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_online')->label('En ligne'),
                                        Forms\Components\DatePicker::make('date')->default(Carbon::now()),
                                        Forms\Components\TimePicker::make('start_at')->default('18:00')->seconds(false)->minutesStep(5),
                                        Forms\Components\TimePicker::make('end_at')->default('20:15')->seconds(false)->minutesStep(5),
                                    ]),
                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('cover')
                                            ->label('Image de couverture')
                                            ->directory('fresques')
                                            ->image()
                                            ->maxSize(1024)
                                            ->imageEditor()
                                            ->imageEditorViewportWidth('1920')
                                            ->imageEditorViewportHeight('1080')
                                            ->imageResizeTargetWidth('1920')
                                            ->imageResizeTargetHeight('1080')
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                            ]),
                                    ])
                            ])->columnSpan(1),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->label('')
                    ->square()
                    ->extraAttributes(['class' => 'w-10']),
                Tables\Columns\TextColumn::make('address.name')
                    ->label('Lieu')
                    ->description(fn (Fresque $fresque) => $fresque?->address?->full_address),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d M Y')
                    ->description(fn (Fresque $fresque) => $fresque->schedules),
                Tables\Columns\TextColumn::make('places_left')
                    ->suffix(' places restantes')
                    ->label('Places')
                    ->description(fn (Fresque $fresque) => 'sur ' . $fresque->places),
                Tables\Columns\IconColumn::make('is_online')
                    ->label('En ligne')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
                Tables\Columns\ImageColumn::make('animators.photo')
                    ->label('Animateurs')
                    ->circular()
                    ->stacked(),
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
            ]);
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
            // 'view' => Pages\ViewFresque::route('/{record}'),
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

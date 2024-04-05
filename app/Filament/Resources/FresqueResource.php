<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueResource\Pages;
use App\Filament\Resources\FresqueResource\RelationManagers;
use App\Models\Animator;
use App\Models\Place;
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
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Columns\IconColumn;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;

class FresqueResource extends Resource
{
    protected static ?string $model = Fresque::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Contenus';

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
                                        Forms\Components\DatePicker::make('date')->default(Carbon::now())->required(),
                                        Forms\Components\TimePicker::make('start_at')->label('Début')->default('18:00')->seconds(false)->minutesStep(5)->required(),
                                        Forms\Components\TimePicker::make('end_at')->label('Fin')->default('20:15')->seconds(false)->minutesStep(5)->required(),
                                        Forms\Components\Select::make('place_id')
                                            ->columnSpanFull()
                                            ->required()
                                            ->label('Lieu')
                                            ->relationship(name: 'place', titleAttribute: 'name')
                                            ->searchable(['name', 'full_address'])
                                            ->getOptionLabelFromRecordUsing(fn (Place $place) => "{$place->name} - {$place->full_address}")
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\Select::make('geocoding')
                                                    ->suffixIcon('heroicon-o-map-pin')
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
                                                Forms\Components\TextInput::make('full_address')->label('Adresse complète')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('zip')->label('Code postal')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('city')->label('Ville')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('street')->label('Rue')
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
                                            ->columnSpanFull()
                                            ->label('Animateurs')
                                            ->multiple()
                                            ->searchable(['first_name', 'last_name', 'zip', 'city', 'email'])
                                            ->relationship('animators', 'email')
                                            ->getOptionLabelFromRecordUsing(fn (Animator $animator) => "{$animator->full_name} {$animator->zip} {$animator->city}")
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('email')
                                                    ->maxLength(255)->required()->email(),
                                                Forms\Components\TextInput::make('first_name')->label('Prénom')
                                                    ->maxLength(255)->required(),
                                                Forms\Components\TextInput::make('last_name')->label('Nom')
                                                    ->maxLength(255)->required(),
                                                Forms\Components\TextInput::make('mobile')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('zip')->label('Code postal')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('city')->label('Ville')
                                                    ->maxLength(255),
                                            ]),
                                        Forms\Components\MarkdownEditor::make('summary')->label('Résumé')->columnSpanFull(),
                                    ])->columns(3),
                                Forms\Components\Section::make('Page builder')
                                    ->description('Create your page by adding blocks.')
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
                                                    Forms\Components\MarkdownEditor::make('content')
                                                        ->label('Paragraph')
                                                        ->required(),
                                                ]),
                                            FormBuilder\Block::make('image')
                                                ->schema([
                                                    FileUpload::make('url')
                                                        ->label('Image')
                                                        ->directory('fresques')
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
                                Forms\Components\Section::make('Paramètres')
                                    ->schema([
                                        // Forms\Components\Toggle::make('is_online')->label('En ligne'),
                                        // Forms\Components\Toggle::make('is_registration_open')->label('Registration'),
                                        Forms\Components\TextInput::make('places')
                                            ->required()
                                            ->integer(),
                                        Forms\Components\ToggleButtons::make('is_private')
                                            ->label('Fresque privée')
                                            ->default(false)
                                            ->boolean()
                                            ->grouped(),
                                        Forms\Components\ToggleButtons::make('is_online')
                                            ->label('En ligne')
                                            ->boolean()
                                            ->grouped(),
                                        Forms\Components\ToggleButtons::make('is_registration_open')
                                            ->label('Inscriptions ouvertes')
                                            ->boolean()
                                            ->grouped(),

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
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                TernaryFilter::make('is_online')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => FresqueResource::getUrl('activities', ['record' => $record]))
                ])
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                //     Tables\Actions\ForceDeleteBulkAction::make(),
                //     Tables\Actions\RestoreBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ApplicationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFresques::route('/'),
            'create' => Pages\CreateFresque::route('/create'),
            'view' => Pages\ViewFresque::route('/{record}'),
            'edit' => Pages\EditFresque::route('/{record}/edit'),
            'activities' => Pages\ListFresqueActivities::route('/{record}/activities'),
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueResource\Pages;
use App\Filament\Resources\FresqueResource\RelationManagers;
use App\Models\Animator;
use App\Models\Fresque;
use App\Models\Place;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Builder as FormBuilder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class FresqueResource extends Resource
{
    protected static ?string $model = Fresque::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?int $navigationSort = 1;

    // protected static ?string $navigationGroup = 'Contenus';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['admin', 'animator']);
    }

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
                                        Forms\Components\DatePicker::make('date')
                                            ->minDate(fn () => ! auth()->user()->hasRole('admin') ? Carbon::now()->startOfDay()->addDays(7) : null)
                                            ->required(),
                                        Forms\Components\TimePicker::make('start_at')
                                            ->label('Début')
                                            ->default('18:00')
                                            ->seconds(false)
                                            ->minutesStep(5)
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function (Set $set, $state) {
                                                if ($state) {
                                                    $endAt = Carbon::createFromFormat('H:i', $state)->addHours(2)->addMinutes(30)->format('H:i');
                                                    $set('end_at', $endAt);
                                                }
                                            }),
                                        Forms\Components\TimePicker::make('end_at')
                                            ->label('Fin')
                                            ->default('20:30')
                                            ->seconds(false)
                                            ->minutesStep(5)
                                            ->required()
                                            ->disabled(! auth()->user()->hasRole('admin'))->dehydrated(),
                                        Forms\Components\Select::make('place_id')
                                            ->columnSpanFull()
                                            ->required()
                                            ->label('Lieu')
                                            ->hint(new HtmlString('<span class="text-xs cursor-pointer text-primary underline" wire:click="mountFormComponentAction(\'data.place_id\', \'createOption\')">Ajouter un lieu</span>'))
                                            ->relationship(name: 'place', titleAttribute: 'name')
                                            ->searchable(['name', 'full_address'])
                                            ->getOptionLabelFromRecordUsing(fn (Place $place) => "{$place->name} - {$place->full_address}")
                                            ->preload()
                                            ->noSearchResultsMessage('Ce lieu n’existe pas encore. Vous pouvez le créer en cliquant sur +.')
                                            ->createOptionForm(fn (Form $form) => PlaceResource::form($form)),
                                        Forms\Components\Select::make('animators')
                                            ->columnSpanFull()
                                            ->label('Animateurs')
                                            ->multiple()
                                            ->searchable(['first_name', 'last_name', 'zip', 'city', 'email'])
                                            ->default(fn () => auth()->user()->animator ? [auth()->user()->animator?->id] : null)
                                            ->relationship('animators', 'email')
                                            ->getOptionLabelFromRecordUsing(fn (Animator $animator) => "{$animator->full_name}"),

                                    ])->columns(3),
                                Forms\Components\Section::make('Contenus')
                                    ->description('Créez votre page en ajoutant des blocs.')
                                    ->schema([
                                        Forms\Components\MarkdownEditor::make('summary')
                                            ->label('Infos pratiques')
                                            ->default(file_get_contents(resource_path(('markdown/infos-pratiques.md'))))
                                            ->required(),
                                        FormBuilder::make('content')
                                            ->hiddenLabel()
                                            ->blocks([
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
                                            ->collapsed()
                                            ->default(include resource_path('default-content.php'))
                                            ->extraAttributes(fn () => ! auth()->user()->hasRole('admin') ? ['class' => 'hidden'] : [])
                                            ->disabled(fn () => ! auth()->user()->hasRole('admin'))
                                            ->dehydrated(true),
                                    ]),

                            ])->columnSpan(2),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make('Paramètres')
                                    ->schema([
                                        Forms\Components\TextInput::make('places')
                                            ->required()
                                            ->default(15)
                                            ->integer(),
                                        Forms\Components\ToggleButtons::make('is_private')
                                            ->label('Fresque privée')
                                            ->default(false)
                                            ->boolean()
                                            ->grouped(),
                                        Forms\Components\ToggleButtons::make('is_online')
                                            ->label('En ligne')
                                            ->default(false)
                                            ->boolean()
                                            ->grouped()
                                            ->hidden(fn () => ! auth()->user()->hasRole('admin')),
                                        Forms\Components\ToggleButtons::make('is_registration_open')
                                            ->label('Inscriptions ouvertes')
                                            ->default(true)
                                            ->boolean()
                                            ->grouped(),

                                    ]),
                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('cover')
                                            ->label('Image de couverture')
                                            ->directory('fresques')
                                            // ->optimize('webp')
                                            ->image()
                                            ->imageEditor()
                                            ->imageResizeMode('cover')
                                            ->imageEditorViewportWidth('744')
                                            ->imageEditorViewportHeight('430'),
                                    ])->hidden(fn () => ! auth()->user()->hasRole('admin')),
                            ])->columnSpan(1),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->size('lg')
                    ->color('gray'),
                Tables\Columns\ImageColumn::make('cover')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->label('')
                    ->square()
                    ->grow(false),
                Tables\Columns\TextColumn::make('place.name')
                    ->label('Lieu')
                    ->searchable(['places.name', 'places.full_address'])
                    ->description(fn (Fresque $fresque) => $fresque?->place?->full_address)
                    ->wrap(),
                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->description(fn (Fresque $fresque) => $fresque->schedules),

                Tables\Columns\ViewColumn::make('applications')->label('Participations')->view('tables.columns.fresque-application-summary'),
                Tables\Columns\ViewColumn::make('places')->label('Participants')->alignCenter()->view('tables.columns.fresque-places'),
                Tables\Columns\ImageColumn::make('animators.photo')
                    ->label('Animateurs')
                    ->searchable(['animators.email', 'animators.first_name', 'animators.last_name'])
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
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                TernaryFilter::make('is_online'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ReplicateAction::make()
                        ->beforeReplicaSaved(function (Fresque $replica): void {
                            $replica->is_online = false;
                        })
                        ->successRedirectUrl(fn (Fresque $replica): string => route('filament.admin.resources.fresques.edit', [
                            'record' => $replica,
                        ])),
                    Tables\Actions\Action::make('manage')->label('Liste des participants')->icon('heroicon-o-users')->url(fn ($record) => FresqueResource::getUrl('manage', ['record' => $record])),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => FresqueResource::getUrl('activities', ['record' => $record])),
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
            'manage' => Pages\ManageParticipantsFresque::route('/{record}/manage'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->managedBy(auth()->user())
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimatorResource\Pages;
use App\Filament\Resources\AnimatorResource\RelationManagers;
use App\Models\Animator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;

class AnimatorResource extends Resource
{
    protected static ?string $model = Animator::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Animateurs';

    protected static ?string $navigationGroup = 'Paramètres';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
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
                                        Forms\Components\Select::make('professional_status')->label('Statut professionnel')
                                            ->options(config('taxonomies.animators.professional_status'))
                                            ->native(false),
                                        Forms\Components\Select::make('availability')->label('Disponibilités')
                                            ->options(config('taxonomies.animators.availability'))
                                            ->multiple()
                                            ->native(false),
                                    ])->columns(3),
                                Forms\Components\Section::make('Notes')
                                    ->schema([
                                        Forms\Components\MarkdownEditor::make('notes'),
                                    ]),
                            ])->columnSpan(2),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make('Paramètres')
                                    ->schema([
                                        Forms\Components\Select::make('user_id')
                                            ->label('Utilisateur')
                                            ->relationship('user', 'name')
                                            ->searchable()
                                            ->placeholder('Sélectionner un utilisateur'),
                                        Forms\Components\Select::make('level')->label('Niveau d’animation')
                                            ->options(config('taxonomies.animators.level'))
                                            ->native(false),
                                        Rating::make('rating')
                                            ->stars(5)
                                            ->allowZero()
                                            ->default(3),
                                    ]),
                                Forms\Components\Section::make('Engagement')
                                    ->schema([
                                        Forms\Components\Select::make('cadre_type')
                                            ->label('Cadre')
                                            ->options(config('taxonomies.animators.cadre_type'))
                                            ->native(false)
                                            ->live(),
                                        Forms\Components\Textarea::make('cadre_organisation')
                                            ->label('Organisation')
                                            ->hidden(fn (Get $get) => $get('cadre_type') !== 'pro'),
                                    ]),
                                Forms\Components\Section::make('Images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('photo')
                                            ->columnSpanFull()
                                            ->directory('animators')
                                            ->image()
                                            ->maxSize(2048)
                                            ->imageEditor()
                                            ->imageEditorViewportWidth('600')
                                            ->imageEditorViewportHeight('600')
                                            ->imageResizeTargetWidth('200')
                                            ->imageResizeTargetHeight('200')
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ]),
                                    ]),
                            ])->columnSpan(1),
                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Animateur')
                    ->description(fn (Animator $animator) => $animator->email)
                    ->searchable(['email', 'first_name', 'last_name']),

                Tables\Columns\TextColumn::make('fresques_count')
                    ->suffix(' fresque(s)')
                    ->label('# Fresques')
                    ->counts('fresques')
                    ->description(fn (Animator $animator) => 'dont '.$animator->fresques()->incoming()->count().' à venir'),
                Tables\Columns\TextColumn::make('nextFresque.full_date')
                    ->label('Prochaine fresque')
                    ->description(fn (Animator $animator) => $animator->nextFresque?->places_left.' places restantes'),
                RatingColumn::make('rating')
                    ->label('Notation')
                    ->stars(5),
                Tables\Columns\IconColumn::make('user_exists')
                    ->label('Compte')
                    ->exists('user')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => AnimatorResource::getUrl('activities', ['record' => $record])),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
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
            'index' => Pages\ManageAnimators::route('/'),
            'create' => Pages\CreateAnimator::route('/create'),
            'view' => Pages\ViewAnimator::route('/{record}'),
            'edit' => Pages\EditAnimator::route('/{record}/edit'),
            'activities' => Pages\ListAnimatorActivities::route('/{record}/activities'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FresquesRelationManager::class,
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueApplicationResource\Pages;
use App\Models\FresqueApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FresqueApplicationResource extends Resource
{
    protected static ?string $model = FresqueApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Participations';

    protected static ?int $navigationSort = 2;

    // protected static ?string $navigationGroup = 'Contenus';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['admin', 'animator']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->maxLength(255)->required()->email(),
                Forms\Components\TextInput::make('first_name')->label('Prénom')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('last_name')->label('Nom')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('mobile')
                    ->maxLength(255),
                Forms\Components\Select::make('info_benevolat')->label('Déjà bénévole ?')
                    ->options(config('taxonomies.applications.info_benevolat')),
                Forms\Components\Select::make('info_fresque')->label('Déjà participé à une fresque ?')
                    ->options(config('taxonomies.applications.info_fresque')),
                Forms\Components\Select::make('post_fresque_engagement')->label('As-tu réalisé une mission de bénévolat depuis cette fresque ?')
                    ->options(config('taxonomies.applications.post_fresque_engagement'))->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('notes')->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Participant')
                    ->description(fn (FresqueApplication $application) => $application->full_name)
                    ->searchable(['email', 'first_name', 'last_name']),
                Tables\Columns\TextColumn::make('fresque.full_date')
                    ->label('Fresque')
                    ->description(fn (FresqueApplication $application) => $application->fresque?->place?->city.' - '.$application->fresque?->place?->name),
                Tables\Columns\SelectColumn::make('state')->label('Statut')
                    ->options(config('taxonomies.applications.states'))->rules(['required'])->selectablePlaceholder(false),
                Tables\Columns\IconColumn::make('post_fresque_engagement')
                    ->label('Engagement')
                    ->icon(fn (string $state): string => match ($state) {
                        'yes' => 'heroicon-o-check-circle',
                        'no_but_soon' => 'heroicon-o-clock',
                        'not_yet' => 'heroicon-o-x-circle',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y à H:i')
                    ->label('Créé le'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('state')
                    ->label('Statut')
                    ->options(config('taxonomies.applications.states'))
                    ->placeholder('Tous les statuts'),
                Tables\Filters\SelectFilter::make('post_fresque_engagement')
                    ->label('Engagement post-fresque ?')
                    ->options(config('taxonomies.applications.post_fresque_engagement'))
                    ->placeholder('Toutes les options'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->modalHeading('Participation'),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => FresqueApplicationResource::getUrl('activities', ['record' => $record])),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                //     Tables\Actions\ForceDeleteBulkAction::make(),
                //     Tables\Actions\RestoreBulkAction::make(),
                // ]),
            ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFresqueApplications::route('/'),
            'activities' => Pages\ListFresqueApplicationActivities::route('/{record}/activities'),
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

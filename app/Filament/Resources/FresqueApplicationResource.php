<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FresqueApplicationResource\Pages;
use App\Filament\Resources\FresqueApplicationResource\RelationManagers;
use App\Models\FresqueApplication;
use Carbon\Carbon;
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

    protected static ?string $navigationGroup = 'Contenus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\FileUpload::make('photo')->directory('animators')
                //     ->image()
                //     ->maxSize(2048)
                //     ->imageEditor()
                //     ->imageEditorViewportWidth('600')
                //     ->imageEditorViewportHeight('600')
                //     ->imageResizeTargetWidth('200')
                //     ->imageResizeTargetHeight('200')
                //     ->imageEditorAspectRatios([
                //         '1:1',
                //     ]),
                Forms\Components\TextInput::make('email')
                    ->maxLength(255)->required()->email(),
                Forms\Components\TextInput::make('first_name')->label('Prénom')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('last_name')->label('Nom')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('mobile')
                    ->maxLength(255),
                Tables\Columns\SelectColumn::make('info_benevolat')->label('Déjà bénévole ?')
                    ->options([
                        'yes_many' => 'Oui, plusieurs fois',
                        'yes_once' => 'Oui, une fois',
                        'none' => 'Non, jamais',
                    ]),
                Tables\Columns\SelectColumn::make('info_fresque')->label('Déjà participé à une fresque ?')
                    ->options([
                        'yes' => 'Oui, j\'ai déjà participé à ce type d\'atelier',
                        'no_but_i_know' => 'Non, mais je connais',
                        'no_and_i_dont_know' => 'Non et je ne connaissais pas',
                    ]),
                Forms\Components\Select::make('state')->label('Statut')
                    ->options([
                        'registered' => '0 - Inscrit',
                        'confirmed_presence' => '1 - Présence confirmé',
                        'validated' => '2 - Réalisé',
                        'canceled' => '3 - Annulé',
                        'missing' => '4 - Absent',
                    ])
                    ->native(false),
                Forms\Components\MarkdownEditor::make('notes')->columnSpanFull()
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
                    ->searchable(['fresque.place.name', 'fresque.place.full_address'])
                    ->description(fn (FresqueApplication $application) => $application->fresque->place->city . ' - ' . $application->fresque->place->name),
                Tables\Columns\SelectColumn::make('state')->label('Statut')
                    ->options([
                        'registered' => '0 - Inscrit',
                        'confirmed_presence' => '1 - Présence confirmé',
                        'validated' => '2 - Réalisé',
                        'canceled' => '3 - Annulé',
                        'missing' => '4 - Absent',
                    ])->rules(['required'])->selectablePlaceholder(false)
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
            'index' => Pages\ListFresqueApplications::route('/'),
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

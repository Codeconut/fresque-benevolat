<?php

namespace App\Filament\Resources\FresqueResource\RelationManagers;

use App\Models\FresqueApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
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
                Forms\Components\Select::make('info_benevolat')->label('Déjà bénévole ?')
                    ->options([
                        'yes_many' => 'Oui, plusieurs fois',
                        'yes_once' => 'Oui, une fois',
                        'none' => 'Non, jamais',
                    ]),
                Forms\Components\Select::make('info_fresque')->label('Déjà participé à une fresque ?')
                    ->options([
                        'yes' => 'Oui, j\'ai déjà participé à ce type d\'atelier',
                        'no_but_i_know' => 'Non, mais je connais',
                        'no_and_i_dont_know' => 'Non et je ne connaissais pas',
                    ]),
                Forms\Components\MarkdownEditor::make('notes')->columnSpanFull()
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-placeholder.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Participant')
                    ->description(fn (FresqueApplication $application) => $application->full_name),
                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile'),
                Tables\Columns\SelectColumn::make('state')
                    ->label('Statut')
                    ->options([
                        'registered' => '0 - Inscrit',
                        'confirmed_presence' => '1 - Présence confirmé',
                        'validated' => '2 - Réalisé',
                        'canceled' => '3 - Annulé',
                        'missing' => '4 - Absent',
                    ])->rules(['required'])->selectablePlaceholder(false)
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // ->paginated(false)
            // ->defaultGroup('state')
            // ->groups([
            //     Group::make('state')->label('Statut')
            //         ->getTitleFromRecordUsing(fn (FresqueApplication $record): string => ucfirst($record->state)),
            // ])
            // ->groupingSettingsHidden()
        ;
    }
}

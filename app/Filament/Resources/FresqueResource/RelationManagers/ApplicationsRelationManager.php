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
                    ->options(config('taxonomies.applications.states'))->rules(['required'])->selectablePlaceholder(false)
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

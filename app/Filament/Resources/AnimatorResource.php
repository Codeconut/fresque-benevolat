<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimatorResource\Pages;
use App\Filament\Resources\AnimatorResource\RelationManagers;
use App\Models\Animator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimatorResource extends Resource
{
    protected static ?string $model = Animator::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Animateurs';

    protected static ?string $navigationGroup = 'Paramètres';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')->directory('animators')
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
                Forms\Components\Select::make('level')->label('Niveau d’animation')
                    ->options(config('taxonomies.animators.level'))
                    ->native(false),
                Forms\Components\MarkdownEditor::make('notes')->columnSpanFull()
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
                Tables\Columns\TextColumn::make('full_address')
                    ->label('Coordonnées')
                    ->description(fn (Animator $animator) => $animator->mobile)
                    ->searchable(['email', 'first_name', 'last_name']),
                Tables\Columns\TextColumn::make('fresques_count')
                    ->suffix(' fresque(s)')
                    ->label('# Fresques')
                    ->counts('fresques')
                    ->description(fn (Animator $animator) => 'dont ' . $animator->fresques()->incoming()->count() . ' à venir'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('activities')->label('Historique')->icon('heroicon-s-list-bullet')->url(fn ($record) => AnimatorResource::getUrl('activities', ['record' => $record])),
                    Tables\Actions\DeleteAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAnimators::route('/'),
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
}

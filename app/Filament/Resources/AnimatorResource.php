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

    protected static ?string $navigationLabel = 'Animators';

    protected static ?string $navigationGroup = 'Settings';

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
                Forms\Components\TextInput::make('first_name')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255)->required(),
                Forms\Components\TextInput::make('mobile')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('photos')
                    ->label('')
                    ->defaultImageUrl(url('/images/default-animator.png'))
                    ->circular(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Animator')
                    ->description(fn (Animator $animator) => $animator->full_name)
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
            'index' => Pages\ManageAnimators::route('/'),
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
<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Resources\ActivityResource\Pages\CreateActivity;
use Modules\Ticket\Filament\Resources\ActivityResource\Pages\EditActivity;
use Modules\Ticket\Filament\Resources\ActivityResource\Pages\ListActivities;
use Modules\Ticket\Filament\Resources\ActivityResource\Pages\ViewActivity;
use Modules\Ticket\Models\Activity;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Activities');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Referential');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Activity name'))
                                    ->required()
                                    ->maxLength(255),

                                RichEditor::make('description')
                                    ->label(__('Description'))
                                    ->required()
                                    ->columnSpan(2),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Activity name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('id');
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivities::route('/'),
            'create' => CreateActivity::route('/create'),
            'view' => ViewActivity::route('/{record}'),
            'edit' => EditActivity::route('/{record}/edit'),
        ];
    }
}

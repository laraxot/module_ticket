<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages\CreateProjectStatus;
use Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages\EditProjectStatus;
use Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages\ListProjectStatuses;
use Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages\ViewProjectStatus;
use Modules\Ticket\Models\ProjectStatus;

class ProjectStatusResource extends Resource
{
    protected static ?string $model = ProjectStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Project statuses');
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
                                    ->label(__('Status name'))
                                    ->required()
                                    ->maxLength(255),

                                ColorPicker::make('color')
                                    ->label(__('Status color'))
                                    ->required(),

                                Checkbox::make('is_default')
                                    ->label(__('Default status'))
                                    ->helperText(
                                        __('If checked, this status will be automatically affected to new projects')
                                    ),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make('color')
                    ->label(__('Status color'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label(__('Status name'))
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_default')
                    ->label(__('Default status'))
                    ->boolean()
                    ->sortable(),

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
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectStatuses::route('/'),
            'create' => CreateProjectStatus::route('/create'),
            'view' => ViewProjectStatus::route('/{record}'),
            'edit' => EditProjectStatus::route('/{record}/edit'),
        ];
    }
}

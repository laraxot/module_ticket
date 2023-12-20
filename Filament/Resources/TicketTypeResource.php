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
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Guava\FilamentIconPicker\Tables\IconColumn;
use Modules\Ticket\Filament\Resources\TicketTypeResource\Pages\CreateTicketType;
use Modules\Ticket\Filament\Resources\TicketTypeResource\Pages\EditTicketType;
use Modules\Ticket\Filament\Resources\TicketTypeResource\Pages\ListTicketTypes;
use Modules\Ticket\Filament\Resources\TicketTypeResource\Pages\ViewTicketType;
use Modules\Ticket\Models\TicketType;

class TicketTypeResource extends Resource
{
    protected static ?string $model = TicketType::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Ticket types');
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
                                    ->label(__('Type name'))
                                    ->required()
                                    ->maxLength(255),

                                ColorPicker::make('color')
                                    ->label(__('Type color'))
                                    ->required(),

                                IconPicker::make('icon')
                                    ->label(__('Type icon'))
                                    ->required(),

                                Checkbox::make('is_default')
                                    ->label(__('Default type'))
                                    ->helperText(
                                        __('If checked, this type will be automatically affected to new tickets')
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
                    ->label(__('Type color'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label(__('Type name'))
                    ->sortable()
                    ->searchable(),

                IconColumn::make('icon')
                    ->label(__('Type icon'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_default')
                    ->label(__('Default type'))
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
            'index' => ListTicketTypes::route('/'),
            'create' => CreateTicketType::route('/create'),
            'view' => ViewTicketType::route('/{record}'),
            'edit' => EditTicketType::route('/{record}/edit'),
        ];
    }
}

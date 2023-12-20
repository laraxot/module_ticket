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
use Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages\CreateTicketPriority;
use Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages\EditTicketPriority;
use Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages\ListTicketPriorities;
use Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages\ViewTicketPriority;
use Modules\Ticket\Models\TicketPriority;

class TicketPriorityResource extends Resource
{
    protected static ?string $model = TicketPriority::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('Ticket priorities');
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
                                    ->label(__('Priority name'))
                                    ->required()
                                    ->maxLength(255),

                                ColorPicker::make('color')
                                    ->label(__('Priority color'))
                                    ->required(),

                                Checkbox::make('is_default')
                                    ->label(__('Default priority'))
                                    ->helperText(
                                        __('If checked, this priority will be automatically affected to new tickets')
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
                    ->label(__('Priority color'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label(__('Priority name'))
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_default')
                    ->label(__('Default priority'))
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
            'index' => ListTicketPriorities::route('/'),
            'create' => CreateTicketPriority::route('/create'),
            'view' => ViewTicketPriority::route('/{record}'),
            'edit' => EditTicketPriority::route('/{record}/edit'),
        ];
    }
}

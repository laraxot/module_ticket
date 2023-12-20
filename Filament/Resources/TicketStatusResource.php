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
use Modules\Ticket\Filament\Resources\TicketStatusResource\Pages\CreateTicketStatus;
use Modules\Ticket\Filament\Resources\TicketStatusResource\Pages\EditTicketStatus;
use Modules\Ticket\Filament\Resources\TicketStatusResource\Pages\ListTicketStatuses;
use Modules\Ticket\Filament\Resources\TicketStatusResource\Pages\ViewTicketStatus;
use Modules\Ticket\Models\TicketStatus;

class TicketStatusResource extends Resource
{
    protected static ?string $model = TicketStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Ticket statuses');
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

                                TextInput::make('order')
                                    ->label(__('Status order'))
                                    ->integer()
                                    ->default(static fn (): int => TicketStatus::whereNull('project_id')->count() + 1)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label(__('Status order'))
                    ->sortable()
                    ->searchable(),

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
            ])
            ->defaultSort('order');
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketStatuses::route('/'),
            'create' => CreateTicketStatus::route('/create'),
            'view' => ViewTicketStatus::route('/{record}'),
            'edit' => EditTicketStatus::route('/{record}/edit'),
        ];
    }
}

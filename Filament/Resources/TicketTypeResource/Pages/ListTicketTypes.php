<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Resources\TicketTypeResource;

class ListTicketTypes extends ListRecords
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            // ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions());
    }

    public function getTableColumns(): array
    {
        return [
            Tables\Columns\ColorColumn::make('color')
            ->label(__('Type color'))
            ->sortable()
            ->searchable(),

            Tables\Columns\TextColumn::make('name')
                ->label(__('Type name'))
                ->sortable()
                ->searchable(),
            /*
            IconColumn::make('icon')
                ->label(__('Type icon'))
                ->sortable()
                ->searchable(),
            */
            Tables\Columns\IconColumn::make('icon')
                ->icon(fn (string $state) => $state),

            Tables\Columns\IconColumn::make('is_default')
                ->label(__('Default type'))
                ->boolean()
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label(__('Created at'))
                ->dateTime()
                ->sortable()
                ->searchable(),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    public function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ];
    }
}

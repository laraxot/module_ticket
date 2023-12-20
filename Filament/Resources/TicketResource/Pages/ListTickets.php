<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketResource\Pages;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Filament\Resources\TicketResource;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /*-- fare scope
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where(static function ($query) {
                return $query->where('owner_id', auth()->id())
                    ->orWhere('responsible_id', auth()->id())
                    ->orWhereHas('project', static function ($query) {
                        return $query->where('owner_id', auth()->id())
                            ->orWhereHas('users', static function ($query) {
                                return $query->where('users.id', auth()->id());
                            });
                    });
            });
    }
    */
}

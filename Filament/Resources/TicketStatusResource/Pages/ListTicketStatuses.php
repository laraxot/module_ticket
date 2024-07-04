<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Filament\Resources\TicketStatusResource;

class ListTicketStatuses extends ListRecords
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->whereNull('project_id');
    }
}

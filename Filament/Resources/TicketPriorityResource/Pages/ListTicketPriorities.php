<?php

namespace Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages;

use Modules\Ticket\Filament\Resources\TicketPriorityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketPriorities extends ListRecords
{
    protected static string $resource = TicketPriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Modules\Ticket\Filament\Resources\TicketTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketTypes extends ListRecords
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Resources\TicketTypeResource;

class ListTicketTypes extends ListRecords
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

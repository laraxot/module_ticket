<?php

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Modules\Ticket\Filament\Resources\TicketTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketType extends ViewRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

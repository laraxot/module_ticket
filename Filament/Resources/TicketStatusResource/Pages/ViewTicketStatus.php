<?php

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Modules\Ticket\Filament\Resources\TicketStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketStatus extends ViewRecord
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

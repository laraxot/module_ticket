<?php

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Modules\Ticket\Filament\Resources\TicketStatusResource;
use Modules\Ticket\Models\TicketStatus;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketStatus extends CreateRecord
{
    protected static string $resource = TicketStatusResource::class;
}

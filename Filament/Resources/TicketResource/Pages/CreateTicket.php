<?php

namespace Modules\Ticket\Filament\Resources\TicketResource\Pages;

use Modules\Ticket\Filament\Resources\TicketResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}

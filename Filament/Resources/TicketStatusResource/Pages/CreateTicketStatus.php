<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Resources\TicketStatusResource;

class CreateTicketStatus extends CreateRecord
{
    protected static string $resource = TicketStatusResource::class;
}

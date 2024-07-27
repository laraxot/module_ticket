<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\GeoTicketResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Resources\GeoTicketResource;

class CreateGeoTicket extends CreateRecord
{
    protected static string $resource = GeoTicketResource::class;
}

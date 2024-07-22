<?php

namespace Modules\Ticket\Filament\Resources\GeoTicketResource\Pages;

use Modules\Ticket\Filament\Resources\GeoTicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGeoTicket extends EditRecord
{
    protected static string $resource = GeoTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\GeoTicketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\GeoTicketResource;

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

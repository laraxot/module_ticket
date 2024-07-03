<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Resources\TicketTypeResource;

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

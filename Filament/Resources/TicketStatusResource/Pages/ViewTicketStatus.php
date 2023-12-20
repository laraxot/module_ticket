<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Resources\TicketStatusResource;

class ViewTicketStatus extends ViewRecord
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

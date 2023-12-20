<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Resources\TicketPriorityResource;

/**
 * @property TicketPriority $record
 */
class ViewTicketPriority extends ViewRecord
{
    protected static string $resource = TicketPriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Resources\TicketPriorityResource;
use Modules\Ticket\Models\TicketPriority;

/**
 * @property TicketPriority $record
 */
class CreateTicketPriority extends CreateRecord
{
    protected static string $resource = TicketPriorityResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->is_default) {
            TicketPriority::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

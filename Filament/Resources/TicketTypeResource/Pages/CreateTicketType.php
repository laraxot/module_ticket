<?php

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Modules\Ticket\Filament\Resources\TicketTypeResource;
use Modules\Ticket\Models\TicketType;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketType extends CreateRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->is_default) {
            TicketType::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

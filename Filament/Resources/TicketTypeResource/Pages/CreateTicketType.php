<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Resources\TicketTypeResource;
use Modules\Ticket\Models\TicketType;
use Webmozart\Assert\Assert;

class CreateTicketType extends CreateRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function afterCreate(): void
    {
        Assert::isInstanceOf($this->record, TicketType::class);
        if (0 !== $this->record->is_default) {
            TicketType::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

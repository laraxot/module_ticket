<?php

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Modules\Ticket\Filament\Resources\TicketStatusResource;
use Modules\Ticket\Models\TicketStatus;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketStatus extends EditRecord
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

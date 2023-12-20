<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\TicketStatusResource;

class EditTicketStatus extends EditRecord
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

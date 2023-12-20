<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\TicketPriorityResource;
use Modules\Ticket\Models\TicketPriority;

/**
 * @property TicketPriority $record
 */
class EditTicketPriority extends EditRecord
{
    protected static string $resource = TicketPriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        if ($this->record->is_default) {
            TicketPriority::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

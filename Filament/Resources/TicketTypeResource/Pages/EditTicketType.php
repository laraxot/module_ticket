<?php

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Modules\Ticket\Filament\Resources\TicketTypeResource;
use Modules\Ticket\Models\TicketType;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicketType extends EditRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        if ($this->record->is_default) {
            TicketType::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

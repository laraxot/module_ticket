<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;

use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\TicketTypeResource;
use Modules\Ticket\Models\TicketStatus;
use Modules\Ticket\Models\TicketType;
use Webmozart\Assert\Assert;

class EditTicketType extends EditRecord
{
    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        Assert::isInstanceOf($this->record, TicketType::class);
        if (0 !== $this->record->is_default) {
            TicketStatus::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

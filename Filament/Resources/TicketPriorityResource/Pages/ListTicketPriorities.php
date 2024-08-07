<?php
/**
 * --.
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketPriorityResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Resources\TicketPriorityResource;

class ListTicketPriorities extends ListRecords
{
    protected static string $resource = TicketPriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

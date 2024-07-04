<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TimesheetResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Resources\TimesheetResource;

class ListTimesheet extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}

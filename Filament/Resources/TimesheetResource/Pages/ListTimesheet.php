<?php

namespace Modules\Ticket\Filament\Resources\TimesheetResource\Pages;

use Modules\Ticket\Filament\Resources\TimesheetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimesheet extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}

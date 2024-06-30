<?php

namespace Modules\Ticket\Filament\Resources\TimesheetResource\Pages;

use Modules\Ticket\Filament\Resources\TimesheetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimesheet extends EditRecord
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

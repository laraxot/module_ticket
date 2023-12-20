<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TimesheetResource\Pages;

use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\TimesheetResource;

class EditTimesheet extends EditRecord
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

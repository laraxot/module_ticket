<?php

namespace Modules\Ticket\Filament\Resources\RoleResource\Pages;

use Modules\Ticket\Filament\Resources\RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRole extends ViewRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

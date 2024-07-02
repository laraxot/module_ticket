<?php

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Modules\Ticket\Filament\Resources\ProjectStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectStatus extends ViewRecord
{
    protected static string $resource = ProjectStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

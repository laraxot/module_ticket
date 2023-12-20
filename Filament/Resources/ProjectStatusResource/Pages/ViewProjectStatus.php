<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Resources\ProjectStatusResource;

class ViewProjectStatus extends ViewRecord
{
    protected static string $resource = ProjectStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

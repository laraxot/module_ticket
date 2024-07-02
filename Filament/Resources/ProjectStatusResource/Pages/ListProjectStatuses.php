<?php

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Modules\Ticket\Filament\Resources\ProjectStatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectStatuses extends ListRecords
{
    protected static string $resource = ProjectStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

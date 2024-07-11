<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Resources\ProjectStatusResource;

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

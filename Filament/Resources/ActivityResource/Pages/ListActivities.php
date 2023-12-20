<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ActivityResource\Pages;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Resources\ActivityResource;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

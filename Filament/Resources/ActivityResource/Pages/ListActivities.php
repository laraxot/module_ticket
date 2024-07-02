<?php

namespace Modules\Ticket\Filament\Resources\ActivityResource\Pages;

use Modules\Ticket\Filament\Resources\ActivityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Modules\Ticket\Filament\Resources\ProjectStatusResource;
use Modules\Ticket\Models\ProjectStatus;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectStatus extends CreateRecord
{
    protected static string $resource = ProjectStatusResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->is_default) {
            ProjectStatus::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

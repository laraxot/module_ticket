<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Resources\ProjectStatusResource;
use Modules\Ticket\Models\ProjectStatus;

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

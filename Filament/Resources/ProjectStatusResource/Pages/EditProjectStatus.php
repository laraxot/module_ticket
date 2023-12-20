<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectStatusResource\Pages;

use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\ProjectStatusResource;
use Modules\Ticket\Models\ProjectStatus;
use Webmozart\Assert\Assert;

class EditProjectStatus extends EditRecord
{
    protected static string $resource = ProjectStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        Assert::isInstanceOf($this->record, ProjectStatus::class);
        if ($this->record->is_default) {
            ProjectStatus::where('id', '<>', $this->record->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }
    }
}

<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ActivityResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\ActivityResource;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

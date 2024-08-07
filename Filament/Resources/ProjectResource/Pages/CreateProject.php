<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Resources\ProjectResource;

/**
 * @property Project $record
 */
class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}

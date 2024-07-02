<?php

namespace Modules\Ticket\Filament\Resources\ProjectResource\Pages;

use Modules\Ticket\Filament\Resources\ProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}

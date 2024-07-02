<?php

namespace Modules\Ticket\Filament\Resources\PermissionResource\Pages;

use Modules\Ticket\Filament\Resources\PermissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
}

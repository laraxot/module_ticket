<?php

namespace Modules\Ticket\Filament\Resources\RoleResource\Pages;

use Modules\Ticket\Filament\Resources\RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Filament\Resources\ProjectResource;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where(function ($query) {
                return $query->where('owner_id', auth()->user()->id)
                    ->orWhereHas('users', function ($query) {
                        return $query->where('users.id', auth()->user()->id);
                    });
            });
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\Pages;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Filament\Resources\ProjectResource;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /* -- creare uno scope
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where(static function ($query) {
                return $query->where('owner_id', auth()->id())
                    ->orWhereHas('users', static function ($query) {
                        return $query->where('users.id', auth()->id());
                    });
            });
    }
    */
}

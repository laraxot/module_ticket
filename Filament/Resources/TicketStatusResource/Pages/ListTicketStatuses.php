<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketStatusResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Filament\Resources\TicketStatusResource;
use Webmozart\Assert\Assert;

class ListTicketStatuses extends ListRecords
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        Assert::notNull(parent::getTableQuery());

        return parent::getTableQuery()
            ->whereNull('project_id');
    }
}

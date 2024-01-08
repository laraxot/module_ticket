<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Resources\ProjectResource;
use Modules\Ticket\Models\Project;

/**
 * @property Project $record
 */
class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('kanban')
                ->label(
                    fn () => ('scrum' === $this->record->type ? __('Scrum board') : __('Kanban board'))
                )
                ->icon('heroicon-o-view-columns')
                ->color('gray')
                ->url(function () {
                    if ('scrum' === $this->record->type) {
                        return route('filament.pages.scrum/{project}', ['project' => $this->record->id]);
                    }

                    return route('filament.pages.kanban/{project}', ['project' => $this->record->id]);
                }),

            EditAction::make(),
        ];
    }
}

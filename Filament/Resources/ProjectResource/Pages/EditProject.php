<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Ticket\Filament\Resources\ProjectResource;

/**
 * @property Project $record
 */
class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('kanban')
                ->label(
                    fn () => ('scrum' === $this->record->type ? __('Scrum board') : __('Kanban board'))
                )
                ->icon('heroicon-o-view-columns')
                ->color('gray')
                ->url(function () {
                    if ('scrum' === $this->record->type) {
                        return route('filament.pages.scrum/{project}', ['project' => $this->record->id]);
                    } else {
                        return route('filament.pages.kanban/{project}', ['project' => $this->record->id]);
                    }
                }),

            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

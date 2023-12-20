<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Ticket\Helpers\KanbanScrumHelper;
use Modules\Ticket\Models\Project;

/**
 * @property ComponentContainer $form
 */
class Kanban extends Page implements HasForms
{
    use InteractsWithForms;
    use KanbanScrumHelper;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $slug = 'kanban/{project}';

    protected static string $view = 'ticket::filament.pages.kanban';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * @var array<int|string, string>
     */
    protected $listeners = [
        'recordUpdated',
        'closeTicketDialog',
    ];

    public function mount(Project $project): void
    {
        $this->project = $project;
        if ('scrum' === $this->project->type) {
            $this->redirect(route('filament.pages.scrum/{project}', ['project' => $project]));
        } elseif (
            $this->project->owner_id !== auth()->id()
            && ! $this->project->users->where('id', auth()->id())->count()
        ) {
            abort(403);
        }

        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->button()
                ->label(__('Refresh'))
                ->color('gray')
                ->action(function (): void {
                    $this->getRecords();
                    // Filament::notify('success', __('Kanban board updated'));
                    Notification::make()
                        ->title(__('Kanban board updated'))
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getHeading(): string|Htmlable
    {
        return $this->kanbanHeading();
    }

    protected function getFormSchema(): array
    {
        return $this->formSchema();
    }
}

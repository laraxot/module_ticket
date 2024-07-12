<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Ticket\Helpers\KanbanScrumHelper;
use Modules\Ticket\Models\Project;

/**
 * @property ComponentContainer $form
 */
class Scrum extends Page implements HasForms
{
    use InteractsWithForms;
    use KanbanScrumHelper;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $slug = 'scrum/{project}';

    protected static string $view = 'filament.pages.scrum';

    protected static bool $shouldRegisterNavigation = false;

    /** @var array<int, string> */
    protected $listeners = [
        'recordUpdated',
        'closeTicketDialog',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        if ('scrum' !== $this->project->type) {
            $this->redirect(route('filament.pages.kanban/{project}', ['project' => $project]));
        } elseif (
            $this->project->owner_id != authId()
            && ! $this->project->users->where('id', authId())->count()
        ) {
            abort(403);
        }
        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('manage-sprints')
                ->button()
                ->visible(fn () => $this->project->currentSprint && auth()->user()->can('update', $this->project))
                ->label(__('Manage sprints'))
                ->color('primary')
                ->url(route('filament.resources.projects.edit', $this->project)),

            Action::make('refresh')
                ->button()
                ->visible(fn () => $this->project->currentSprint)
                ->label(__('Refresh'))
                ->color('gray')
                ->action(function () {
                    $this->getRecords();
                    Filament::notify('success', __('Kanban board updated'));
                }),
        ];
    }

    public function getHeading(): string|Htmlable
    {
        return $this->scrumHeading();
    }

    public function getSubheading(): string|Htmlable|null
    {
        return $this->scrumSubHeading();
    }

    protected function getFormSchema(): array
    {
        return $this->formSchema();
    }
}

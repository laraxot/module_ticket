<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Ticket\Helpers\KanbanScrumHelper;
use Modules\Ticket\Models\Project;

class Kanban extends Page implements HasForms
{
    use InteractsWithForms;
    use KanbanScrumHelper;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $slug = 'kanban/{project}';

    protected static string $view = 'filament.pages.kanban';

    protected static bool $shouldRegisterNavigation = false;

    protected $listeners = [
        'recordUpdated',
        'closeTicketDialog',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        if ('scrum' === $this->project->type) {
            $this->redirect(route('filament.pages.scrum/{project}', ['project' => $project]));
        } elseif (
            $this->project->owner_id != auth()->user()->id
            && ! $this->project->users->where('id', auth()->user()->id)->count()
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
                ->action(function () {
                    $this->getRecords();
                    Filament::notify('success', __('Kanban board updated'));
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

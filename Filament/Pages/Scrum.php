<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Ticket\Helpers\KanbanScrumHelper;
use Modules\Ticket\Models\Project;
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 */
class Scrum extends Page implements HasForms
{
    use InteractsWithForms;
    use KanbanScrumHelper;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $slug = 'scrum/{project}';

    protected static string $view = 'ticket::filament.pages.scrum';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * @var array<string>
     */
    protected $listeners = [
        'recordUpdated',
        'closeTicketDialog',
    ];

    public function mount(Project $project): void
    {
        $this->project = $project;
        if ('scrum' !== $this->project->type) {
            $this->redirect(route('filament.pages.kanban/{project}', ['project' => $project]));
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
        if (null == $this->project) {
            return [];
        }
        Assert::notNull(auth()->user());

        return [
            Action::make('manage-sprints')
                ->button()
                ->visible(fn (): bool => $this->project->currentSprint && auth()->user()->can('update', $this->project))
                ->label(__('Manage sprints'))
                ->color('primary')
                ->url(route('filament.resources.projects.edit', $this->project)),

            Action::make('refresh')
                ->button()
                ->visible(fn () => $this->project->currentSprint)
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

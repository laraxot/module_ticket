<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Ticket\Models\Project;
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 */
class Board extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static string $view = 'ticket::filament.pages.board';

    protected static ?string $slug = 'board';

    protected static ?int $navigationSort = 4;

    public function getSubheading(): string|Htmlable|null
    {
        return __("In this section you can choose one of your projects to show it's Scrum or Kanban board");
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public static function getNavigationLabel(): string
    {
        return __('Board');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Management');
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    Grid::make()
                        ->columns(1)
                        ->schema([
                            /*
                            Select::make('project')
                                ->label(__('Project'))
                                ->required()
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(fn () => $this->search())
                                ->helperText(__("Choose a project to show it's board"))
                                ->options(static fn () => Project::where('owner_id', auth()->id())
                                    ->orWhereHas('users', static function ($query) {
                                        return $query->where('users.id', auth()->id());
                                    })->pluck('name', 'id')->toArray()),
                            */
                        ]),
                ]),
        ];
    }

    public function search(): void
    {
        $data = $this->form->getState();
        $project = Project::find($data['project']);
        Assert::isInstanceOf($project, Project::class);
        if ('scrum' === $project->type) {
            $this->redirect(route('filament.pages.scrum/{project}', ['project' => $project]));
        } else {
            $this->redirect(route('filament.pages.kanban/{project}', ['project' => $project]));
        }
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\RoadMap;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Models\TicketStatus;
use Modules\Ticket\Models\TicketType;
use Modules\User\Models\User;

class IssueForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Project $project = null;
    public array $epics;
    public array $sprints;

    public function mount(): void
    {
        $this->initProject($this->project?->id);
        if ('custom' === $this->project?->status_type) {
            $defaultStatus = TicketStatus::where('project_id', $this->project->id)
                ->where('is_default', true)
                ->first()
                ?->id;
        } else {
            $defaultStatus = TicketStatus::whereNull('project_id')
                ->where('is_default', true)
                ->first()
                ?->id;
        }
        $this->form->fill([
            'project_id' => $this->project?->id ?? null,
            'owner_id' => authId(),
            'status_id' => $defaultStatus,
            'type_id' => TicketType::where('is_default', true)->first()?->id,
            'priority_id' => TicketPriority::where('is_default', true)->first()?->id,
        ]);
    }

    public function render()
    {
        return view('livewire.road-map.issue-form');
    }

    private function initProject($projectId): void
    {
        if ($projectId) {
            $this->project = Project::where('id', $projectId)->first();
        } else {
            $this->project = null;
        }
        $this->epics = $this->project ? $this->project->epics->pluck('name', 'id')->toArray() : [];
        $this->sprints = $this->project ? $this->project->sprints->pluck('name', 'id')->toArray() : [];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Grid::make(4)
                        ->schema([
                            Forms\Components\Select::make('project_id')
                                ->label(__('Project'))
                                ->searchable()
                                ->reactive()
                                ->disabled(null != $this->project)
                                ->columnSpan(2)
                                ->options(fn () => Project::where('owner_id', authId())
                                    ->orWhereHas('users', function ($query) {
                                        return $query->where('users.id', authId());
                                    })->pluck('name', 'id')->toArray()
                                )
                                ->afterStateUpdated(fn (Forms\Get $get) => $this->initProject($get('project_id')))
                                ->required(),

                            Forms\Components\Select::make('sprint_id')
                                ->label(__('Sprint'))
                                ->searchable()
                                ->reactive()
                                ->visible(fn () => $this->project && 'scrum' === $this->project->type)
                                ->columnSpan(2)
                                ->options(fn () => $this->sprints),

                            Forms\Components\Select::make('epic_id')
                                ->label(__('Epic'))
                                ->searchable()
                                ->reactive()
                                ->columnSpan(2)
                                ->required()
                                ->visible(fn () => $this->project && 'scrum' !== $this->project->type)
                                ->options(fn () => $this->epics),

                            Forms\Components\TextInput::make('name')
                                ->label(__('Ticket name'))
                                ->required()
                                ->columnSpan(4)
                                ->maxLength(255),
                        ]),

                    Forms\Components\Select::make('owner_id')
                        ->label(__('Ticket owner'))
                        ->searchable()
                        ->options(fn () => User::all()->pluck('name', 'id')->toArray())
                        ->required(),

                    Forms\Components\Select::make('responsible_id')
                        ->label(__('Ticket responsible'))
                        ->searchable()
                        ->options(fn () => User::all()->pluck('name', 'id')->toArray()),

                    Forms\Components\Grid::make()
                        ->columns(3)
                        ->columnSpan(2)
                        ->schema([
                            Forms\Components\Select::make('status_id')
                                ->label(__('Ticket status'))
                                ->searchable()
                                ->options(function ($get) {
                                    if ('custom' === $this->project?->status_type) {
                                        return TicketStatus::where('project_id', $this->project->id)
                                            ->get()
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    } else {
                                        return TicketStatus::whereNull('project_id')
                                            ->get()
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    }
                                })
                                ->required(),

                            Forms\Components\Select::make('type_id')
                                ->label(__('Ticket type'))
                                ->searchable()
                                ->options(fn () => TicketType::all()->pluck('name', 'id')->toArray())
                                ->required(),

                            Forms\Components\Select::make('priority_id')
                                ->label(__('Ticket priority'))
                                ->searchable()
                                ->options(fn () => TicketPriority::all()->pluck('name', 'id')->toArray())
                                ->required(),
                        ]),
                ]),

            Forms\Components\RichEditor::make('content')
                ->label(__('Ticket content'))
                ->required()
                ->columnSpan(2),

            Forms\Components\Grid::make()
                ->columnSpan(2)
                ->columns(12)
                ->schema([
                    Forms\Components\TextInput::make('estimation')
                        ->label(__('Estimation time'))
                        ->numeric()
                        ->columnSpan(4),
                ]),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        Ticket::create($data);
        Filament::notify('success', __('Ticket successfully saved'));
        $this->cancel(true);
    }

    public function cancel($refresh = false): void
    {
        $this->dispatch('closeTicketDialog', $refresh);
    }
}

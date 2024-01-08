<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Actions\Project\GetBuilderByUserIdAction;
use Modules\Ticket\Models\Epic;
use Modules\Ticket\Models\Project;
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 */
class RoadMap extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'ticket::filament.pages.road-map';

    protected static ?string $slug = 'road-map';

    protected static ?int $navigationSort = 5;

    public Project $project;

    public ?Epic $epic = null;

    public bool $ticket = false;

    /**
     * @var array<int|string, string>
     */
    protected $listeners = [
        'closeEpicDialog' => 'closeDialog',
        'closeTicketDialog' => 'closeDialog',
        'updateEpic',
    ];

    public static function getNavigationLabel(): string
    {
        return __('Road Map');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Management');
    }

    public function mount(): void
    {
        $p = request()->get('p');
        if ($p && $project = $this->projectQuery()->where('id', $p)->first()) {
            Assert::isInstanceOf($project, Project::class);
            $this->project = $project;
        } else {
            Assert::isInstanceOf($first_project = $this->projectQuery()->first(), Project::class);
            Assert::notNull($first_project);
            $this->project = $first_project;
        }

        if ($this->project !== null) {
            $this->form->fill([
                'selectedProject' => $this->project->id,
            ]);
        }
        // else {
        //     $this->form->fill();
        // }
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('selectedProject')
                ->placeholder(__('Project'))
                ->disableLabel()
                ->searchable()
                ->extraAttributes([
                    'class' => 'min-w-[16rem]',
                ])
                ->disablePlaceholderSelection()
                ->required()
                ->options(fn () => $this->projectQuery()
                    ->get()
                    ->pluck('name', 'id')
                    ->toArray()),
        ];
    }

    public function filter(): void
    {
        $data = $this->form->getState();
        $project = $data['selectedProject'];
        Assert::notNull(Project::where('id', $project)->first());
        $this->project = Project::where('id', $project)->first();
        $this->dispatch('projectChanged', [
            'url' => route('road-map.data', $this->project),
            'start_date' => Carbon::parse($this->project->epicsFirstDate)->subYear()->format('Y-m-d'),
            'end_date' => Carbon::parse($this->project->epicsLastDate)->addYear()->format('Y-m-d'),
            'scroll_to' => Carbon::parse($this->project->epicsFirstDate)->subDays(5)->format('Y-m-d'),
        ]);
    }

    public function createTicket(): void
    {
        $this->ticket = true;
    }

    public function createEpic(): void
    {
        $this->epic = new Epic;
        $this->epic->project_id = $this->project->id;
    }

    public function updateEpic(int $epicId): void
    {
        $this->epic = Epic::where('id', $epicId)->first();
    }

    public function closeDialog(bool $refresh): void
    {
        $this->epic = null;
        $this->ticket = false;
        if ($refresh) {
            $this->filter();
        }
    }

    private function projectQuery(): Builder
    {
        Assert::string($user_id = Filament::auth()->id());

        return app(GetBuilderByUserIdAction::class)->execute($user_id);
        /*
        return Project::where(static function ($query) {
            return $query->where('owner_id', auth()->id())
                ->orWhereHas('users', static function ($query) {
                    return $query->where('users.id', auth()->id());
                });
        });
        */
    }
}

<?php

namespace Modules\Ticket\Filament\Widgets;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions\Action;
use Modules\Ticket\Models\Epic;
use Modules\Geo\Models\Location;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\TicketType;
use Modules\Ticket\Models\TicketStatus;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Models\TicketPriority;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapWidget;
use Cheesegrits\FilamentGoogleMaps\Actions\GoToAction;
use Cheesegrits\FilamentGoogleMaps\Filters\MapIsFilter;
use Cheesegrits\FilamentGoogleMaps\Actions\RadiusAction;
use Cheesegrits\FilamentGoogleMaps\Filters\RadiusFilter;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapTableWidget;

class TicketsMapTableWidget extends MapTableWidget
{
    protected static ?string $heading = 'Location Map';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected static ?bool $clustering = true;

    protected static ?bool $fitToBounds = true;

    protected static ?string $mapId = 'incidents';

    protected static ?bool $filtered = true;

    protected static bool $collapsible = true;

    public ?bool $mapIsFilter = false;

    protected static ?string $markerAction = 'markerAction';

    public function getConfig(): array
    {
        $config = parent::getConfig();

        // Disable points of interest
        //        $config['mapConfig']['styles'] = [
        //            [
        //                'featureType' => 'poi',
        //                'elementType' => 'labels',
        //                'stylers' => [
        //                    ['visibility' => 'off'],
        //                ],
        //            ],
        //        ];

        //        $config['zoom'] = 5;
        $config['center'] = [
            'lat' => 34.730369,
            'lng' => -86.586104,
        ];

        return $config;
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(256),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(32),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(32),
                Forms\Components\TextInput::make('street')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip')
                    ->maxLength(255),
                Forms\Components\TextInput::make('formatted_address')
                    ->maxLength(1024),

            ])
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Location::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('street')
                ->searchable(),
            Tables\Columns\TextColumn::make('city')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('state')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('zip'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            RadiusFilter::make('location')
                ->section('Radius Filter')
                ->selectUnit(),
            MapIsFilter::make('map'),
        ];
    }

    protected function getTableRecordAction(): ?string
    {
        return 'edit';
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make()
            // ->form($this->getFormSchema()),
            ->form($this->getFormSchema2()),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make()
                ->form($this->getFormSchema()),
            Tables\Actions\EditAction::make()
                ->form($this->getFormSchema()),
            GoToAction::make()
                ->zoom(fn () => 14),
            RadiusAction::make('location'),

        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    protected function getData(): array
    {
        $locations = $this->getRecords();

        $data = [];

        foreach ($locations as $location) {
            $data[] = [
                'location' => [
                    'lat' => $location->lat ? round(floatval($location->lat), static::$precision) : 0,
                    'lng' => $location->lng ? round(floatval($location->lng), static::$precision) : 0,
                ],
                'label'    => $location->formatted_address,
                'id'       => $location->id,
                'icon' => [
                    //'url' => url('images/dealership.svg'),
                    'url' => url('images/fire.svg'),
                    'type' => 'svg',
                    'scale' => [35,35],
                ],
            ];
        }

        return $data;
    }

    public function markerAction(): Action
    {
        return Action::make('markerAction')
            ->label('Details')
            ->infolist([
                Section::make([
                    TextEntry::make('name'),
                    TextEntry::make('street'),
                    TextEntry::make('city'),
                    TextEntry::make('state'),
                    TextEntry::make('zip'),
                    TextEntry::make('formatted_address'),
                ])
                    ->columns(3)
            ])
            ->record(function (array $arguments) {
                return array_key_exists('model_id', $arguments) ? Location::find($arguments['model_id']) : null;
            })
            ->modalSubmitAction(false);
    }

    public function getFormSchema2(): array
    {
        return [
            Forms\Components\Section::make()
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        /*
                        Forms\Components\Select::make('project_id')
                            ->label(__('Project'))
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($get, $set) {
                                $project = Project::where('id', $get('project_id'))->first();
                                if ($project?->status_type === 'custom') {
                                    $set(
                                        'status_id',
                                        TicketStatus::where('project_id', $project->id)
                                            ->where('is_default', true)
                                            ->first()
                                            ?->id
                                    );
                                } else {
                                    $set(
                                        'status_id',
                                        TicketStatus::whereNull('project_id')
                                            ->where('is_default', true)
                                            ->first()
                                            ?->id
                                    );
                                }
                            })
                            ->options(fn() => Project::where('owner_id', auth()->user()->id)
                                ->orWhereHas('users', function ($query) {
                                    return $query->where('users.id', auth()->user()->id);
                                })->pluck('name', 'id')->toArray()
                            )
                            ->default(fn() => request()->get('project'))
                            ->required(),
                        */
                        Forms\Components\Select::make('epic_id')
                            ->label(__('Epic'))
                            ->searchable()
                            ->reactive()
                            ->options(function ($get, $set) {
                                return Epic::where('project_id', $get('project_id'))->pluck('name', 'id')->toArray();
                            }),
                        Forms\Components\Grid::make()
                            ->columns(12)
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label(__('Ticket code'))
                                    ->visible(fn ($livewire) => ! ($livewire instanceof CreateRecord))
                                    ->columnSpan(2)
                                    ->disabled(),

                                Forms\Components\TextInput::make('name')
                                    ->label(__('Ticket name'))
                                    ->required()
                                    ->columnSpan(
                                        fn ($livewire) => ! ($livewire instanceof CreateRecord) ? 10 : 12
                                    )
                                    ->maxLength(255),
                            ]),

                        /*
                        Forms\Components\Select::make('owner_id')
                            ->label(__('Ticket owner'))
                            ->searchable()
                            ->options(fn() => User::all()->pluck('name', 'id')->toArray())
                            ->default(fn() => auth()->user()->id)
                            ->required(),

                        Forms\Components\Select::make('responsible_id')
                            ->label(__('Ticket responsible'))
                            ->searchable()
                            ->options(fn() => User::all()->pluck('name', 'id')->toArray()),
                        */
                        Forms\Components\Grid::make()
                            ->columns(3)
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\Select::make('status_id')
                                    ->label(__('Ticket status'))
                                    ->searchable()
                                    ->options(function ($get) {
                                        $project = Project::where('id', $get('project_id'))->first();
                                        if ('custom' === $project?->status_type) {
                                            return TicketStatus::where('project_id', $project->id)
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
                                    ->default(function ($get) {
                                        $project = Project::where('id', $get('project_id'))->first();
                                        if ('custom' === $project?->status_type) {
                                            return TicketStatus::where('project_id', $project->id)
                                                ->where('is_default', true)
                                                ->first()
                                                ?->id;
                                        } else {
                                            return TicketStatus::whereNull('project_id')
                                                ->where('is_default', true)
                                                ->first()
                                                ?->id;
                                        }
                                    })
                                    ->required(),

                                Forms\Components\Select::make('type_id')
                                    ->label(__('Ticket type'))
                                    ->searchable()
                                    ->options(fn () => TicketType::all()->pluck('name', 'id')->toArray())
                                    ->default(fn () => TicketType::where('is_default', true)->first()?->id)
                                    ->required(),

                                Forms\Components\Select::make('priority_id')
                                    ->label(__('Ticket priority'))
                                    ->searchable()
                                    ->options(fn () => TicketPriority::all()->pluck('name', 'id')->toArray())
                                    ->default(fn () => TicketPriority::where('is_default', true)->first()?->id)
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
                            ->columnSpan(2),
                    ]),

                // Forms\Components\Repeater::make('relations')
                //     ->itemLabel(function (array $state) {
                //         $ticketRelation = TicketRelation::find($state['id'] ?? 0);
                //         if ($ticketRelation) {
                //             return __(config('system.tickets.relations.list.'.$ticketRelation->type))
                //                 .' '
                //                 .$ticketRelation->relation->name
                //                 .' ('.$ticketRelation->relation->code.')';
                //         }

                //         return null;
                //     })
                //     ->relationship()
                //     ->collapsible()
                //     ->collapsed()
                //     ->orderable()
                //     ->defaultItems(0)
                //     ->schema([
                //         Forms\Components\Grid::make()
                //             ->columns(3)
                //             ->schema([
                //                 Forms\Components\Select::make('type')
                //                     ->label(__('Relation type'))
                //                     ->required()
                //                     ->searchable()
                //                     ->options(config('system.tickets.relations.list'))
                //                     ->default(fn () => config('system.tickets.relations.default')),

                //                 Forms\Components\Select::make('relation_id')
                //                     ->label(__('Related ticket'))
                //                     ->required()
                //                     ->searchable()
                //                     ->columnSpan(2)
                //                     ->options(function ($livewire) {
                //                         $query = Ticket::query();
                //                         if ($livewire instanceof EditRecord && $livewire->record) {
                //                             $query->where('id', '<>', $livewire->record->id);
                //                         }

                //                         return $query->get()->pluck('name', 'id')->toArray();
                //                     }),
                //             ]),
                //     ]),
                ])
            ];
    }

}

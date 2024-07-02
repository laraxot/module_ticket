<?php
declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Forms;
use Illuminate\Support\Str;
use Filament\Widgets\Widget;
use Modules\Ticket\Models\Epic;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\TicketType;
use Filament\Forms\Contracts\HasForms;
use Modules\Ticket\Models\TicketStatus;
use Modules\Ticket\Models\TicketPriority;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Ticket\Filament\Resources\TicketResource;

class LocationFormWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static ?string $heading = 'Location Map';

    protected static string $view = 'ticket::filament.widgets.location-form';
    public float $lat=0;
    public float $lng=0;
    public ?int $err_code=null;
    public ?string $err_message=null;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
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
                                        ->visible(fn($livewire) => !($livewire instanceof CreateRecord))
                                        ->columnSpan(2)
                                        ->disabled(),

                                    Forms\Components\TextInput::make('name')
                                        ->label(__('Ticket name'))
                                        ->required()
                                        ->columnSpan(
                                            fn($livewire) => !($livewire instanceof CreateRecord) ? 10 : 12
                                        )
                                        ->maxLength(255),
                                ]),
                            
                            Forms\Components\Grid::make()
                                ->columns(3)
                                ->columnSpan(2)
                                ->schema([
                                    Forms\Components\Select::make('status_id')
                                        ->label(__('Ticket status'))
                                        ->searchable()
                                        ->options(function ($get) {
                                            $project = Project::where('id', $get('project_id'))->first();
                                            if ($project?->status_type === 'custom') {
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
                                            if ($project?->status_type === 'custom') {
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
                                        ->options(fn() => TicketType::all()->pluck('name', 'id')->toArray())
                                        ->default(fn() => TicketType::where('is_default', true)->first()?->id)
                                        ->required(),

                                    Forms\Components\Select::make('priority_id')
                                        ->label(__('Ticket priority'))
                                        ->searchable()
                                        ->options(fn() => TicketPriority::all()->pluck('name', 'id')->toArray())
                                        ->default(fn() => TicketPriority::where('is_default', true)->first()?->id)
                                        ->required(),
                                ]),
                        ]),

                    Forms\Components\RichEditor::make('content')
                        ->label(__('Ticket content'))
                        ->required()
                        ->columnSpan(2),

                    // Forms\Components\Grid::make()
                    //     ->columnSpan(2)
                    //     ->columns(12)
                    //     ->schema([
                    //         Forms\Components\TextInput::make('estimation')
                    //             ->label(__('Estimation time'))
                    //             ->numeric()
                    //             ->columnSpan(2),
                    //     ]),

                    // Forms\Components\Repeater::make('relations')
                    //     ->itemLabel(function (array $state) {
                    //         $ticketRelation = TicketRelation::find($state['id'] ?? 0);
                    //         if ($ticketRelation) {
                    //             return __(config('system.tickets.relations.list.' . $ticketRelation->type))
                    //                 . ' '
                    //                 . $ticketRelation->relation->name
                    //                 . ' (' . $ticketRelation->relation->code . ')';
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
                    //                     ->default(fn() => config('system.tickets.relations.default')),

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
                ->columnSpanFull(),
            ];
    }
}
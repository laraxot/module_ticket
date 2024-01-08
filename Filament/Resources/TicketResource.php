<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Modules\Ticket\Filament\Resources\TicketResource\Pages\CreateTicket;
use Modules\Ticket\Filament\Resources\TicketResource\Pages\EditTicket;
use Modules\Ticket\Filament\Resources\TicketResource\Pages\ListTickets;
use Modules\Ticket\Filament\Resources\TicketResource\Pages\ViewTicket;
use Modules\Ticket\Models\Epic;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Models\TicketRelation;
use Modules\Ticket\Models\TicketStatus;
use Modules\Ticket\Models\TicketType;
use Modules\User\Models\User;
use Webmozart\Assert\Assert;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Tickets');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Management');
    }

    public static function form(Form $form): Form
    {
        Assert::notNull(auth()->user());

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                /*--passare a field separato
                                Forms\Components\Select::make('project_id')
                                    ->label(__('Project'))
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(static function ($get, $set) {
                                        $project = Project::where('id', $get('project_id'))->first();
                                        if ('custom' === $project?->status_type) {
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
                                    ->options(static fn () => Project::where('owner_id', auth()->id())
                                        ->orWhereHas('users', static function ($query) {
                                            return $query->where('users.id', auth()->id());
                                        })->pluck('name', 'id')->toArray()
                                    )
                                    ->default(static fn () => request()->get('project'))
                                    ->required(),
                                */
                                Select::make('epic_id')
                                    ->label(__('Epic'))
                                    ->searchable()
                                    ->reactive()
                                    ->options(static fn ($get, $set) => Epic::where('project_id', $get('project_id'))->pluck('name', 'id')->toArray()),
                                Grid::make()
                                    ->columns(12)
                                    ->columnSpan(2)
                                    ->schema([
                                        TextInput::make('code')
                                            ->label(__('Ticket code'))
                                            ->visible(static fn ($livewire): bool => ! ($livewire instanceof CreateRecord))
                                            ->columnSpan(2)
                                            ->disabled(),

                                        TextInput::make('name')
                                            ->label(__('Ticket name'))
                                            ->required()
                                            ->columnSpan(
                                                static fn ($livewire): int => $livewire instanceof CreateRecord ? 12 : 10
                                            )
                                            ->maxLength(255),
                                    ]),

                                Select::make('owner_id')
                                    ->label(__('Ticket owner'))
                                    ->searchable()
                                    ->options(static fn () => User::all()->pluck('name', 'id')->toArray())
                                    ->default(static fn () => auth()->id())
                                    ->required(),

                                Select::make('responsible_id')
                                    ->label(__('Ticket responsible'))
                                    ->searchable()
                                    ->options(static fn () => User::all()->pluck('name', 'id')->toArray()),

                                Grid::make()
                                    ->columns(3)
                                    ->columnSpan(2)
                                    ->schema([
                                        Select::make('status_id')
                                            ->label(__('Ticket status'))
                                            ->searchable()
                                            ->options(static function ($get) {
                                                $project = Project::where('id', $get('project_id'))->first();
                                                if ($project?->status_type === 'custom') {
                                                    return TicketStatus::where('project_id', $project->id)
                                                        ->get()
                                                        ->pluck('name', 'id')
                                                        ->toArray();
                                                }

                                                return TicketStatus::whereNull('project_id')
                                                    ->get()
                                                    ->pluck('name', 'id')
                                                    ->toArray();
                                            })
                                            ->default(static function ($get) {
                                                $project = Project::where('id', $get('project_id'))->first();
                                                if ($project?->status_type === 'custom') {
                                                    return TicketStatus::where('project_id', $project->id)
                                                        ->where('is_default', true)
                                                        ->first()
                                                        ?->id;
                                                }

                                                return TicketStatus::whereNull('project_id')
                                                    ->where('is_default', true)
                                                    ->first()
                                                    ?->id;
                                            })
                                            ->required(),

                                        Select::make('type_id')
                                            ->label(__('Ticket type'))
                                            ->searchable()
                                            ->options(static fn () => TicketType::all()->pluck('name', 'id')->toArray())
                                            ->default(static fn () => TicketType::where('is_default', true)->first()?->id)
                                            ->required(),

                                        Select::make('priority_id')
                                            ->label(__('Ticket priority'))
                                            ->searchable()
                                            ->options(static fn () => TicketPriority::all()->pluck('name', 'id')->toArray())
                                            ->default(static fn () => TicketPriority::where('is_default', true)->first()?->id)
                                            ->required(),
                                    ]),
                            ]),

                        RichEditor::make('content')
                            ->label(__('Ticket content'))
                            ->required()
                            ->columnSpan(2),

                        Grid::make()
                            ->columnSpan(2)
                            ->columns(12)
                            ->schema([
                                TextInput::make('estimation')
                                    ->label(__('Estimation time'))
                                    ->numeric()
                                    ->columnSpan(2),
                            ]),

                        Repeater::make('relations')
                            ->itemLabel(static function (array $state): ?string {
                                $ticketRelation = TicketRelation::find($state['id'] ?? 0);
                                if ($ticketRelation) {
                                    Assert::notNull($ticketRelation->relation);

                                    return __(config('system.tickets.relations.list.'.$ticketRelation->type))
                                        .' '
                                        .$ticketRelation->relation->name
                                        .' ('.$ticketRelation->relation->code.')';
                                }

                                return null;
                            })
                            ->relationship()
                            ->collapsible()
                            ->collapsed()
                            ->orderable()
                            ->defaultItems(0)
                            ->schema([
                                Grid::make()
                                    ->columns(3)
                                    ->schema([
                                        Select::make('type')
                                            ->label(__('Relation type'))
                                            ->required()
                                            ->searchable()
                                            ->options(config('system.tickets.relations.list'))
                                            ->default(static fn () => config('system.tickets.relations.default')),

                                        Select::make('relation_id')
                                            ->label(__('Related ticket'))
                                            ->required()
                                            ->searchable()
                                            ->columnSpan(2)
                                            ->options(static function ($livewire) {
                                                $query = Ticket::query();
                                                if ($livewire instanceof EditRecord && $livewire->record) {
                                                    $query->where('id', '<>', $livewire->record->id);
                                                }

                                                return $query->get()->pluck('name', 'id')->toArray();
                                            }),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function tableColumns(bool $withProject = true): array
    {
        $columns = [];
        if ($withProject) {
            $columns[] = TextColumn::make('project.name')
                ->label(__('Project'))
                ->sortable()
                ->searchable();
        }

        return array_merge($columns, [
            TextColumn::make('name')
                ->label(__('Ticket name'))
                ->sortable()
                ->searchable(),

            TextColumn::make('owner.name')
                ->label(__('Owner'))
                ->sortable()
                ->formatStateUsing(static fn ($record) => view('components.user-avatar', ['user' => $record->owner]))
                ->searchable(),

            TextColumn::make('responsible.name')
                ->label(__('Responsible'))
                ->sortable()
                ->formatStateUsing(static fn ($record) => view('components.user-avatar', ['user' => $record->responsible]))
                ->searchable(),

            TextColumn::make('status.name')
                ->label(__('Status'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="flex items-center gap-2 mt-1">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->status->color.'"></span>
                                <span>'.$record->status->name.'</span>
                            </div>
                        '))
                ->sortable()
                ->searchable(),

            TextColumn::make('type.name')
                ->label(__('Type'))
                ->formatStateUsing(
                    static fn ($record) => view('partials.filament.resources.ticket-type', ['state' => $record->type])
                )
                ->sortable()
                ->searchable(),

            TextColumn::make('priority.name')
                ->label(__('Priority'))
                ->formatStateUsing(static fn ($record): HtmlString => new HtmlString('
                            <div class="flex items-center gap-2 mt-1">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->priority->color.'"></span>
                                <span>'.$record->priority->name.'</span>
                            </div>
                        '))
                ->sortable()
                ->searchable(),

            TextColumn::make('created_at')
                ->label(__('Created at'))
                ->dateTime()
                ->sortable()
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::tableColumns())
            ->filters([
                /*-- fare filtro separato
                Tables\Filters\SelectFilter::make('project_id')
                    ->label(__('Project'))
                    ->multiple()
                    ->options(static fn () => Project::where('owner_id', auth()->id())
                        ->orWhereHas('users', static function ($query) {
                            return $query->where('users.id', auth()->id());
                        })->pluck('name', 'id')->toArray()),
                */
                SelectFilter::make('owner_id')
                    ->label(__('Owner'))
                    ->multiple()
                    ->options(static fn () => User::all()->pluck('name', 'id')->toArray()),

                SelectFilter::make('responsible_id')
                    ->label(__('Responsible'))
                    ->multiple()
                    ->options(static fn () => User::all()->pluck('name', 'id')->toArray()),

                SelectFilter::make('status_id')
                    ->label(__('Status'))
                    ->multiple()
                    ->options(static fn () => TicketStatus::all()->pluck('name', 'id')->toArray()),

                SelectFilter::make('type_id')
                    ->label(__('Type'))
                    ->multiple()
                    ->options(static fn () => TicketType::all()->pluck('name', 'id')->toArray()),

                SelectFilter::make('priority_id')
                    ->label(__('Priority'))
                    ->multiple()
                    ->options(static fn () => TicketPriority::all()->pluck('name', 'id')->toArray()),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'view' => ViewTicket::route('/{record}'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }
}

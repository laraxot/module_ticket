<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\ProjectResource\RelationManagers;

use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\Sprint;
use Modules\Ticket\Models\Ticket;

class SprintsRelationManager extends RelationManager
{
    protected static string $relationship = 'sprints';

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * @param Project $ownerRecord
     */
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        // Access to an undefined property Illuminate\Database\Eloquent\Model::$type
        return 'scrum' === $ownerRecord->type;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(1)
                    ->visible(static fn ($record): bool => ! $record)
                    ->extraAttributes([
                        'class' => 'text-danger-500 text-xs',
                    ])
                    ->schema([
                        Placeholder::make('information')
                            ->disableLabel()
                            ->content(new HtmlString(
                                '<span class="font-medium">'.__('Important:').'</span> '.
                                __('The creation of a new Sprint will create a linked Epic into to the Road Map')
                            )),
                    ]),

                Grid::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Sprint name'))
                            ->maxLength(255)
                            ->columnSpan(2)
                            ->required(),

                        DatePicker::make('starts_at')
                            ->label(__('Sprint start date'))
                            ->reactive()
                            ->afterStateUpdated(static fn ($state, Set $set): mixed => $set('ends_at', Carbon::parse($state)->addWeek()->subDay()))
                            ->beforeOrEqual(static fn (Get $get): mixed => $get('ends_at'))
                            ->required(),

                        DatePicker::make('ends_at')
                            ->label(__('Sprint end date'))
                            ->reactive()
                            ->afterOrEqual(static fn (Get $get): mixed => $get('starts_at'))
                            ->required(),

                        RichEditor::make('description')
                            ->label(__('Sprint description'))
                            ->columnSpan(2),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Sprint name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('starts_at')
                    ->label(__('Sprint start date'))
                    ->date()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('ends_at')
                    ->label(__('Sprint end date'))
                    ->date()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('started_at')
                    ->label(__('Sprint started at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('ended_at')
                    ->label(__('Sprint ended at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('remaining')
                    ->label(__('Remaining'))
                    ->suffix(static fn ($record): string => $record->remaining ? (' '.__('days')) : '')
                    ->sortable()
                    ->searchable(),

                TagsColumn::make('tickets.name')
                    ->label(__('Tickets'))
                    ->searchable()
                    ->sortable()
                    ->limit(),
            ])
            ->filters([
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('start')
                    ->label(__('Start sprint'))
                    ->visible(static fn ($record): bool => ! $record->started_at && ! $record->ended_at)
                    ->requiresConfirmation()
                    ->color('success')
                    ->button()
                    ->icon('heroicon-o-play')
                    ->action(static function ($record): void {
                        $now = now();
                        Sprint::where('project_id', $record->project_id)
                            ->where('id', '<>', $record->id)
                            ->whereNotNull('started_at')
                            ->whereNull('ended_at')
                            ->update(['ended_at' => $now]);
                        $record->started_at = $now;
                        $record->save();
                        Notification::make('sprint_started')
                            ->success()
                            ->body(__('Sprint started at').' '.$now)
                            ->actions([
                                Action::make('board')
                                    ->color('gray')
                                    ->button()
                                    ->label(
                                        static fn () => ('scrum' === $record->project->type ? __('Scrum board') : __('Kanban board'))
                                    )
                                    ->url(static function () use ($record) {
                                        if ('scrum' === $record->project->type) {
                                            return route('filament.pages.scrum/{project}', ['project' => $record->project->id]);
                                        }

                                        return route('filament.pages.kanban/{project}', ['project' => $record->project->id]);
                                    }),
                            ])
                            ->send();
                    }),

                Tables\Actions\Action::make('stop')
                    ->label(__('Stop sprint'))
                    ->visible(static fn ($record): bool => $record->started_at && ! $record->ended_at)
                    ->requiresConfirmation()
                    ->color('danger')
                    ->button()
                    ->icon('heroicon-o-pause')
                    ->action(static function ($record): void {
                        $now = now();
                        $record->ended_at = $now;
                        $record->save();

                        Notification::make('sprint_started')
                            ->success()
                            ->body(__('Sprint ended at').' '.$now)
                            ->send();
                    }),

                Tables\Actions\Action::make('tickets')
                    ->label(__('Tickets'))
                    ->color('gray')
                    ->icon('heroicon-o-ticket')
                    ->mountUsing(static fn (ComponentContainer $form, Sprint $record): ComponentContainer => $form->fill([
                        'tickets' => $record->tickets->pluck('id')->toArray(),
                    ]))
                    ->modalHeading(static fn ($record): string => $record->name.' - '.__('Associated tickets'))
                    ->form([
                        Placeholder::make('info')
                            ->disableLabel()
                            ->extraAttributes([
                                'class' => 'text-danger-500 text-xs',
                            ])
                            ->content(
                                __('If a ticket is already associated with an other sprint, it will be migrated to this sprint')
                            ),

                        CheckboxList::make('tickets')
                            ->label(__('Choose tickets to associate to this sprint'))
                            ->required()
                            ->extraAttributes([
                                'class' => 'sprint-checkboxes',
                            ])
                            ->options(
                                static function ($record): array {
                                    $results = [];
                                    foreach ($record->project->tickets as $ticket) {
                                        $results[$ticket->id] = new HtmlString(
                                            '<div class="w-full flex justify-between items-center"><span>'.$ticket->name.'</span>'
                                            .($ticket->sprint ? '<span class="text-xs font-medium '
                                                .($ticket->sprint_id === $record->id ? 'bg-gray-100 text-gray-600' : 'bg-danger-500 text-white')
                                                .' px-2 py-1 rounded">'.$ticket->sprint->name.'</span>' : '')
                                            .'</div>'
                                        );
                                    }

                                    return $results;
                                }
                            ),
                    ])
                    ->action(static function (Sprint $record, array $data): void {
                        $tickets = $data['tickets'];
                        Ticket::where('sprint_id', $record->id)->update(['sprint_id' => null]);
                        Ticket::whereIn('id', $tickets)->update(['sprint_id' => $record->id]);
                        // Filament::notify('success', __('Tickets associated with sprint'));
                        Notification::make()
                            ->title(__('Tickets associated with sprint'))
                            ->success()
                            ->send();
                    }),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('id');
    }

    protected function canAttach(): bool
    {
        return false;
    }
}

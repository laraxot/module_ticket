<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Modules\Ticket\Filament\Resources\TicketResource;
use Modules\Ticket\Filament\Resources\TicketResource\Actions\Header\CreateGeoTicketHeaderAction;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Models\TicketStatus;
use Modules\Ticket\Models\TicketType;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            CreateGeoTicketHeaderAction::make('create-geo'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            // ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions());
    }

    public function getTableColumns(bool $withProject = true): array
    {
        $columns = [];
        if ($withProject) {
            $columns[] = Tables\Columns\TextColumn::make('project.name')
                ->label(__('Project'))
                ->sortable()
                ->searchable();
        }
        $columns = array_merge($columns, [
            Tables\Columns\TextColumn::make('name')
                ->label(__('Ticket name'))
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('owner.name')
                ->label(__('Owner'))
                ->sortable()
                ->formatStateUsing(fn ($record) => view('components.user-avatar', ['user' => $record->owner]))
                ->searchable(),

            Tables\Columns\TextColumn::make('responsible.name')
                ->label(__('Responsible'))
                ->sortable()
                ->formatStateUsing(fn ($record) => view('components.user-avatar', ['user' => $record->responsible]))
                ->searchable(),

            Tables\Columns\TextColumn::make('status.name')
                ->label(__('Status'))
                ->formatStateUsing(fn ($record) => new HtmlString('
                            <div class="flex items-center gap-2 mt-1">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->status->color.'"></span>
                                <span>'.$record->status->name.'</span>
                            </div>
                        '))
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('type.name')
                ->label(__('Type'))
                ->formatStateUsing(
                    fn ($record) => view('partials.filament.resources.ticket-type', ['state' => $record->type])
                )
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('priority.name')
                ->label(__('Priority'))
                ->formatStateUsing(fn ($record) => new HtmlString('
                            <div class="flex items-center gap-2 mt-1">
                                <span class="filament-tables-color-column relative flex h-6 w-6 rounded-md"
                                    style="background-color: '.$record->priority->color.'"></span>
                                <span>'.$record->priority->name.'</span>
                            </div>
                        '))
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label(__('Created at'))
                ->dateTime()
                ->sortable()
                ->searchable(),
        ]);

        return $columns;
    }

    public function getTableFilters(): array
    {
        return [
            /*
                Tables\Filters\SelectFilter::make('project_id')
                    ->label(__('Project'))
                    ->multiple()
                    ->options(fn() => Project::where('owner_id', auth()->user()->id)
                        ->orWhereHas('users', function ($query) {
                            return $query->where('users.id', auth()->user()->id);
                        })->pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('owner_id')
                    ->label(__('Owner'))
                    ->multiple()
                    ->options(fn() => User::all()->pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('responsible_id')
                    ->label(__('Responsible'))
                    ->multiple()
                    ->options(fn() => User::all()->pluck('name', 'id')->toArray()),
                */
            Tables\Filters\SelectFilter::make('status_id')
                ->label(__('Status'))
                ->multiple()
                ->options(fn () => TicketStatus::all()->pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('type_id')
                ->label(__('Type'))
                ->multiple()
                ->options(fn () => TicketType::all()->pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('priority_id')
                ->label(__('Priority'))
                ->multiple()
                ->options(fn () => TicketPriority::all()->pluck('name', 'id')->toArray()),
        ];
    }

    public function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    /*
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where(function ($query) {
                return $query->where('owner_id', auth()->user()->id)
                    ->orWhere('responsible_id', auth()->user()->id)
                    ->orWhereHas('project', function ($query) {
                        return $query->where('owner_id', auth()->user()->id)
                            ->orWhereHas('users', function ($query) {
                                return $query->where('users.id', auth()->user()->id);
                            });
                    });
            });
    }
    */
}

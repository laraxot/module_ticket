<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\GeoTicketResource\Pages;

use Cheesegrits\FilamentGoogleMaps\Actions\GoToAction;
use Cheesegrits\FilamentGoogleMaps\Actions\RadiusAction;
use Cheesegrits\FilamentGoogleMaps\Filters\MapIsFilter;
use Cheesegrits\FilamentGoogleMaps\Filters\RadiusFilter;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Resources\GeoTicketResource;

class ListGeoTickets extends ListRecords
{
    protected static string $resource = GeoTicketResource::class;

    // protected static ?string $heading = 'Location Map';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected static ?bool $clustering = true;

    protected static ?bool $fitToBounds = true;

    protected static ?string $mapId = 'incidents';

    protected static ?bool $filtered = true;

    protected static bool $collapsible = true;

    public ?bool $mapIsFilter = false;

    protected static ?string $markerAction = 'markerAction';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            // Tables\Columns\TextColumn::make('priority.name')
            //    ->searchable(),
            Tables\Columns\TextColumn::make('priority')
                ->searchable(),
            // Tables\Columns\TextColumn::make('type.name')
            //    ->searchable(),
            Tables\Columns\TextColumn::make('type')
                ->searchable(),
            // Tables\Columns\TextColumn::make('latitude')
            //    ->searchable(),
            // Tables\Columns\TextColumn::make('longitude')
            //    ->searchable(),
            // Tables\Columns\TextColumn::make('street')
            //     ->searchable(),
            // Tables\Columns\TextColumn::make('city')
            //     ->searchable()
            //     ->sortable(),
            // Tables\Columns\TextColumn::make('state')
            //     ->searchable()
            //     ->sortable(),
            // Tables\Columns\TextColumn::make('zip'),
            SpatieMediaLibraryImageColumn::make('images')
                // ->conversion('thumb')
                ->collection('ticket'),
        ];
    }

    public function getTableActions(): array
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

    public function getTableFilters(): array
    {
        return [
            RadiusFilter::make('location')
                ->section('Radius Filter')
                ->selectUnit(),
            MapIsFilter::make('map'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->filters($this->getTableFilters())
            ->actions($this->getTableActions())
            // ->bulkActions()
        ;
    }
}

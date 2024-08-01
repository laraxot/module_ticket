<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Cheesegrits\FilamentGoogleMaps\Widgets\MapTableWidget;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\Action as LoginAction;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Filament\Resources\GeoTicketResource;
use Modules\Ticket\Filament\Resources\GeoTicketResource\Pages\ListGeoTickets;
use Modules\Ticket\Models\GeoTicket;
use Modules\Ticket\Models\Ticket;

/**
 * @property \Filament\Forms\ComponentContainer $form
 */
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

    protected function getTableQuery(): Builder
    {
        // dddx(Ticket::query()->latest()->first());
        return GeoTicket::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return app(ListGeoTickets::class)->getTableColumns();
    }

    protected function getTableFilters(): array
    {
        return app(ListGeoTickets::class)->getTableFilters();
    }

    protected function getTableRecordAction(): ?string
    {
        return 'edit';
    }

    protected function getTableHeaderActions(): array
    {
        if (Auth::guest()) {
            return [
                LoginAction::make('Nuovo')
                    ->modalHeading('Devi loggarti per poter creare un ticket')
                    ->modalContent(view('ticket::filament.widgets.login'))
                    ->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'])
                    ->modalWidth(MaxWidth::Medium)
                    ->modalSubmitAction(false),
            ];
        } else {
            return [
                CreateAction::make()
                    ->form($this->getFormSchema())
                    ->createAnother(false)
                    ->modalSubmitAction(fn (StaticAction $action) => $action->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']))
                    ->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']),
            ];
        }

        // return [
        //     CreateAction::make()

        //     ->form($this->getFormSchema())
        //     ->createAnother(false)
        //     ->modalSubmitAction(fn (StaticAction $action) => $action->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']))
        //     ->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']),
        // ];
    }

    protected function getTableActions(): array
    {
        return app(ListGeoTickets::class)->getTableActions();
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
                'label' => $location->formatted_address,
                'id' => $location->id,
                'icon' => [
                    // 'url' => url('images/dealership.svg'),
                    'url' => url('images/fire.svg'),
                    'type' => 'svg',
                    'scale' => [35, 35],
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
                    ->columns(3),
            ])
            ->record(function (array $arguments) {
                return array_key_exists('model_id', $arguments) ? GeoTicket::find($arguments['model_id']) : null;
            })
            ->modalSubmitAction(false);
    }

    public function getFormSchema(): array
    {
        return GeoTicketResource::getFormSchema();
    }
}

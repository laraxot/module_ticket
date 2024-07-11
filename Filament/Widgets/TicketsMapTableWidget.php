<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Cheesegrits\FilamentGoogleMaps\Actions\GoToAction;
use Cheesegrits\FilamentGoogleMaps\Actions\RadiusAction;
use Cheesegrits\FilamentGoogleMaps\Filters\MapIsFilter;
use Cheesegrits\FilamentGoogleMaps\Filters\RadiusFilter;
use Cheesegrits\FilamentGoogleMaps\Widgets\MapTableWidget;
use Dotswan\MapPicker\Fields\Map;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Models\TicketType;

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
        return Ticket::query()->latest();
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
            SpatieMediaLibraryImageColumn::make('images')
                // ->conversion('thumb')
                ->collection('ticket'),
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

            ->form($this->getFormSchema())
            ->createAnother(false)
            ->modalSubmitAction(fn (StaticAction $action) => $action->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']))
            ->extraAttributes(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'])
            /*
            ->using(function (array $data, string $model): Ticket {
                // dddx([$data, $model]);
                $ticket = Ticket::create([
                    'name' => $data['name'],
                    'content' => $data['content'],
                    'type_id' => $data['type_id'],
                    'priority_id' => $data['priority_id'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]);
                LOCATION NON CENTRA NULLA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
                return Location::create([
                    'name' => $data['name'],
                    'lat' => $data['latitude'],
                    'lng' => $data['longitude'],
                    'model_type' => 'ticket',
                    'model_id' => $ticket->id,
                ]);
            }),
            */
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
                return array_key_exists('model_id', $arguments) ? Ticket::find($arguments['model_id']) : null;
            })
            ->modalSubmitAction(false);
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
            ->schema([
                TextInput::make('name')
                    ->label(__('Ticket name'))
                    ->columnSpanfull()
                    ->required()
                    ->maxLength(255),

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

                Forms\Components\RichEditor::make('content')
                    ->label(__('Ticket content'))
                    ->required()
                    ->columnSpanfull(),

                TextInput::make('latitude')
                // ->hiddenLabel()
                // ->hidden()
                    ->readOnly(),

                TextInput::make('longitude')
                // ->hiddenLabel()
                // ->hidden()
                    ->readOnly(),
                Map::make('location')
                   ->label('Location')
                   ->columnSpanFull()
                   ->default([
                       'lat' => 40.4168,
                       'lng' => -3.7038,
                   ])
                   ->afterStateUpdated(function (Set $set, ?array $state): void {
                       $set('latitude', $state['lat']);
                       $set('longitude', $state['lng']);
                   })
                   ->afterStateHydrated(function ($state, $record, Set $set): void {
                       $set('location', ['lat' => $record?->latitude, 'lng' => $record?->longitude]);
                   })
                   /*
                   ->extraStyles([
                       'min-height: 150vh',
                       'border-radius: 50px',
                   ])
                   */
                   ->liveLocation()
                   ->showMarker()
                   ->markerColor('#22c55eff')
                   ->showFullscreenControl()
                   ->showZoomControl()
                   ->draggable()
                   ->tilesUrl('https://tile.openstreetmap.de/{z}/{x}/{y}.png')
                   ->zoom(15)
                   ->detectRetina()
                   ->showMyLocationButton()
                   ->extraTileControl([])
                   ->extraControl([
                       'zoomDelta' => 1,
                       'zoomSnap' => 2,
                   ])
                   ->columnSpanfull(),
                SpatieMediaLibraryFileUpload::make('images')
                    ->collection('ticket')
                    ->responsiveImages()
                    ->multiple()
                    ->columnSpanfull(),
            ])->columns(2),
            // ->action(function ($data) {
            //     Ticket::create($data);
            //     // dddx($data);
            // })
        ];
    }
}

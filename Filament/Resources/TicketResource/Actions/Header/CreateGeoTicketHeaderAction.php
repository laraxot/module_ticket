<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources\TicketResource\Actions\Header;

use Filament\Forms;
use Filament\Forms\Set;
use Filament\Actions\Action;
use Dotswan\MapPicker\Fields\Map;
use Illuminate\Support\Facades\Gate;
use Modules\Ticket\Models\TicketType;
use Filament\Forms\Components\TextInput;
use Modules\Ticket\Models\TicketPriority;
use Modules\Xot\Filament\Traits\NavigationActionLabelTrait;

class CreateGeoTicketHeaderAction extends Action
{
    // use NavigationActionLabelTrait;

    public static function getDefaultName(): ?string
    {
        return 'create-geo-ticket';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel()
            // ->label(static::trans('actions.create.label'))
            // ->icon(static::trans('actions.create.icon'))
            // ->hidden(fn ($record) => Gate::denies('changePriority', $record))
            // ->steps([
            // ])
            ->form([
                Forms\Components\TextInput::make('name')
                                            ->label(__('Ticket name'))
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
                            ->columnSpan(2),

                TextInput::make('latitude')
                // ->hiddenLabel()
                // ->hidden()
                ,

                TextInput::make('longitude')
                // ->hiddenLabel()
                // ->hidden()
                ,
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
                   ]),
            ])
            ->action(function ($data) {
                dddx($data);
            });
    }
}

<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Modules\Ticket\Enums\GeoTicketTypeEnum;
use Modules\Ticket\Enums\TicketPriorityEnum;
use Modules\Ticket\Filament\Resources\GeoTicketResource\Pages;
use Modules\Ticket\Models\GeoTicket;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Models\TicketType;
use Modules\Xot\Filament\Resources\XotBaseResource;

class GeoTicketResource extends XotBaseResource
{
    protected static ?string $model = GeoTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
            ->schema([
                TextInput::make('name')
                    ->label(__('Ticket name'))
                    ->columnSpanfull()
                    ->required()
                    ->maxLength(255),
                /*
                Forms\Components\Select::make('type_id')
                    ->label(__('Ticket type'))
                    ->searchable()
                    ->options(fn () => TicketType::all()->pluck('name', 'id')->toArray())
                    ->default(fn () => TicketType::where('is_default', true)->first()?->id)
                    ->required(),
                */
                Forms\Components\Select::make('type')
                    ->label(__('Ticket type'))
                    ->searchable()
                    ->options(GeoTicketTypeEnum::class),
                /*
                Forms\Components\Select::make('priority_id')
                    ->label(__('Ticket priority'))
                    ->searchable()
                    ->options(fn () => TicketPriority::all()->pluck('name', 'id')->toArray())
                    ->default(fn () => TicketPriority::where('is_default', true)->first()?->id)
                    ->required(),
                */
                Forms\Components\Select::make('priority')
                    ->label(__('Ticket priority'))
                    ->searchable()
                    ->options(TicketPriorityEnum::class)
                    ->default(TicketPriorityEnum::default()),

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
                    ->directory('ticket')
                    ->disk('uploads')
                    ->responsiveImages()
                    ->multiple()
                    ->columnSpanfull(),
            ])->columns(2),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema());
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeoTickets::route('/'),
            'create' => Pages\CreateGeoTicket::route('/create'),
            'edit' => Pages\EditGeoTicket::route('/{record}/edit'),
        ];
    }
}

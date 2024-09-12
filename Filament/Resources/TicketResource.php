<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Str;
use Dotswan\MapPicker\Fields\Map;
use Modules\Ticket\Models\Ticket;
use Filament\Support\Enums\MaxWidth;
use Modules\Ticket\Models\TicketType;
use Filament\Forms\Components\TextInput;
use Modules\Ticket\Enums\TicketTypeEnum;
use Filament\Pages\SubNavigationPosition;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Enums\TicketPriorityEnum;
use Modules\Ticket\Rules\FilterCoordinatesInRadius;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\Ticket\Filament\Resources\TicketResource\Pages;

class TicketResource extends XotBaseResource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    // Ticket Name
                    TextInput::make('name')
                        ->label(__('Ticket name'))
                        ->columnSpanFull() // Occupa tutta la larghezza disponibile
                        ->required()
                        ->maxLength(255)
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'padding: 0; margin: 0;']), // Rimozione del padding e margini
    
                    // Slug
                    TextInput::make('slug')
                        ->columnSpanFull() // Anche lo slug occupa tutta la larghezza disponibile
                        ->required()
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'padding: 0; margin: 0;']), // Rimozione del padding e margini
    
                    // Ticket Type
                    Forms\Components\Select::make('type')
                        ->label(__('Ticket type'))
                        ->searchable()
                        ->options(TicketTypeEnum::class)
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'padding: 0; margin: 0;']), // Rimozione del padding e margini
    
                    // Ticket Priority
                    Forms\Components\Select::make('priority')
                        ->label(__('Ticket priority'))
                        ->searchable()
                        ->options(TicketPriorityEnum::class)
                        ->default(TicketPriorityEnum::default())
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'padding: 0; margin: 0;']), // Rimozione del padding e margini
    
                    // Ticket Content (RichEditor)
                    Forms\Components\RichEditor::make('content')
                        ->label(__('Ticket content'))
                        ->required()
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'padding: 0; margin: 0;']), // Rimozione del padding e margini
    
                    // Hidden Latitude and Longitude
                    TextInput::make('latitude')->hidden()->readOnly(),
                    TextInput::make('longitude')->hidden()->readOnly(),
    
                    // Map Section
                    Map::make('location')
                        ->label('Location')
                        ->columnSpanFull() // Occupare l'intera larghezza disponibile
                        ->default([
                            'lat' => 40.4168,
                            'lng' => -3.7038,
                        ])
                        ->afterStateUpdated(function (Set $set, ?array $state): void {
                            if (is_array($state)) {
                                $set('latitude', $state['lat']);
                                $set('longitude', $state['lng']);
                            }
                        })
                        ->afterStateHydrated(function ($state, $record, Set $set): void {
                            $set('location', ['lat' => $record?->latitude, 'lng' => $record?->longitude]);
                        })
                        ->rules([new FilterCoordinatesInRadius])
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
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'min-height: 300px; padding: 0; margin: 0;']),
    
                    // Image Upload
                    SpatieMediaLibraryFileUpload::make('images')
                        ->collection('ticket')
                        ->directory('ticket')
                        ->disk('uploads')
                        ->responsiveImages()
                        ->multiple()
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'max-w-full', 'style' => 'padding: 0; margin: 0;']),
                ])
                ->columns(1) // Imposta il layout su una colonna
                ->extraAttributes(['class' => 'w-full max-w-full mx-auto', 'style' => 'padding: 0; margin: 0; !important;']), // Rimozione padding e margine
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'statuses' => Pages\ManageTicketStatuses::route('/{record}/statuses'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            // Pages\ListTickets::class,
            // Pages\CreateTicket::class,
            Pages\ViewTicket::class,
            Pages\EditTicket::class,
            Pages\ManageTicketStatuses::class,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Modules\Ticket\Filament\Resources\TicketTypeResource\Pages;
use Modules\Ticket\Models\TicketType;

class TicketTypeResource extends Resource
{
    protected static ?string $model = TicketType::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('Ticket types');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Referential');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('Type name'))
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\ColorPicker::make('color')
                                    ->label(__('Type color'))
                                    ->required(),
                                /*
                                IconPicker::make('icon')
                                    ->label(__('Type icon'))
                                    ->required(),
                                */
                                // Forms\Components\TextInput::make('icon')
                                //     ->suffixAction(
                                //         \Filament\Forms\Components\Actions\Action::make('icon')

                                //         ->icon(fn(string $state)=>$state)
                                //         ->form([
                                //             Forms\Components\TextInput::make('iconx')
                                //             ->default(fn($get)=>dddx($get('icon')))
                                //             ->suffixAction(
                                //                 \Filament\Forms\Components\Actions\Action::make('choose')
                                //                 ->icon('heroicon-o-academic-cap')
                                //             )->suffixAction(
                                //                 \Filament\Forms\Components\Actions\Action::make('choose1')
                                //                 ->icon('heroicon-o-adjustments-horizontal')
                                //             )->suffixAction(
                                //                 \Filament\Forms\Components\Actions\Action::make('choose2')
                                //                 ->icon('heroicon-o-adjustments-horizontal')
                                //             )->suffixAction(
                                //                 \Filament\Forms\Components\Actions\Action::make('choose3')
                                //                 ->icon('heroicon-o-adjustments-horizontal')
                                //             )->suffixAction(
                                //                 \Filament\Forms\Components\Actions\Action::make('choose4')
                                //                 ->icon('heroicon-o-adjustments-horizontal')
                                //             )
                                //         ])

                                //     ),
                                Forms\Components\Checkbox::make('is_default')
                                    ->label(__('Default type'))
                                    ->helperText(
                                        __('If checked, this type will be automatically affected to new tickets')
                                    ),
                            ]),
                    ]),
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
            'index' => Pages\ListTicketTypes::route('/'),
            'create' => Pages\CreateTicketType::route('/create'),
            'view' => Pages\ViewTicketType::route('/{record}'),
            'edit' => Pages\EditTicketType::route('/{record}/edit'),
        ];
    }
}

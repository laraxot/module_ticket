<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class MapWithFormBlock
{
    public static function make(
        string $name = 'map_with_form',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                TextInput::make('text')
                    ->label('Link text (optional)'),
            ])
            ->label('Map With Form')
            ->columns('form' === $context ? 2 : 1);
    }
}

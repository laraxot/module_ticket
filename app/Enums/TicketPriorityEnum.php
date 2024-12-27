<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Ticket\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TicketPriorityEnum: string implements HasColor, HasIcon, HasLabel
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case CRITICAL = 'critical';

    public function getColor(): string
    {
        return match ($this) {
            self::LOW => 'green',
            self::MEDIUM => 'yellow',
            self::HIGH => 'orange',
            self::CRITICAL => 'red',
            // default => 'gray',
        };
    }

    public function getTextColor(): string
    {
        return match ($this) {
            self::LOW => 'text-green-500',
            self::MEDIUM => 'text-yellow-500',
            self::HIGH => 'text-orange-500',
            self::CRITICAL => 'text-red-500',
            // default => 'gray',
        };
    }

    public function getBgColor(): string
    {
        return match ($this) {
            self::LOW => 'bg-green-500',
            self::MEDIUM => 'bg-yellow-500',
            self::HIGH => 'bg-danger-500',
            self::CRITICAL => 'bg-red-500',
            // default => 'gray',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::LOW => 'heroicon-o-arrow-down',
            self::MEDIUM => 'heroicon-o-arrow-right',
            self::HIGH => 'heroicon-o-arrow-up',
            self::CRITICAL => 'heroicon-o-exclamation-circle',
            // default => 'heroicon-o-question-mark-circle',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
            self::CRITICAL => 'Critical',
            // default => 'Unknown',
        };
    }

    public static function default(): static
    {
        return self::LOW;
    }

    /* NO
    public static function getArrayValueLabelIcon(): array
    {
        $priorities = [];
        foreach (self::cases() as $item) {
            $priorities[$item->value] = [
                'label' => $item->getLabel(),
                'icon' => $item->getIcon(),
                'color' => $item->getColor()
            ];
        }

        return $priorities;
    }
    */
}

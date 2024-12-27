<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Ticket\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TicketStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    // case NEW = 'new';
    case PENDING = 'pending';
    case IN_REVIEW = 'in_review';
    case IN_PROGRESS = 'in_progress';
    case ON_HOLD = 'on_hold';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
    case REOPENED = 'reopened';

    public function getColor(): string
    {
        return match ($this) {
            // self::NEW => 'yellow',
            self::PENDING => 'yellow',
            self::IN_REVIEW => 'blue',
            self::IN_PROGRESS => 'orange',
            self::ON_HOLD => 'red',
            self::RESOLVED => 'green',
            self::CLOSED => 'gray',
            self::REOPENED => 'pink',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            // self::NEW => 'heroicon-o-plus-circle',
            // self::PENDING => 'heroicon-o-plus-circle',
            self::PENDING => 'ui-hourglass',
            self::IN_REVIEW => 'heroicon-o-clock',
            self::IN_PROGRESS => 'heroicon-o-arrow-path',
            self::ON_HOLD => 'heroicon-o-pause',
            self::RESOLVED => 'heroicon-o-check-circle',
            self::CLOSED => 'heroicon-o-x-circle',
            self::REOPENED => 'heroicon-o-arrow-uturn-left',
        };
    }

    public function getLabel(): string
    {
        // return __('ticket::enums.'.$this->name.'.label');

        return match ($this) {
            // self::NEW => 'New',
            self::PENDING => 'Pending',
            self::IN_REVIEW => 'In Review',
            self::IN_PROGRESS => 'In Progress',
            self::ON_HOLD => 'On Hold',
            self::RESOLVED => 'Resolved',
            self::CLOSED => 'Closed',
            self::REOPENED => 'Reopened',
            // default => 'Unknown',
        };
    }

    public static function canViewByAll(): array
    {
        return [
            self::ON_HOLD,
            self::RESOLVED,
            self::CLOSED,
            self::REOPENED,
        ];
    }

    public static function canNoViewByAll(): array
    {
        return [
            self::PENDING,
            self::IN_REVIEW,
            self::IN_PROGRESS,
        ];
    }

    /*-- NO
    public static function getArrayValueLabelIcon(): array
    {
        $statuses = [];
        foreach (self::cases() as $item) {
            $statuses[$item->value] = [
                'label' => $item->getLabel(),
                'icon' => $item->getIcon(),
                'color' => $item->getColor()
            ];
        }

        return $statuses;
    }
    */
}

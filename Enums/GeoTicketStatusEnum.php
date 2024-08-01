<?php

declare(strict_types=1);

namespace Modules\Ticket\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum GeoTicketStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case NEW = 'new';
    case PENDING = 'pending';
    case IN_REVIEW = 'in_review';
    case IN_PROGRESS = 'in_progress';
    case ON_HOLD = 'on_hold';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
    case REOPENED = 'reopened';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NEW => 'yellow',
            self::PENDING => 'yellow',
            self::IN_REVIEW => 'blue',
            self::IN_PROGRESS => 'orange',
            self::ON_HOLD => 'red',
            self::RESOLVED => 'green',
            self::CLOSED => 'gray',
            self::REOPENED => 'pink',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NEW => 'heroicon-o-plus-circle',
            self::PENDING => 'heroicon-o-plus-circle',
            self::IN_REVIEW => 'heroicon-o-clock',
            self::IN_PROGRESS => 'heroicon-o-refresh',
            self::ON_HOLD => 'heroicon-o-pause',
            self::RESOLVED => 'heroicon-o-check-circle',
            self::CLOSED => 'heroicon-o-x-circle',
            self::REOPENED => 'heroicon-o-reply',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NEW => 'New',
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
}

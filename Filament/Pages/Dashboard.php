<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Modules\Ticket\Filament\Widgets\FavoriteProjects;
use Modules\Ticket\Filament\Widgets\LatestActivities;
use Modules\Ticket\Filament\Widgets\LatestComments;
use Modules\Ticket\Filament\Widgets\LatestProjects;
use Modules\Ticket\Filament\Widgets\LatestTickets;
use Modules\Ticket\Filament\Widgets\TicketsByPriority;
use Modules\Ticket\Filament\Widgets\TicketsByType;
use Modules\Ticket\Filament\Widgets\TicketTimeLogged;
use Modules\Ticket\Filament\Widgets\UserTimeLogged;

class Dashboard extends BasePage
{
    protected static bool $shouldRegisterNavigation = false;

    public function getColumns(): int|array
    {
        return 6;
    }

    public function getWidgets(): array
    {
        return [
            FavoriteProjects::class,
            LatestActivities::class,
            LatestComments::class,
            LatestProjects::class,
            LatestTickets::class,
            TicketsByPriority::class,
            TicketsByType::class,
            TicketTimeLogged::class,
            UserTimeLogged::class,
        ];
    }
}

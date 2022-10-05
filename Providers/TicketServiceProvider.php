<?php

declare(strict_types=1);

namespace Modules\Ticket\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;

class TicketServiceProvider extends XotBaseServiceProvider {
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'ticket';
}

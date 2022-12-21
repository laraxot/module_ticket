<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Panels\Policies;

use Illuminate\Support\Facades\Auth;
use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;
use Modules\Cms\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;

class TicketPanelPolicy extends XotBasePanelPolicy {
    /**
     * Undocumented function.
     */
    public function create(?UserContract $user, PanelContract $panel): bool {
        if (Auth::guest()) {
            return false;
        }

        return true;
    }

    public function geo(UserContract $user, PanelContract $panel): bool {
        if (false === config('ticket.geo')) {
            return false;
        }

        return true;
    }
}

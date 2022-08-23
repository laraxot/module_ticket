<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Panels\Policies;

use Modules\Xot\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class TicketPanelPolicy extends XotBasePanelPolicy {
    /**
     * Undocumented function.
     */
    public function create(?UserContract $user, PanelContract $panel): bool {
        return true;
    }
}
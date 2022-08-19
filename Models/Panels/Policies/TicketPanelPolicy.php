<?php
namespace Modules\Ticket\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Ticket\Models\Panels\Policies\TicketPanelPolicy as Panel;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class TicketPanelPolicy extends XotBasePanelPolicy {
}

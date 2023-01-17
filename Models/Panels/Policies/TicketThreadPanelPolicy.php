<?php
namespace Modules\Ticket\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Ticket\Models\Panels\Policies\TicketThreadPanelPolicy as Post; 

use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class TicketThreadPanelPolicy extends XotBasePanelPolicy {
}

<?php
namespace Modules\Ticket\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Ticket\Models\Panels\Policies\HomePanelPolicy as Post; 

use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class HomePanelPolicy extends XotBasePanelPolicy {
    public function artisan(?UserContract $user, PanelContract $panel): bool {
        return true;
    }
}

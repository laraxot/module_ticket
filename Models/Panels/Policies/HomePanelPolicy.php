<?php
namespace Modules\Ticket\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract;
use Modules\Cms\Contracts\PanelContract;

use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class HomePanelPolicy extends XotBasePanelPolicy {
    public function artisan(?UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function dashboard(UserContract $user, PanelContract $panel): bool {
        return true;
    }
}

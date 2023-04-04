<?php
namespace Modules\Ticket\Models\Panels\Policies;

<<<<<<< HEAD
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Ticket\Models\Panels\Policies\HomePanelPolicy as Post; 
=======
use Modules\Xot\Contracts\UserContract;
use Modules\Cms\Contracts\PanelContract;
>>>>>>> b322c6ced1ef12d16f6127360ab75dba6ee51c49

use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class HomePanelPolicy extends XotBasePanelPolicy {
<<<<<<< HEAD
=======
    public function artisan(?UserContract $user, PanelContract $panel): bool {
        return true;
    }

    public function dashboard(UserContract $user, PanelContract $panel): bool {
        return true;
    }
>>>>>>> b322c6ced1ef12d16f6127360ab75dba6ee51c49
}

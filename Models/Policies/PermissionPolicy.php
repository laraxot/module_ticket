<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\Permission;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;


class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        //return $user->can('List permissions');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Permission $permission)
    {
        return $user->can('View permission');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create permission');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Permission $permission)
    {
        return $user->can('Update permission');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Permission $permission)
    {
        return $user->can('Delete permission');
    }
}

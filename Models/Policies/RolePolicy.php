<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\Role;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        //return $user->can('List roles');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Role $role)
    {
        return $user->can('View role');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Role $role)
    {
        return $user->can('Update role');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Role $role)
    {
        return $user->can('Delete role');
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Ticket\Models\Role;
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class RolePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        // return $user->can('List roles');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Role $role)
    {
        return $user->can('View role');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create role');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Role $role)
    {
        return $user->can('Update role');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Role $role)
    {
        return $user->can('Delete role');
    }
}

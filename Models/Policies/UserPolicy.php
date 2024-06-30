<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->can('List users');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \Modules\Xot\Contracts\UserContract  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, User $model)
    {
        return $user->can('View user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \Modules\Xot\Contracts\UserContract  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, User $model)
    {
        return $user->can('Update user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \Modules\Xot\Contracts\UserContract  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, User $model)
    {
        return $user->can('Delete user');
    }
}

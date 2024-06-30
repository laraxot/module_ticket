<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Xot\Contracts\UserContract;
use Modules\Ticket\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
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
        return $user->can('List activities');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Activity $activity)
    {
        return $user->can('View activity');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create activity');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Activity $activity)
    {
        return $user->can('Update activity');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Activity $activity)
    {
        return $user->can('Delete activity');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(UserContract $user, Activity $activity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(UserContract $user, Activity $activity)
    {
        //
    }
}

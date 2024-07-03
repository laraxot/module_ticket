<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\Activity;
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class ActivityPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        // return $user->can('List activities');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\Activity $activity
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Activity $activity)
    {
        return $user->can('View activity');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create activity');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\Activity $activity
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Activity $activity)
    {
        return $user->can('Update activity');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\Activity $activity
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Activity $activity)
    {
        return $user->can('Delete activity');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\Activity $activity
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(UserContract $user, Activity $activity)
    {
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\Activity $activity
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(UserContract $user, Activity $activity)
    {
    }
}

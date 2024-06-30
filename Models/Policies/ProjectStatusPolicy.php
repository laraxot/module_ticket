<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\ProjectStatus;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectStatusPolicy
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
        //return $user->can('List project statuses');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\ProjectStatus  $projectStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, ProjectStatus $projectStatus)
    {
        return $user->can('View project status');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create project status');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\ProjectStatus  $projectStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, ProjectStatus $projectStatus)
    {
        return $user->can('Update project status');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\ProjectStatus  $projectStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, ProjectStatus $projectStatus)
    {
        return $user->can('Delete project status');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\ProjectStatus  $projectStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(UserContract $user, ProjectStatus $projectStatus)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\ProjectStatus  $projectStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(UserContract $user, ProjectStatus $projectStatus)
    {
        //
    }
}

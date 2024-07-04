<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Ticket\Models\Project;
use Modules\Xot\Contracts\UserContract;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\UserContract $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        // return $user->can('List projects');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\Project      $project
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Project $project)
    {
        return $user->can('View project')
            && (
                $project->owner_id === $user->id
                || $project->users()->where('users.id', $user->id)->count()
            );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\UserContract $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create project');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\Project      $project
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Project $project)
    {
        return $user->can('Update project')
            && (
                $project->owner_id === $user->id
                || $project->users()->where('users.id', $user->id)
                    ->where('role', config('system.projects.affectations.roles.can_manage'))
                    ->count()
            );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\Project      $project
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Project $project)
    {
        return $user->can('Delete project');
    }
}
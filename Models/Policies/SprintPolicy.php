<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Ticket\Models\Sprint;
use Modules\Xot\Contracts\UserContract;

class SprintPolicy
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
        return $user->can('List sprints');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\Sprint       $sprint
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Sprint $sprint)
    {
        return $user->can('View sprint')
            && (
                $sprint->project->owner_id === $user->id
                || $sprint->project->users()->where('users.id', $user->id)->count()
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
        return $user->can('Create sprint');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\Sprint       $sprint
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Sprint $sprint)
    {
        return $user->can('Update sprint')
            && (
                $sprint->project->owner_id === $user->id
                || $sprint->project->users()->where('users.id', $user->id)
                    ->where('role', config('system.projects.affectations.roles.can_manage'))
                    ->count()
            );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\Sprint       $sprint
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Sprint $sprint)
    {
        return $user->can('Delete sprint');
    }
}

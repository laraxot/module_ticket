<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\Ticket;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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
        //return $user->can('List tickets');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, Ticket $ticket)
    {
        return $user->can('View ticket')
            && (
                $ticket->owner_id === $user->id
                ||
                $ticket->responsible_id === $user->id
                ||
                $ticket->project->users()->where('users.id', auth()->user()->id)->count()
                ||
                $ticket->project->owner_id === $user->id
            );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create ticket');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, Ticket $ticket)
    {
        return $user->can('Update ticket')
            && (
                $ticket->owner_id === $user->id
                ||
                $ticket->responsible_id === $user->id
                ||
                $ticket->project->users()->where('users.id', auth()->user()->id)->count()
                ||
                $ticket->project->owner_id === $user->id
            );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, Ticket $ticket)
    {
        return $user->can('Delete ticket');
    }
}

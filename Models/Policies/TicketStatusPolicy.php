<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\TicketStatus;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketStatusPolicy
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
        return $user->can('List ticket statuses');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\TicketStatus  $ticketStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, TicketStatus $ticketStatus)
    {
        return $user->can('View ticket status');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create ticket status');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\TicketStatus  $ticketStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, TicketStatus $ticketStatus)
    {
        return $user->can('Update ticket status');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\Xot\Contracts\UserContract  $user
     * @param  \App\Models\TicketStatus  $ticketStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, TicketStatus $ticketStatus)
    {
        return $user->can('Delete ticket status');
    }
}

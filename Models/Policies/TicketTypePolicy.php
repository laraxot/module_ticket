<?php

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\TicketType;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\UserContract $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        //return $user->can('List ticket types');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\TicketType $ticketType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, TicketType $ticketType)
    {
        return $user->can('View ticket type');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\UserContract $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create ticket type');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\TicketType $ticketType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, TicketType $ticketType)
    {
        return $user->can('Update ticket type');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\UserContract $user
     * @param \App\Models\TicketType $ticketType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, TicketType $ticketType)
    {
        return $user->can('Delete ticket type');
    }
}

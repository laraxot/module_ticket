<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\TicketStatus;
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class TicketStatusPolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        // return $user->can('List ticket statuses');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\TicketStatus $ticketStatus
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, TicketStatus $ticketStatus)
    {
        return $user->can('View ticket status');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return $user->can('Create ticket status');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\TicketStatus $ticketStatus
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, TicketStatus $ticketStatus)
    {
        return $user->can('Update ticket status');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\TicketStatus $ticketStatus
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, TicketStatus $ticketStatus)
    {
        return $user->can('Delete ticket status');
    }
}

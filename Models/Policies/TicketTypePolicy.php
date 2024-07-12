<?php

declare(strict_types=1);

namespace Modules\Ticket\Models\Policies;

use Modules\Ticket\Models\TicketType;
use Modules\User\Models\Policies\UserBasePolicy;
use Modules\Xot\Contracts\UserContract;

class TicketTypePolicy extends UserBasePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param \Modules\Xot\Contracts\UserContract $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(UserContract $user)
    {
        return true;
        // return $user->can('List ticket types');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \Modules\Xot\Contracts\UserContract $user
     * @param \Modules\Ticket\Models\TicketType   $ticketType
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(UserContract $user, TicketType $ticketType)
    {
        return $user->can('View ticket type');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Modules\Xot\Contracts\UserContract $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(UserContract $user)
    {
        return true;

        return $user->can('Create ticket type');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Modules\Xot\Contracts\UserContract $user
     * @param \Modules\Ticket\Models\TicketType   $ticketType
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(UserContract $user, TicketType $ticketType)
    {
        return true;
        // return $user->can('Update ticket type');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \Modules\Xot\Contracts\UserContract $user
     * @param \Modules\Ticket\Models\TicketType   $ticketType
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(UserContract $user, TicketType $ticketType)
    {
        return $user->can('Delete ticket type');
    }
}

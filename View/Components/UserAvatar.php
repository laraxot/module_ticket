<?php

declare(strict_types=1);

namespace Modules\Ticket\View\Components;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\Component;
use Modules\User\Models\User;

class UserAvatar extends Component
{
    public Authenticatable|User $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Authenticatable|User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('ticket::components.user-avatar');
    }
}

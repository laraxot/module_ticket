<?php

declare(strict_types=1);

namespace Modules\Ticket\View\Components;

use Illuminate\View\Component;
use Modules\Ticket\Models\TicketPriority as Model;

class TicketPriority extends Component
{
    public Model $priority;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $priority)
    {
        $this->priority = $priority;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('ticket::components.ticket-priority');
    }
}

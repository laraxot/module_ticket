<?php

declare(strict_types=1);

namespace Modules\Ticket\View\Components;

use Illuminate\View\Component;
use Modules\Ticket\Models\TicketType as Model;

class TicketType extends Component
{
    public Model $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ticket-type');
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Ticket;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

/**
 * Class Create.
 */
class Create extends Component {
    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        $view = 'ticket::livewire.ticket.create';
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }
}

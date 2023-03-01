<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Ticket\Modal;

use Illuminate\Contracts\Support\Renderable;
use WireElements\Pro\Components\Modal\Modal;

class Test2 extends Modal {
    public array $form_data = [];

    /**
     * --.
     */
    public function render(): Renderable {
        $view = 'ticket::livewire.ticket.modal.test';
        $view_params = [];

        return view($view, $view_params);
    }

    public function save(): void {
        dddx('a');
    }
}

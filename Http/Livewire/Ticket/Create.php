<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Ticket;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

/**
 * Class Create.
 */
class Create extends Component {
    public string $type;
    public int $step = 0;
    public array $steps = [
        'acconsentire_trattamento_dati_inseriti',
        'inserire_dati_specifici',
        'conferma_riepilogo_informazioni_inserite',
    ];
    public array $form_data = [
        'accept' => false,
    ];

    public function mount(?string $type = 'create') {
        $this->type = $type;
    }

    /**
     * Undocumented function.
     */
    public function render(): Renderable {
        $view_step = $this->steps[$this->step];
        $view = 'ticket::livewire.ticket.create.'.$view_step;
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    public function acconsento() {
        ++$this->step;
    }

    public function previous() {
        --$this->step;
    }
}

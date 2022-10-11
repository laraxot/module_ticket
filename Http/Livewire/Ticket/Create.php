<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Ticket;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Geo\Models\Place;
use Modules\Ticket\Models\Ticket;
use Modules\Xot\Actions\Model\StoreAction;

/**
 * Class Create.
 */
class Create extends Component {
    public string $type;
    public int $step = 0;
    public array $steps = [
        // 'acconsentire_trattamento_dati_inseriti',
        'inserire_dati_specifici',
        'conferma_riepilogo_informazioni_inserite',
    ];
    public array $form_data = [
        'accept' => false,
        'title' => '',
    ];

    protected $rules = [
        'form_data.post.title' => 'required|min:6', // nel caso vogliamo usare post
        // 'name' => 'required|min:6',
        // 'email' => 'required|email',
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
        // $this->validate();
        ++$this->step;
    }

    public function previous() {
        --$this->step;
    }

    public function save() {
        $data = $this->form_data;
        $rules = [
            'title' => 'required|min:6',
        ];
        $res = app(StoreAction::class)->execute(app(Ticket::class), $data, $rules);

        // dddx([$this->form_data, $ticket->all(), $ticket->get()->last()->place]);
    }
}

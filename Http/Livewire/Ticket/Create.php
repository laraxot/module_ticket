<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Ticket;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Geo\Models\Place;
use Modules\Ticket\Models\Ticket;
use Modules\Xot\Services\PanelService;

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
        // dddx($this->form_data);
        ++$this->step;
    }

    public function previous() {
        --$this->step;
    }

    public function save() {
        $this->validate();
        // $this->form_data['post']['lang'] = app()->getLocale();
        $ticket = new Ticket();
        // $ticket->create($this->form_data)->post()->firstOrCreate($this->form_data['post']);

        $ticket_panel = PanelService::make()->get($ticket);
        $ticket_panel->store($this->form_data);

        // $tmp = json_decode($this->form_data['places'], true);
        // dddx([
        //     json_decode($this->form_data['places']),
        //     gettype($tmp),
        //     $tmp,
        //     // $tmp->toArray(),
        // ]);

        // $place = new Place();
        // $data = json_decode($this->form_data['places']);
        // $place->create($data);

        // dddx($place->toArray());

        // if (isset($this->form_data['places'])) {
        //     $ticket->address()->create(json_decode($this->form_data['places'], true)); // funziona ma non mi salva post_id
        //     // $ticket->address()->create($place->all());
        //     // $ticket->address($this->form_data['places']);
        // }

        dddx([$this->form_data, $ticket, $ticket->place]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Ticket;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Geo\Models\Place;
use Modules\Ticket\Models\Ticket;
use Modules\Xot\Actions\Model\StoreAction as ModelStoreAction;

class Test extends Component {
    public ?string $type;
    public array $form_data = [];

    public function mount(?string $type = 'create'): void {
        $this->type = $type;
    }

    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = 'ticket::livewire.ticket.test.'.$this->type;
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function store(): void {
        $rules = [
            'place' => '',
        ];
        $data = $this->form_data;
        $res = app(ModelStoreAction::class)->execute(app(Ticket::class), $data, $rules);
        /*
        dddx([
            'res'=>$res,
            'res-plae'=>$res->place,
            'data'=>$data,
            'rules'=>$rules,
        ]);
        */
    }
}

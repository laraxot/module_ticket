<?php

declare(strict_types=1);

namespace Modules\Ticket\Http\Livewire\Modal\Ticket;

use Illuminate\Contracts\Support\Renderable;
use Modules\Blog\Models\Category;
use Modules\Cms\Actions\GetViewAction;
use Modules\Ticket\Models\Ticket;
use Modules\Xot\Actions\Model\StoreAction;
use WireElements\Pro\Components\Modal\Modal;

class Create extends Modal {
    public array $form_data = [];

    public function render(): Renderable {
        /** @phpstan-var view-string */
        // $view = 'ticket::livewire.modal.ticket.create';
        $view = app(GetViewAction::class)->execute();

        $category_opts = [];
        $categories = Category::ofType('ticket')->get();
        if (0 == $categories->count()) {
            // phpstan mi dice di cambiarlo così:
            $ticket = new Ticket();
            // $ticket = Ticket::make();
            $ticket->id = 0;
            $config_categories = config('ticket.categories');
            // dddx($config_categories);
            $ticket->attachCategories($config_categories);
        }

        $category_opts = $categories->pluck('name', 'id')->all();

        $view_params = [
            'view' => $view,
            'category_opts' => $category_opts,
        ];

        return view($view, $view_params);
    }

    public function save(): void {
        $model = app(Ticket::class);
        $data = $this->form_data;
        $res = app(StoreAction::class)->execute($model, $data, []);
    }
}

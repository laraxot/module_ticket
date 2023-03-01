<?php

namespace Modules\Ticket\Http\Livewire\Modal\Ticket;

use Modules\Blog\Models\Category;
use Modules\Ticket\Models\Ticket;
use Illuminate\Contracts\Support\Renderable;
use Modules\Xot\Actions\Model\StoreAction;
use WireElements\Pro\Components\Modal\Modal;

 class Create extends Modal
 {
    public array $form_data = [];
     public function render():Renderable
     {
        /** @phpstan-var view-string */
        $view = 'ticket::livewire.modal.ticket.create';

        $category_opts=[];
        $categories=Category::ofType('ticket')->get();
        if($categories->count()==0){
            $ticket = Ticket::make();
            $ticket->id = 0;
            $config_categories = config('ticket.categories');
            //dddx($config_categories);
            $ticket->attachCategories($config_categories);

        }

        $category_opts=$categories->pluck('name','id')->all();

        $view_params = [
            'view'=>$view,
            'category_opts'=>$category_opts,
        ];
        return view($view,$view_params);
     }



     public function save(){
        $model = app(Ticket::class);
        $data = $this->form_data;
        $res=app(StoreAction::class)->execute($model, $data,[]);
     }
 }
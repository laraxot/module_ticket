<?php
/**
 * @see https://filamentphp.com/docs/3.x/forms/adding-a-form-to-a-livewire-component#adding-the-form
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget as BaseWidget;
use Modules\Ticket\Events\TicketCreatedEvent;
use Modules\Ticket\Filament\Resources\TicketResource;
use Modules\Ticket\Models\Ticket;

/**
 * @property ComponentContainer $form
 */
class CreateTicketWidget extends BaseWidget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'ticket::filament.widgets.create-ticket';

    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return TicketResource::getFormSchema();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function create(): void
    {
        $ticket = Ticket::create($this->form->getState());
        TicketCreatedEvent::dispatch($ticket);
        redirect('/');
    }
}

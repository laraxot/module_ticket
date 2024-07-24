<?php
/**
 * @see https://filamentphp.com/docs/3.x/forms/adding-a-form-to-a-livewire-component#adding-the-form
 */

declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Forms\Form;
use Modules\Ticket\Models\Ticket;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget as BaseWidget;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Ticket\Filament\Resources\GeoTicketResource;

class CreateGeoTicketWidget extends BaseWidget implements HasForms
{
    use InteractsWithForms;
    protected static string $view = 'ticket::filament.widgets.create-geo-ticket';
    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return GeoTicketResource::getFormSchema();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function create(): void
    {
        Ticket::create($this->form->getState());
        redirect('/');
    }
}

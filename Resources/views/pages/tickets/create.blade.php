<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('ticket.create');
middleware(['auth']);

new class extends Component
{
};
?>

<x-layouts.marketing>

    <div class="w-full">

        <x-ui.marketing.breadcrumbs :crumbs="[['text' => 'Tickets'],['text' => 'Create']]" />
        <div class="w-full">

            <br/>
            @livewire(\Modules\Ticket\Filament\Widgets\CreateTicketWidget::class)

        </div>
    </div>
</x-layouts.marketing>

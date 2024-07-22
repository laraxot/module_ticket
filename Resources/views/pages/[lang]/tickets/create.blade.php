<?php

use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('ticket.prova');

new class extends Component
{
};
?>

<x-layouts.marketing>

    <div class="w-full">

        <x-ui.marketing.breadcrumbs :crumbs="[['text' => 'Tickets'],['text' => 'Create']]" />
        <div class="w-full p-10" >

            <h1>IT WORKS</h1>
            <br/>
            @livewire(\Modules\Ticket\Filament\Widgets\CreateGeoTicketWidget::class)

        </div>
    </div>
</x-layouts.marketing>

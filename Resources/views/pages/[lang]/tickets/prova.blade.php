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

        <x-ui.marketing.breadcrumbs :crumbs="[['text' => 'About']]" />
        <div class="w-full" >
            <h1>IT WORKS</h1>
            <br/>
            @livewire(\Modules\Ticket\Filament\Widgets\CreateGeoTicketWidget::class)
        </div>
    </div>
</x-layouts.marketing>

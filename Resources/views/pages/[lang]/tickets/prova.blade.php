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
        <div class="grid max-w-2xl grid-cols-1 gap-2 mx-auto mt-4 bg-opacity-25 lg:pt-0 md:grid-cols-2 lg:gap-4 lg:gap-y-1">
            <h1>IT WORKS</h1>
        </div>
    </div>
</x-layouts.marketing>

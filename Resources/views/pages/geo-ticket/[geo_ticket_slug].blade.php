<?php

use Modules\Ticket\Models\GeoTicket;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use function Laravel\Folio\{withTrashed,middleware, name,render};

withTrashed();
name('geo_ticket_slug.show');
//middleware(['auth', 'verified']);

render(function (View $view, string $geo_ticket_slug) {
    $ticket = GeoTicket::firstWhere(['slug' => $geo_ticket_slug]);
    return $view->with('ticket', $ticket);
});


?>
<x-layouts.marketing>
    
    page ticket show wip
    {{-- @component("ui::components.blocks.title", $block['data'] ?? []) @endcomponent --}}
</x-layouts.marketing>
<?php

use Modules\Ticket\Models\GeoTicket;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Modules\Ticket\Enums\GeoTicketStatusEnum;
use Modules\Ticket\Enums\TicketPriorityEnum;
use function Laravel\Folio\{withTrashed,middleware, name,render};

withTrashed();
name('geo_ticket_slug.show');
//middleware(['auth', 'verified']);

render(function (View $view, string $geo_ticket_slug) {
    $ticket = GeoTicket::firstWhere(['slug' => $geo_ticket_slug]);
    $medias = $ticket->getMedia('ticket');

    //$statuses = GeoTicketStatusEnum::getArrayValueLabelIcon();
    //$priorities = TicketPriorityEnum::getArrayValueLabelIcon();
    //$priority = $ticket->priority;
    if($ticket->status==""){
        $ticket->setStatus(GeoTicketStatusEnum::PENDING->value);
        $up=tap($ticket)->update([
            'status'=>GeoTicketStatusEnum::PENDING
        ]);
        
        
    }
    
    $status=GeoTicketStatusEnum::from($ticket->status);
    

    return $view->with([
        'ticket' => $ticket, 
        'medias' => $medias, 
        'status' => $status,
        //'statuses' => $statuses, 
        //'priorities' => $priorities, 
        //'priority_ticket' => $ticket->priority
    ]);
});


?>
<x-layouts.marketing>

    <x-ui.marketing.breadcrumbs :crumbs="[
        [
            'href' => '/blog',
            'text' => 'Blog'
        ],
        [
            'text' => $ticket->name
        ]
    ]" />

    <article class="relative w-full h-auto mx-auto prose-sm prose md:prose-2xl dark:prose-invert">
        <div class="py-6 mx-auto heading md:py-12 lg:w-full md:text-center">

            <div class="flex flex-col items-center justify-center mt-4 mb-0">
                <h1 class="!mb-0 font-sans text-4xl font-bold heading md:text-6xl dark:text-white md:leading-tight">
                    {{ $ticket->name }}
                </h1>
            </div>

            <div class="flex items-center justify-center">
                <div class="ml-2">
                    <p class="text-sm text-gray-600 dark:text-gray-500">Creato il {{ $ticket->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="mb-4 flex items-center justify-center">
                <x-filament::icon
                    icon="{{ $ticket->priority->getIcon() }}"
                    wire:target="search"
                    class="h-5 w-5 text-gray-500 dark:text-gray-400"
                />
                <span class="font-semibold text-gray-800 dark:text-gray-200">Priorità:</span>
                <span class="text-500 font-medium" 
                    style="color:{{ $ticket->priority->getColor() }}"
                    >
                    {{ $ticket->priority->getLabel() }}</span>
                /
                <x-filament::icon
                    icon="{{ $status->getIcon() }}"
                    wire:target="search"
                    class="h-5 w-5 text-gray-500 dark:text-gray-400"
                />
                <span class="font-semibold text-gray-800 dark:text-gray-200">Stato:</span>
                <span class="text-500 font-medium" style="color:{{ $status->getColor() }}">{{ $status->getLabel() }}</span>
            </div>

            {{-- @if ($ticket->image)
                <img src="@if(str_starts_with($ticket->image, 'https') || str_starts_with($ticket->image, 'http')){{ $ticket->image }}@else{{ asset('storage/' . $ticket->image) }}@endif" alt="{{ $ticket->title }}" class="w-full mx-auto mt-4">
            @endif --}}

            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach($medias as $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ $image->getFullUrl() }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    @foreach($medias as $key => $image)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ $key }}" data-carousel-slide-to="{{ $key }}"></button>
                    @endforeach
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>

            <div class="flex items-center justify-center mt-4 text-left">
                <div class="max-w-full -mt-5 text-lg text-gray-600 whitespace-pre-line dark:text-gray-300">
                    {!! $ticket->content !!}
                </div>
            </div>
        </div>
    </article>
</x-layouts.marketing>
<x-filament-widgets::widget >
    <form wire:submit="create">
    {{ $this->form }}
        {{-- <button type="submit">
            Submit
        </button> --}}


        <x-filament::button 
            class="w-full py-4 bg-blue-500 hover:bg-blue-700"
            type="submit"
            form="create"
        >
        Click here to submit a new ticket
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-filament-widgets::widget >

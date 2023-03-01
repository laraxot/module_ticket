<x-wire-elements-pro::bootstrap.modal on-submit="save" :content-padding="false">
    <x-slot name="title">Crea Ticket</x-slot>
 
    <!-- No padding will be applied because the component attribute "content-padding" is set to false -->


    <x-input.group type="text" name="title" />

    <x-input.group type="textarea" name="txt" />
    {{ dddx($_theme->getTicketCategories()->all()) }}
    <x-input.group type="select" name="category_id" tpl="v2" :options="$_theme->getTicketCategories()->all()" />
    <x-slot name="buttons">
        {{-- <button type="submit" class="btb btn-primary">
            Save Changes
        </button> --}}
        <button type="button" wire:click="save()" class="btb btn-primary">
            Salva
        </button>
        <button type="button" wire:click="$emit('modal.close')" class="btb btn-warning">
            Cancel
        </button>
    </x-slot>
</x-wire-elements-pro::bootstrap.modal>
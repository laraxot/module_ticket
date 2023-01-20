<div>
    <x-input.group type="text" name="title" />
    <x-input.group type="address" name="place" />
    <button type="button" wire:click="save()" class="btn btn-info">Save</button>

    <x-flash-message />
</div>

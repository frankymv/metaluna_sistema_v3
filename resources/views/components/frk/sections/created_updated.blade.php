

<div class="flex w-full ">
    <div class="flex w-full md:w-1/2">
        <x-frk.forms.label-input textLabel="created_at" :disabled="$disabled" wire:model.defer="created_at" />
    </div>
    <div class="flex w-full md:w-1/2">
        <x-frk.forms.label-input textLabel="updated_at" :disabled="$disabled" wire:model.defer="updated_at" />.
    </div>
</div>


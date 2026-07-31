<div class="flex w-full flex-wrap">
    <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
    <x-frk.components.toggle :disabled="$disabled" label="estado"  />
</div>

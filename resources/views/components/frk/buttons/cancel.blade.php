@props(['label'=>'Cancelar'])

<div {{  $attributes->merge(['class'=>'flex w-full px-3 mb-3 justify-center']) }}>
    <x-frk.buttons.button label="{{$label}}" class="bg-gray-500 hover:bg-gray-700" wire:click.prevent="cancel()"  />
</div>



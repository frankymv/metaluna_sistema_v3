@props(['label'=>'Guardar'])

<div {{  $attributes->merge(['class'=>'flex w-full px-3 mb-3 justify-center']) }}>
    <x-frk.buttons.button label="{{$label}}" class="bg-blue-500 hover:bg-blue-700" wire:click.prevent="store()"  />
</div>





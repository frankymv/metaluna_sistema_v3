@props(['label'=>'Borrar','data'=>''])

<div {{  $attributes->merge(['class'=>'flex w-full px-3 mb-3 justify-center']) }}>
    <x-frk.buttons.button label="{{$label}}" class="bg-red-500 hover:bg-red-700" wire:click="destroy({{$data}})"  />
</div>








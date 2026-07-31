@props(['label'=>'Editar','data'=>''])

<div {{  $attributes->merge(['class'=>'flex w-full px-3 mb-3 justify-center']) }}>
    <x-frk.buttons.button label="{{$label}}" class="bg-green-500 hover:bg-green-700" wire:click.prevent="update({{$data}})"  />
</div>





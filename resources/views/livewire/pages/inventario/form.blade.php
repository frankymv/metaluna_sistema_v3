<div class="flex w-full flex-wrap">
    <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
    <x-frk.components.label-input label="tipo" :disabled="$disabled" wire:model="tipo" />
    <x-frk.components.label-input label="marca" :disabled="$disabled" wire:model="marca" />
    <x-frk.components.label-input label="disenio" :disabled="$disabled" wire:model="disenio" />
    <x-frk.components.label-input label="material" :disabled="$disabled" wire:model="material" />
        <x-frk.components.label-input label="existencia general" :disabled="$disabled" wire:model="existencia" />
    <x-frk.components.title label="existencia en sucursales" />
    <div class="flex w-full flex-wrap">



        @foreach ($inventario->sucursales as $data_a)
        <div class="w-full flex-wrap items-center px-1">
            <x-frk.components.label label="{{$data_a->nombre}}:" class="font-semibold text-sm capitalize "  />
            <x-frk.components.label label="{{$data_a->pivot->cantidad}}" class=" text-sm capitalize "  />
        </div>
        @endforeach
    </div>
</div>

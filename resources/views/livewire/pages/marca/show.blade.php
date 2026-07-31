<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Detalle {{$title}}" />
    </x-slot>
    <x-slot:body>
        <div class="flex w-full flex-wrap">
            <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
            <x-frk.components.toggle :disabled="$disabled" label="estado"  />
        </div>



        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" value="{{$data->created_at}}" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" value="{{$data->updated_at}}" />
        </div>

    </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.components.template-crud>

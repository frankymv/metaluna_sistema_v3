<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full">
                <x-frk.components.title label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>

    <livewire:table.estado-cuenta-venta-table/>

    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.estado_cuenta_venta.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.estado_cuenta_venta.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.estado_cuenta_venta.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.estado_cuenta_venta.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />

    </x-slot:head>
    <x-slot:body>
        <livewire:powergrid.cotizacion-table/>

    </x-slot:body>
    <x-slot:footer>

        @if($isShow)
            @include('livewire.pages.historial_cotizacion.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.historial_cotizacion.delete')
        @endif

    </x-slot:footer>
</x-frk.components.template-index>

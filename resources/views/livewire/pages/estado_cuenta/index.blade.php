<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>

        <livewire:table.estado-cuenta-cliente-table />

    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.estado_cuenta.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.estado_cuenta.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.estado_cuenta.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.estado_cuenta.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

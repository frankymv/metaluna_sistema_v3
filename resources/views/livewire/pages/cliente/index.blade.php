<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>

    <livewire:table.cliente-table/>

    {{ $clientes->withQueryString()->links()}}

    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.cliente.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.cliente.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.cliente.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.cliente.delete')
        @endif

    </x-slot:footer>
</x-frk.components.template-index>

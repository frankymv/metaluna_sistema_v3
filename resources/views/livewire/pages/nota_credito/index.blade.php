<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.nota-credito-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isSearchVenta)
            @include('livewire.pages.nota_credito.searchVenta')
        @endif
        @if($isCreate)
            @include('livewire.pages.nota_credito.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.nota_credito.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.nota_credito.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.nota_credito.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.vehiculo-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.vehiculo.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.vehiculo.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.vehiculo.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.vehiculo.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

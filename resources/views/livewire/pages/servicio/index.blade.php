<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.servicio-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.servicio.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.servicio.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.servicio.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.servicio.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

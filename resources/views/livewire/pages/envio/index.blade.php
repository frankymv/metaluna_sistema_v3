<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.envio-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.envio.create')
        @endif
        @if($isFinalizar)
            @include('livewire.pages.envio.finalizar')
        @endif
        @if($isEdit)
            @include('livewire.pages.envio.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.envio.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.envio.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

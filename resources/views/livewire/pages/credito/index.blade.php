<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>

    <livewire:table.credito-table/>



    </x-slot:body>
    <x-slot:footer>

        @if($isEdit)
            @include('livewire.pages.credito.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.credito.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.credito.delete')
        @endif

    </x-slot:footer>
</x-frk.components.template-index>

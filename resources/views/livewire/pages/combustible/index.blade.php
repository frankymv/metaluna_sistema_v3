<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.combustible-table/>

    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.combustible.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.combustible.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.combustible.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.combustible.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

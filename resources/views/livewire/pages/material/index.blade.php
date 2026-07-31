<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>

        </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.material-table/>

    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.material.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.material.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.material.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.material.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

<x-frk.components.template-index>
    <x-slot:head>
        <div class="w-full">
            <div class="flex w-full">
                <x-frk.components.title label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
 <x-slot:body>



    <livewire:table.venta-table/>

    </x-slot:body>
    <x-slot:footer>

        @if($isShow)
            @include('livewire.pages.venta.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.venta.delete')
        @endif

    </x-slot:footer>
</x-frk.components.template-index>

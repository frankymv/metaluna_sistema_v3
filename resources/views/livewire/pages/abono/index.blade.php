<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
              {{ $abonoss }}
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>

            <div class="flex w-full justify-center">
                <x-frk.components.button color="blue" label="agregar" wire:click="create()" />
                <x-frk.components.button label="Abono anticipado" wire:click="abonoAnticipado()" />
                <x-frk.components.button label="Asignar Abono anticipado" wire:click="abonoAnticipadoAsignar()" />
                <x-frk.components.button-icon  color="red"
                 icon="fa-solid fa-file-pdf" wire:click="exportarGeneral()" />
                <x-frk.components.button-icon color="red" icon="fa-solid fa-trash" wire:click="borrarFiltros()" />
                <div class="flex   justify-center">
                    <select wire:model.liSve="per_page" class="flex border mx-2 border-gray-400  text-sm shadow text-gray-900 rounded-md focus:border-blue-500 focus:border-2 placeholder-gray-400 focus:outline-none focus:shadow-outline"  >
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="">Todo</option>
                    </select>
                </div>
            </div>
        </div>
    </x-slot:head>

    <x-slot:body>
        <livewire:table.abono-table/>


    </x-slot:body>

    <x-slot:footer>
        @if($isSearchCliente)
            @include('livewire.pages.abono.searchCliente')
        @endif
        @if($isCreateAnticipado)
            @include('livewire.pages.abono.create_anticipado')
        @endif
        @if($isCreate)
            @include('livewire.pages.abono.create_abono')
        @endif

        @if($isSearchVenta)
            @include('livewire.pages.abono.searchVenta')
        @endif
        @if($isCreateAnticipadoAsignar)
            @include('livewire.pages.abono.create_anticipado_asignar')
        @endif
        @if($isEdit)
            @include('livewire.pages.abono.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.abono.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.abono.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Editar {{$title}}" />
    </x-slot>
    <x-slot:body>
        @include('livewire.pages.estado_envio.form')
    </x-slot>
    <x-slot:footer>
        <x-frk.components.button  color="green" label="editar" wire:click.prevent="update({{$id_data}})" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>


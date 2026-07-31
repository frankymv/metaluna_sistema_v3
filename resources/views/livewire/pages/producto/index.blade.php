<x-frk.components.template-index>
    <x-slot:head>
        <div class="flex w-full">
            <div class="flex w-full justify-center">
                <x-frk.components.title   label="{{$title}}" />
            </div>
        </div>
    </x-slot:head>
    <x-slot:body>
        <livewire:table.producto-table/>
    </x-slot:body>
    <x-slot:footer>


@if(session('alert.message'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: "{{ session('alert.title') }}",
                text: "{{ session('alert.message') }}",
                icon: "{{ session('alert.type') }}",
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
@endif

        @if($isCreate)
            @include('livewire.pages.producto.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.producto.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.producto.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.producto.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>

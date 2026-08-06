<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION DEL ROL --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-user-shield text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Rol
            </h3>

        </div>

        <x-frk.components.label-input
            label="Nombre"
            :disabled="$disabled"
            wire:model="nombre" />

    </div>

    {{-- PERMISOS --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-key text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Permisos Asignados
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">

            @foreach ($permisson as $item)

                <div class="bg-white border border-gray-200 rounded-xl px-4 py-3">

                    <x-frk.components.checkbox
                        wire:model.live="role_selected"
                        :disabled="$disabled"
                        value="{{ $item->id }}"
                        label="{{ $item->name }}" />

                </div>

            @endforeach

        </div>

    </div>

</div>
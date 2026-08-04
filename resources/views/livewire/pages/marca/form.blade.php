<div class="flex flex-col w-full">

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-tag text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información General
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

            <div class="md:col-span-9">

                <x-frk.components.label-input
                    label="Nombre"
                    :disabled="$disabled"
                    wire:model="nombre" />

            </div>

            <div class="md:col-span-3 flex items-end">

                <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 w-full">

                    <x-frk.components.toggle
                        :disabled="$disabled"
                        label="Estado" />

                </div>

            </div>

            <div class="md:col-span-12">

                <x-frk.components.label-input
                    label="Descripción"
                    :disabled="$disabled"
                    wire:model="descripcion" />

            </div>

        </div>

    </div>

</div>

<div>

    <x-frk.components.template-crud maxWidth="lg">

        <x-slot:title>

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">

                    <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        Eliminar {{ $title }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        Esta acción no se puede deshacer
                    </p>

                </div>

            </div>

        </x-slot:title>

        <x-slot:body>

            <div class="flex flex-col w-full space-y-4">

                <div class="bg-red-50 border border-red-200 rounded-2xl p-5">

                    <div class="flex items-start gap-3">

                        <i class="fa-solid fa-circle-info text-red-500 mt-1"></i>

                        <div>

                            <h3 class="font-semibold text-red-700">
                                Confirmación requerida
                            </h3>

                            <p class="text-sm text-red-600 mt-1">
                                ¿Está seguro que desea eliminar este registro?
                            </p>

                        </div>

                    </div>

                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                    <x-frk.components.label-input
                        label="Registro"
                        wire:model="no_abono"
                        disabled />

                </div>

            </div>

        </x-slot:body>

        <x-slot:footer>

            <div class="flex justify-end gap-3 w-full">

                <x-frk.components.button
                    label="Cancelar"
                    wire:click.prevent="cancel()" />

                <x-frk.components.button
                    color="red"
                    label="Eliminar"
                    wire:click="destroy({{ $id_data }})" />
            </div>
        </x-slot:footer>
    </x-frk.components.template-crud>
</div>

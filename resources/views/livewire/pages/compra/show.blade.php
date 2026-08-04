<x-frk.components.template-crud maxWidth="3xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">

                <i class="fa-solid fa-cart-shopping text-orange-500"></i>

            </div>

            <div>

                <h2 class="font-bold text-xl text-gray-800">
                    Detalle {{ $title }}
                </h2>

            </div>

        </div>

    </x-slot:title>

    <x-slot:body>

        <div class="space-y-5">

            {{-- INFORMACION COMPRA --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <h3 class="font-semibold text-gray-700 mb-4">
                    Información de la Compra
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <x-frk.components.label-input
                        label="Compra No."
                        error="compra_no"
                        :disabled="$disabled"
                        wire:model="compra_no" />

                    <x-frk.components.label-input
                        label="No. Recibo Compra"
                        error="no_recibo_compra"
                        :disabled="$disabled"
                        wire:model="no_recibo_compra" />

                    <x-frk.components.date-picker
                        wire:model="compra_fecha"
                        error="compra_fecha"
                        label="Fecha de Compra"/>

                </div>

            </div>

            {{-- PROVEEDOR Y SUCURSAL --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

                <h3 class="font-semibold text-gray-700 mb-4">
                    Información General
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-frk.components.label-input
                        label="Proveedor"
                        :disabled="$disabled"
                        wire:model="proveedor_id" />

                    <x-frk.components.label-input
                        label="Sucursal"
                        :disabled="$disabled"
                        wire:model="sucursal_id" />

                </div>

            </div>

            {{-- DETALLE --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="bg-orange-400 text-white px-5 py-3">

                    <h3 class="font-semibold">
                        Detalle Compra
                    </h3>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-orange-100">

                            <tr>

                                <th class="px-4 py-3 text-left">
                                    Producto
                                </th>

                                <th class="px-4 py-3 text-center">
                                    Cantidad
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($inputs as $value)

                                <tr class="hover:bg-orange-50">

                                    <td class="px-4 py-3">

                                        {{ $nombresDetalle[$value] }}

                                    </td>

                                    <td class="px-4 py-3 text-center">

                                        {{ $cantidadesDetalle[$value] }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="2"
                                        class="text-center py-10 text-gray-500">

                                        Sin productos registrados

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- AUDITORIA --}}
            @if ($isShow)

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

                    <h3 class="font-semibold text-gray-700 mb-4">
                        Auditoría
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <x-frk.components.label-input
                            label="Fecha Creación"
                            :disabled="$disabled"
                            wire:model="created_at" />

                        <x-frk.components.label-input
                            label="Fecha Modificación"
                            :disabled="$disabled"
                            wire:model="updated_at" />

                    </div>

                </div>

            @endif

        </div>

    </x-slot:body>

    <x-slot:footer>

        <x-frk.components.button
            label="Cerrar"
            wire:click.prevent="cancel()" />

    </x-slot:footer>

</x-frk.components.template-crud>
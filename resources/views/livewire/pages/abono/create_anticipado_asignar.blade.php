<x-frk.components.template-crud maxWidth="5xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <i class="fa-solid fa-money-check-dollar text-orange-500"></i>
            </div>

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Asignar Abono Anticipado
                </h2>

                <p class="text-sm text-gray-500">
                    Aplicación de abonos anticipados a ventas a crédito
                </p>

            </div>

        </div>

    </x-slot:title>

    <x-slot:body>

        <div class="flex flex-col w-full space-y-5">

            {{-- CABECERA --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="md:col-span-2">

                        <x-frk.components.title
                            label="Nuevo Abono Anticipado" />

                    </div>

                    <x-frk.components.label-input
                        label="No. Abono"
                        :disabled="$disabledAsignarAbonoAnticipado"
                        wire:model.live="no_abono" />

                    <x-frk.components.date-picker
                        wire:model="fecha_abono"
                        label="Fecha Abono" />

                </div>

            </div>

            {{-- INFORMACION VENTA --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

                <div class="flex items-center gap-2 mb-1">

                    <i class="fa-solid fa-file-invoice-dollar text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Información de la Venta
                    </h3>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-frk.components.select
                        label="Venta Número"
                        error="asignar_venta_id"
                        wire:model.live="asignar_venta_id">

                        @foreach ($this->ventas_credito as $data)

                            <option
                                value="{{ $data->id }}"
                                wire:key="venta-{{ $data->id }}">

                                No. Venta: {{ $data->no_venta }}
                                | Saldo:
                                {{ ($data->total_venta - $data->total_nota_credito) - $data->total_abono }}

                            </option>

                        @endforeach

                    </x-frk.components.select>

                    <x-frk.components.label-input
                        label="No. Venta"
                        :disabled="$disabledAsignarAbonoAnticipado"
                        wire:model.live="no_venta" />

                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">

                    <x-frk.components.date-picker
                        label="Fecha Venta"
                        :disabled="$disabledAsignarAbonoAnticipado"
                        wire:model.live="fecha_venta" />

                    <x-frk.components.label-input
                        label="Código Interno"
                        :disabled="$disabled"
                        wire:model.live="codigo_interno" />

                    <div class="md:col-span-2">

                        <x-frk.components.label-input
                            label="Empresa"
                            :disabled="$disabled"
                            wire:model.live="nombre_empresa" />

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">

                    <x-frk.components.label-input
                        label="Nombre Cliente"
                        :disabled="$disabled"
                        wire:model.live="nombres_cliente" />

                    <x-frk.components.label-input
                        label="Apellido Cliente"
                        :disabled="$disabled"
                        wire:model.live="apellidos_cliente" />

                </div>

                <div class="grid grid-cols-1 mt-4">

                    <x-frk.components.label-input-moneyy
                        label="Total Venta"
                        :disabled="$disabledAsignarAbonoAnticipado"
                        wire:model.live="total_venta" />

                </div>

            </div>

            {{-- ABONO ANTICIPADO --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <div class="flex items-center gap-2 mb-1">

                    <i class="fa-solid fa-wallet text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Asignación del Abono
                    </h3>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-frk.components.select
                        label="No. Abono Anticipado"
                        error="asignar_abono_anticipado_id"
                        wire:model.live="asignar_abono_anticipado_id">

                        @foreach ($this->abono_anticipados as $data)

                            <option
                                value="{{ $data->id }}"
                                wire:key="abono-{{ $data->id }}">

                                No. Abono {{ $data->no_movimiento }}
                                | Total: {{ $data->total_movimiento }}

                            </option>

                        @endforeach

                    </x-frk.components.select>

                    <x-frk.components.label-input-moneyy
                        label="Cantidad Aplicada"
                        error="cantidad_abono"
                        :disabled="$disabledAsignarAbonoAnticipado"
                        wire:model.live="cantidad_abono_asignar" />

                </div>

            </div>

            {{-- RESUMEN --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

                <div class="flex items-center gap-2 mb-1">

                    <i class="fa-solid fa-calculator text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Resumen
                    </h3>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-frk.components.label-input-moneyy
                        label="Nuevo Saldo"
                        error="nuevo_saldo"
                        :disabled="$disabledAsignarAbonoAnticipado"
                        wire:model.live="nuevo_saldo_asignar" />

                    <x-frk.components.label-input
                        label="Observaciones"
                        wire:model="observaciones" />

                </div>

            </div>

            {{-- TOTAL FINAL --}}
            <div class="bg-orange-400 rounded-2xl p-2 text-white shadow-lg">

                <div class="flex justify-between items-center">

                    <span class="text-lg">
                        Nuevo Saldo del Crédito
                    </span>

                    <span class="text-3xl font-bold">
                        Q {{ number_format((float)$nuevo_saldo_asignar, 2) }}
                    </span>

                </div>

            </div>

        </div>

    </x-slot:body>

    <x-slot:footer>

        <div class="flex justify-end gap-3 w-full">

            <x-frk.components.button
                label="Cancelar"
                wire:click.prevent="cancel()" />

            <x-frk.components.button
                color="blue"
                label="Guardar Asignación"
                wire:click.prevent="storeAsignarAbonoAnticipado({{ $asignar_abono_anticipado_id }})" />

        </div>

    </x-slot:footer>

</x-frk.components.template-crud>

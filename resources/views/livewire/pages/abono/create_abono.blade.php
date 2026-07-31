<x-frk.components.template-crud maxWidth="4xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <i class="fa-solid fa-money-bill-wave text-orange-500"></i>
            </div>

            <div>
                <h2 class="font-bold text-xl text-gray-800">
                    Nuevo {{ $title }}
                </h2>

                <p class="text-sm text-gray-500">
                    Registro de abono a crédito
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
                        <x-frk.components.title label="Nuevo {{ $title }}" />
                    </div>

                    <x-frk.components.label-input
                        label="No. Abono"
                        wire:model.live="no_abono" />

                    <x-frk.components.date-picker
                        wire:model="fecha_abono"
                        label="Fecha Abono" />

                </div>

            </div>

            {{-- DETALLE DE VENTA --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                <div class="flex items-center gap-2 mb-4">

                    <i class="fa-solid fa-file-invoice-dollar text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Detalle de Venta
                    </h3>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <x-frk.components.label-input
                        label="No. Venta"
                        :disabled="$disabled"
                        wire:model.live="no_venta" />

                    <x-frk.components.date-picker
                        label="Fecha Venta"
                        :disabled="$disabled"
                        wire:model.live="fecha_venta" />

                    <div class="md:col-span-2 flex items-end">

                        <x-frk.components.button
                            color="blue"
                            label="Buscar Venta"
                            wire:click="buscarVenta()" />

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">

                    <x-frk.components.label-input
                        label="Código Interno"
                        :disabled="$disabled"
                        wire:model.live="codigo_interno" />

                    <div class="md:col-span-3">

                        <x-frk.components.label-input
                            label="Empresa"
                            :disabled="$disabled"
                            wire:model.live="nombre_empresa" />

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                    <x-frk.components.label-input
                        label="Nombre Cliente"
                        :disabled="$disabled"
                        wire:model.live="nombres_cliente" />

                    <x-frk.components.label-input
                        label="Apellido Cliente"
                        :disabled="$disabled"
                        wire:model.live="apellidos_cliente" />

                </div>

            </div>

            {{-- RESUMEN FINANCIERO --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                <div class="flex items-center gap-2 mb-4">

                    <i class="fa-solid fa-calculator text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Resumen Financiero
                    </h3>

                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                    <x-frk.components.label-input-moneyy
                        label="Total Venta"
                        :disabled="$disabled"
                        wire:model.live="total_venta" />

                    <x-frk.components.label-input-moneyy
                        label="Notas Crédito"
                        :disabled="$disabled"
                        wire:model.live="total_nota_credito" />

                    <x-frk.components.label-input-moneyy
                        label="Total Abonos"
                        :disabled="$disabled"
                        wire:model.live="total_abono" />

                    <x-frk.components.label-input-moneyy
                        label="Saldo Crédito"
                        :disabled="$disabled"
                        wire:model.live="saldo_credito" />

                </div>

            </div>

            {{-- PAGO --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <div class="flex items-center gap-2 mb-4">

                    <i class="fa-solid fa-wallet text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Información del Pago
                    </h3>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div>

                        <x-frk.components.select
                            label="Tipo Pago"
                            error="tipo_pago_id"
                            wire:model.live="tipo_pago_id">

                            @foreach ($this->tipo_pago as $data)
                                <option value="{{ $data['valor'] }}">
                                    {{ $data['nombre'] }}
                                </option>
                            @endforeach

                        </x-frk.components.select>

                    </div>

                    <x-frk.components.label-input-moneyy
                        label="Cantidad Abono"
                        error="cantidad_abono"
                        wire:model.live="cantidad_abono" />

                    <x-frk.components.label-input-moneyy
                        label="Nuevo Saldo"
                        :disabled="$disabled"
                        wire:model="nuevo_saldo" />

                </div>

            </div>

            {{-- OBSERVACIONES --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                <div class="grid grid-cols-1 gap-4">

                    <x-frk.components.label-input
                        label="Observaciones"
                        wire:model="observaciones" />

                    <x-frk.components.label-input
                        label="Detalle Pago"
                        wire:model="detalle_pago" />

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
                label="Guardar Abono"
                wire:click.prevent="store()" />

        </div>

    </x-slot:footer>

</x-frk.components.template-crud>

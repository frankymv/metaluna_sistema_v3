<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-file-invoice-dollar text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información de la Nota de Crédito
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.input-money
                label="No. Nota Crédito"
                error="codigo"
                :disabled="$disabled"
                wire:model.live="no_nota_credito" />

            <x-frk.components.date-picker
                wire:model="fecha_nota_credito"
                error="fecha_nota_credito"
                label="Fecha Nota Crédito" />

        </div>

    </div>

    {{-- DETALLE VENTA --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-receipt text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Venta Asociada
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
                label="Nombres Cliente"
                :disabled="$disabled"
                wire:model.live="nombres_cliente" />

            <x-frk.components.label-input
                label="Apellidos Cliente"
                :disabled="$disabled"
                wire:model.live="apellidos_cliente" />

        </div>

    </div>

    {{-- RESUMEN FINANCIERO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-calculator text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Resumen Financiero
            </h3>

        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            <x-frk.components.label-input-money
                label="Total Venta"
                :disabled="$disabled"
                wire:model.live="total_venta" />

            <x-frk.components.label-input-money
                label="Total Nota Crédito"
                :disabled="$disabled"
                wire:model.live="total_nota_credito" />

            <x-frk.components.label-input-money
                label="Total Abonos"
                :disabled="$disabled"
                wire:model.live="total_abono" />

            <x-frk.components.label-input-money
                label="Saldo Actual"
                :disabled="$disabled"
                wire:model.live="saldo_credito" />

        </div>

    </div>

    {{-- APLICACION DE NOTA --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-money-check-dollar text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Aplicación de Nota de Crédito
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

                <x-frk.components.toggle
                    :disabled="$disabled"
                    wire:click="anulacionVenta()"
                    label="Anulación Venta"
                    left="No"
                    right="Sí" />

            </div>

            <x-frk.components.label-input-money
                label="Cantidad Nota Crédito"
                error="cantidad_nota_credito"
                wire:model.live="cantidad_nota_credito" />

            <x-frk.components.label-input-money
                label="Nuevo Saldo"
                error="nuevo_saldo"
                :disabled="$disabled"
                wire:model="nuevo_saldo" />

        </div>

    </div>

    {{-- OBSERVACIONES --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-comment text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Observaciones
            </h3>

        </div>

        <x-frk.components.label-input
            label="Observaciones"
            wire:model="observaciones" />

    </div>

    {{-- TOTAL --}}
    <div class="bg-orange-400 rounded-2xl p-5 text-white shadow-lg">

        <div class="flex justify-between items-center">

            <span class="text-lg">
                Nuevo Saldo del Crédito
            </span>

            <span class="text-3xl font-bold">
                Q {{ number_format((float)$nuevo_saldo, 2) }}
            </span>

        </div>

    </div>

    {{-- AUDITORIA --}}
    @if ($isShow)

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

            <div class="flex items-center gap-2 mb-4">

                <i class="fa-solid fa-clock text-orange-500"></i>

                <h3 class="font-semibold text-gray-700">
                    Auditoría
                </h3>

            </div>

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

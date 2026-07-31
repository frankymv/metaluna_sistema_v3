<x-frk.components.template-crud maxWidth="4xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <i class="fa-solid fa-wallet text-orange-500"></i>
            </div>

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Nuevo Abono Anticipado
                </h2>

                <p class="text-sm text-gray-500">
                    Registro de abonos anticipados de clientes
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
                        wire:model.live="no_abono" />

                    <x-frk.components.date-picker
                        error="fecha_abono"
                        wire:model="fecha_abono"
                        label="Fecha Abono" />

                </div>

            </div>

            {{-- CLIENTE --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                <div class="flex items-center justify-between mb-4">

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-user text-orange-500"></i>

                        <h3 class="font-semibold text-gray-700">
                            Cliente
                        </h3>

                    </div>

                    <x-frk.components.button
                        color="blue"
                        label="Buscar Cliente"
                        wire:click="buscarCliente()" />

                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

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

            {{-- INFORMACION DEL PAGO --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <div class="flex items-center gap-2 mb-4">

                    <i class="fa-solid fa-money-bill-wave text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Información del Pago
                    </h3>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-frk.components.select
                        label="Tipo Pago"
                        error="tipo_pago_id"
                        :disabled="$disabled"
                        wire:model.live="tipo_pago_id">

                        @foreach ($this->tipo_pago as $data)

                            <option value="{{ $data['valor'] }}">
                                {{ $data['nombre'] }}
                            </option>

                        @endforeach

                    </x-frk.components.select>

                    <x-frk.components.label-input-moneyy
                        label="Total Abono"
                        error="total_abono"
                        :disabled="$disabled"
                        wire:model.live="cantidad_abono"
                        @blur="
                            let v = parseFloat($event.target.value || 0);
                            $event.target.value = v.toFixed(2);
                        "
                    />

                </div>

            </div>

            {{-- OBSERVACIONES --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

                <div class="flex items-center gap-2 mb-4">

                    <i class="fa-solid fa-comment text-orange-500"></i>

                    <h3 class="font-semibold text-gray-700">
                        Observaciones
                    </h3>

                </div>

                <div class="grid grid-cols-1 gap-4">

                    <x-frk.components.label-input
                        label="Observaciones"
                        wire:model="observaciones" />

                    <x-frk.components.label-input
                        label="Detalle Pago"
                        wire:model="detalle_pago" />

                </div>

            </div>

            {{-- RESUMEN --}}
            <div class="bg-orange-400 rounded-2xl shadow-lg p-5 text-white">

                <div class="flex justify-between items-center">

                    <span class="text-lg">
                        Total del Abono
                    </span>

                    <span class="text-3xl font-bold">
                        Q {{ number_format((float)$cantidad_abono, 2) }}
                    </span>

                </div>

            </div>

            {{-- FECHAS --}}
            @if ($isShow)

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">

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

    </x-slot:body>

    <x-slot:footer>

        <div class="flex justify-end gap-3 w-full">

            <x-frk.components.button
                label="Cancelar"
                wire:click.prevent="cancel()" />

            <x-frk.components.button
                color="blue"
                label="Guardar Abono"
                wire:click.prevent="storeAnticipado()" />

        </div>

    </x-slot:footer>

</x-frk.components.template-crud>

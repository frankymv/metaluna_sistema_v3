<x-frk.components.template-index>

    <x-slot:head></x-slot:head>

    <x-slot:body>



<section class="container mx-auto px-3 lg:px-6 py-4 space-y-6">

    {{-- CABECERA --}}
    <div class="bg-orange-400 rounded-2xl shadow-lg p-2">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <div class="bg-white/20 rounded-xl px-4 py-2 text-white font-bold">
                Venta #{{ $no_venta }}
            </div>
            <div class="flex md:justify-between">
                     <x-frk.components.button
                        label="Buscar Cliente"
                        color="blue"
                        wire:click="searchCliente()" />


                            <x-frk.components.button
                                label="Buscar Productos"
                                color="green"
                                wire:click="buscarProducto()" />

                                 <x-frk.components.button
                                 color="orange"
                                 label="Finalizar Venta"
                                 wire:click="store()" />

            </div>
        </div>
    </div>

    {{-- RESUMEN
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-4">
            <p class="text-gray-500 text-sm">Productos</p>
            <p class="text-2xl font-bold text-orange-500">
                {{ count($productosDetalle) }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-4">
            <p class="text-gray-500 text-sm">Total Venta</p>
            <p class="text-2xl font-bold text-green-600">
                Q {{ number_format($sub_total,2) }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-4">
            <p class="text-gray-500 text-sm">Límite Crédito</p>
            <p class="text-xl font-bold">
                Q {{ number_format($limite_credito,2) }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-4">
            <p class="text-gray-500 text-sm">Saldo Actual</p>
            <p class="text-xl font-bold text-red-500">
                Q {{ number_format($nuevo_saldo,2) }}
            </p>
        </div>

    </div>
--}}
    {{-- DATOS PRINCIPALES --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- INFORMACIÓN DE VENTA --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2">

            <div class="flex items-center gap-2 mb-1">
                <i class="fa-solid fa-receipt text-orange-500"></i>
                <h2 class="font-semibold text-gray-700">
                    Información de Venta
                </h2>
            </div>

            <div class="space-y-3">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <x-frk.components.label-input-number
                        label="No."
                        disabled
                        wire:model="no_venta" />

                    <x-frk.components.label-input
                        disabled
                        label="Fecha Venta"
                        wire:model="fecha_venta" />
                </div>

                <x-frk.components.select
                    label="Forma Pago"
                    error="id_forma_pago"
                    :disabled="$disabled"
                    wire:model.live="id_forma_pago">

                    @foreach ($this->forma_pagos as $data)
                        <option value="{{ $data['valor'] }}">
                            {{ $data['nombre'] }}
                        </option>
                    @endforeach
                </x-frk.components.select>

                <x-frk.components.select
                    label="Envío"
                    error="id_envio"
                    :disabled="$disabled"
                    wire:model.live="id_envio">

                    @foreach ($this->envios as $data)
                        <option value="{{ $data['valor'] }}">
                            {{ $data['nombre'] }}
                        </option>
                    @endforeach
                </x-frk.components.select>

            </div>
        </div>

        {{-- CLIENTE --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-2">

            <div class="flex justify-between items-center mb-1">

                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user text-orange-500"></i>
                    <h2 class="font-semibold text-gray-700">
                        Cliente
                    </h2>
                </div>

                <x-frk.components.button-icon
                    color="red"
                    icon="fa-solid fa-trash"
                    wire:click="borrarTodo()" />
            </div>

            <div class="bg-orange-50 border border-orange-200 rounded-xl p-2 mb-4">

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">

                    <x-frk.components.label-input
                        label="Cod. Interno"
                        :disabled="$disabledInput"
                        wire:model="codigo_interno" />

                    <x-frk.components.label-input
                        label="Cod. Mayor"
                        :disabled="$disabledInput"
                        wire:model="codigo_mayorista" />

                    <x-frk.components.label-input
                        label="NIT"
                        :disabled="$disabledInput"
                        wire:model="nit" />

                    <x-frk.components.label-input
                        label="Tipo Cliente"
                        :disabled="$disabledInput"
                        wire:model="tipo_cliente" />

                </div>

            </div>

            <div class="space-y-3">

                <x-frk.components.label-input-horizontal
                    label="Nombre"
                    error="nombres_cliente"
                    :disabled="$disabled"
                    wire:model="nombres_cliente" />

                <x-frk.components.label-input-horizontal
                    label="Dirección"
                    :disabled="$disabled"
                    wire:model="direccion_fisica" />

            </div>

        </div>

    </div>

    {{-- ERROR --}}
    <x-frk.components.error error="contadorProductos" />

    {{-- PRODUCTOS --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="bg-orange-50 px-5 py-2 border-b border-orange-100">
            <h2 class="font-semibold text-gray-700">
                Detalle de Productos
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-orange-400 text-white">
                    <tr>
                        <th class="px-4 py-3">Código</th>
                        <th class="px-4 py-3">Producto</th>
                        <th class="px-4 py-3">Cant.</th>
                        <th class="px-4 py-3">Precio</th>
                        <th class="px-4 py-3">Subtotal</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @foreach($productosDetalle as $key => $value)

                        <tr class="hover:bg-orange-50 transition-all">

                            <td class="px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <x-frk.components.button-icon
                                        color="red"
                                        icon="fa-solid fa-trash"
                                        wire:click="removeDetalle({{$key}})" />

                                    <span class="font-semibold">
                                        {{ $value['codigo'] }}
                                    </span>

                                </div>

                            </td>

                            <td class="px-4 py-3">

                                <div>
                                    <p class="font-medium">
                                        {{ $value['nombre'] }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $value['nombre_venta'] }}
                                    </p>
                                </div>

                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $value['cantidad_producto'] }}
                            </td>

                            <td class="px-4 py-3 text-right">
                                Q {{ number_format($value['precio_final_venta'],2) }}
                            </td>

                            <td class="px-4 py-3 text-right font-bold text-green-600">
                                Q {{ number_format($value['subtotal_producto'],2) }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

                <tfoot>

                    <tr class="bg-gray-50">

                        <td colspan="2" class="p-4">
                        </td>

                        <td colspan="2" class="text-right font-semibold">
                            Subtotal:
                        </td>

                        <td class="text-right pr-4 font-bold text-xl text-green-600">
                            Q {{ number_format($sub_total,2) }}
                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

   <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

    {{-- OBSERVACIONES Y CREDITO --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-2">

        <div class="flex items-center gap-2 ">
            <i class="fa-solid fa-comment-dots text-orange-500"></i>
            <h2 class="font-semibold text-gray-700">
                Observaciones y Crédito
            </h2>
        </div>

        <div class="space-y-2">

            <x-frk.components.label-input
                label="Observaciones Venta"
                wire:model="observaciones_venta" />
            @if ($id_forma_pago == 'CREDI')

                <div class="border-t pt-1">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                        <x-frk.components.label-input
                            label="Email Autorizador"
                            wire:model="email_edit" />

                               <x-frk.components.label-input-password
                            label="Código de Autorización"
                            wire:model="codigo_edit" />
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">

                         <x-frk.components.label-input
                            label="Observaciones Crédito"
                            wire:model="observaciones_credito" />
                        <div class="flex items-end justify-end">
                            <button
                                wire:click="liberarCredito()"
                                class="inline-flex items-center gap-2 px-5 py-3 bg-orange-400 hover:bg-orange-500 text-white rounded-xl shadow-sm transition-all">

                                <i class="fa-solid fa-unlock"></i>

                                <span>
                                    Liberar Crédito
                                </span>

                            </button>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

    {{-- RESUMEN FINANCIERO --}}
    <div class="bg-orange-400 rounded-2xl shadow-lg text-white p-5">

        <h2 class="font-bold text-lg mb-4">
            Resumen Financiero
        </h2>

        <div >

            <div class="flex justify-between">
                <span>Límite Crédito</span>
                <span>Q {{ number_format($limite_credito,2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Días Autorizados</span>
                <span>{{ $dias_limite_credito }}</span>
            </div>

            <div class="flex justify-between">
                <span>Saldo Anterior</span>
                <span>Q {{ number_format($saldo_credito,2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Abonos</span>
                <span>Q {{ number_format($abono_anticipado,2) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Nuevo Crédito</span>
                <span>Q {{ number_format($sub_total,2) }}</span>
            </div>

            <div class="border-t border-orange-300 pt-3 flex justify-between text-2xl font-bold">

                <span>Saldo Actual</span>

                <span>
                    Q {{ number_format($nuevo_saldo,2) }}
                </span>

            </div>

        </div>

    </div>

</div>




</section>

<script>
window.addEventListener('venta-completada', event => {

    console.log(event.detail[0].pdf);

    window.open(event.detail[0].pdf, '_blank');

    window.location.href = event.detail[0].redirect;

});
</script>


    </x-slot:body>

    <x-slot:footer>
        @if($isSearchCliente) @include('livewire.pages.venta_rapida.searchCliente') @endif
        @if($isAddProduct) @include('livewire.pages.venta_rapida.addProduct') @endif
        @if($isSearchProduct) @include('livewire.pages.venta_rapida.searchProduct') @endif
        @if($isDetalleVenta) @include('livewire.pages.venta_rapida.detalleVenta') @endif
        @if($isPrintVenta) @include('livewire.pages.venta_rapida.printVenta') @endif
    </x-slot:footer>


</x-frk.components.template-index>

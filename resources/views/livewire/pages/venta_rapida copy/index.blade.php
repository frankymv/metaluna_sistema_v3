<x-frk.components.template-index>

    <x-slot:head></x-slot:head>

    <x-slot:body>




        <section class="container mx-auto px-2 lg:px-6 space-y-6">

            <!-- CABECERA -->
            <div class="rounded-xl shadow bg-orange-400 py-2 px-5">
                <x-frk.components.title label="{{ $title }}" />
            </div>

            <!-- DATOS DE VENTA -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                <!-- INFO VENTA -->
                <div class="bg-white rounded-xl shadow p-4 space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <x-frk.components.label-input-number label="No." disabled wire:model="no_venta" />
                        <x-frk.components.label-input disabled label="Fecha Venta" wire:model="fecha_venta" />
                    </div>

                    <x-frk.components.select label="Forma Pago" error="id_forma_pago" :disabled="$disabled" wire:model.live="id_forma_pago">
                        @foreach ($this->forma_pagos as $data)
                            <option value="{{ $data['valor'] }}">{{ $data['nombre'] }}</option>
                        @endforeach
                    </x-frk.components.select>

                    <x-frk.components.select label="Envío" error="id_envio" :disabled="$disabled" wire:model.live="id_envio">
                        @foreach ($this->envios as $data)
                            <option value="{{ $data['valor'] }}">{{ $data['nombre'] }}</option>
                        @endforeach
                    </x-frk.components.select>
                </div>

                <!-- CLIENTE -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow p-4 space-y-3">
                    <div class="flex flex-wrap justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <h2 class="font-bold text-lg">Cliente</h2>
                            <x-frk.components.button label="Buscar Cliente" color="blue" wire:click="searchCliente()" />
                        </div>
                        <x-frk.components.button-icon color="red" icon="fa-solid fa-trash" wire:click="borrarTodo()" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
                        <x-frk.components.label-input label="Cod. Inter" :disabled="$disabledInput" wire:model="codigo_interno" />
                        <x-frk.components.label-input label="Cod. Mayor" :disabled="$disabledInput" wire:model="codigo_mayorista" />
                        <x-frk.components.label-input label="NIT" :disabled="$disabledInput" wire:model="nit" />
                        <x-frk.components.label-input label="Tipo Cliente" :disabled="$disabledInput" wire:model="tipo_cliente" />
                    </div>

                    <x-frk.components.label-input-horizontal label="Nombre" error="nombres_cliente" :disabled="$disabled" wire:model="nombres_cliente" />
                    <x-frk.components.label-input-horizontal label="Dirección" :disabled="$disabled" wire:model="direccion_fisica" />
                </div>

            </div>

            <!-- ERRORES -->
            <x-frk.components.error error="contadorProductos" />

            <!-- DETALLE PRODUCTOS -->
            <div class="bg-white rounded-xl shadow p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-orange-400 text-white">
                            <tr>
                                <th class="px-3 py-2 text-center">Código</th>
                                <th class="px-3 py-2 text-center">Producto</th>
                                <th class="px-3 py-2 text-center">Cant.</th>
                                <th class="px-3 py-2 text-center">Precio</th>
                                <th class="px-3 py-2 text-center">Subtotal</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosDetalle as $key => $value)
                                <tr class="border-b">
                                    <td class="px-3 py-2 font-semibold flex justify-around">
                                    <x-frk.components.button-icon color="red" icon="fa-solid fa-trash" wire:click="removeDetalle({{$key}})" />

                                        {{ $value['codigo'] }}
                                    </td>
                                    <td class="px-3 py-2">
                                        <p>{{ $value['nombre'] }}</p>
                                        <p>{{ $value['nombre_venta'] }}</p>

                                    </td>
                                    <td class="px-3 py-2 text-center">{{ $value['cantidad_producto'] }}</td>
                                    <td class="px-3 py-2 text-right">Q {{ number_format($value['precio_final_venta'], 2) }}</td>
                                    <td class="px-3 py-2 text-right font-semibold">Q  {{ number_format($value['subtotal_producto'], 2) }}</td>
                                </tr>
                            @endforeach

                            <tr class="bg-gray-100 font-semibold">
                                <td></td>
                                <td class="text-center py-2">
                                    <x-frk.components.button label="Buscar Productos" color="green" wire:click="buscarProducto()" />
                                </td>
                                <td></td>
                                <td class="text-right">Subtotal</td>
                                <td class="text-right">Q  {{ number_format($sub_total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- OBSERVACIONES Y TOTAL -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <x-frk.components.label-input label="Observaciones venta" wire:model="observaciones_venta" />

                <div class="bg-gray-50 rounded-xl p-4 text-sm">
                    <p>Limite Crédito Autorizado: <strong>Q {{ $limite_credito }}</strong> | Días Crédito Autorizado: <strong>{{ $dias_limite_credito }}</strong></p>
                    <p>Saldo Credito Anterior: <strong>Q {{ $saldo_credito }}</strong></p>
                    <p>Abonos Anticipados: <strong>Q {{ $abono_anticipado }}</strong></p>
                    <p>Nuevo Credito: <strong>Q {{ $sub_total }}</strong></p>
                    <p>Saldo Credito Actual: <strong>Q {{ $nuevo_saldo  }}</strong></p>
                </div>
            </div>

            <x-frk.components.button color="orange" label="Finalizar Venta" wire:click="store()" />
            <!-- CREDITO -->
            @if ($id_forma_pago == 'CREDI')
                <div class="bg-white rounded-xl shadow p-4 grid grid-cols-1 lg:grid-cols-5 gap-3">
                    <x-frk.components.label-input label="Observaciones crédito" wire:model="observaciones_credito" />
                    <x-frk.components.label-input label="Email" wire:model="email_edit" />
                    <x-frk.components.label-input-password label="Password" wire:model="codigo_edit" />
                    <div class="flex items-end">
                        <x-frk.components.button-icon color="red" icon="fa-solid fa-unlock" wire:click="liberarCredito()" />
                    </div>
                </div>
            @endif
        </section>
    </x-slot:body>

    <x-slot:footer>
        @if($isSearchCliente) @include('livewire.pages.venta_rapida.searchCliente') @endif
        @if($isAddProduct) @include('livewire.pages.venta_rapida.addProduct') @endif
        @if($isSearchProduct) @include('livewire.pages.venta_rapida.searchProduct') @endif
        @if($isDetalleVenta) @include('livewire.pages.venta_rapida.detalleVenta') @endif
        @if($isPrintVenta) @include('livewire.pages.venta_rapida.printVenta') @endif
    </x-slot:footer>

</x-frk.components.template-index>

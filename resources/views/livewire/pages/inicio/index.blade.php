<div class="w-full space-y-6">

        <!-- METRICAS -->


    <!-- METRICAS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5">

        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-1">
            <div class="p-3 bg-orange-100 text-orange-500 rounded-full">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <div class="px-4">
                @props(['label'=>'','font_size'=>'text-lg'])
                <p class="uppercase font-semibold text-sm ">USUARIO: {{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</p>
                <p class="uppercase font-semibold text-sm ">ASIGNACION: {{ Auth::user()->sucursal->nombre  }}</p>
                <p class="uppercase font-semibold text-sm ">ROL: {{ Auth::user()->roles[0]->name  }}</p>
            </div>
        </div>

        <!-- Ventas del día -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-5">
            <div class="p-3 bg-orange-100 text-orange-500 rounded-full">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20">
                    <path d="M17.35 2.219h-5.934L2.654 10.98l5.933 5.934 8.762-8.763V2.651z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $ventas_del_dia }}</p>
                <p class="text-sm text-gray-500">Ventas del día</p>
            </div>
        </div>

        <!-- Productos bajos -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-5">
            <div class="p-3 bg-orange-100 text-orange-500 rounded-full">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20">
                    <path d="M17.35 2.219h-5.934L2.654 10.98l5.933 5.934 8.762-8.763V2.651z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $productos_baja_existencia_canitdad }}</p>
                <p class="text-sm text-gray-500">Productos con baja existencia</p>
            </div>
        </div>

        <!-- Créditos -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-5">
            <div class="p-3 bg-orange-100 text-orange-500 rounded-full">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20">
                    <path d="M17.35 2.219h-5.934L2.654 10.98l5.933 5.934 8.762-8.763V2.651z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $creditos_cantidad }}</p>
                <p class="text-sm text-gray-500">Créditos activos</p>
            </div>
        </div>

        <!-- Envíos -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-5">
            <div class="p-3 bg-orange-100 text-orange-500 rounded-full">
                <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20">
                    <path d="M17.35 2.219h-5.934L2.654 10.98l5.933 5.934 8.762-8.763V2.651z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800">{{ $envios_pendiente_finalizar }}</p>
                <p class="text-sm text-gray-500">Envíos pendientes</p>
            </div>
        </div>

    </div>

 <!-- TABLAS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

        <!-- Ventas recientes -->
        <div class="bg-white rounded-xl shadow p-4">
            <x-frk.components.subtitle label="Ventas recientes" />

            <div class="overflow-x-auto mt-3">
                <table class="min-w-full text-sm">
                    <thead class="bg-orange-400 text-white">
                        <tr>
                            <th class="px-3 py-2 text-left">No Venta</th>
                            <th class="px-3 py-2 text-left">Cliente</th>
                            <th class="px-3 py-2 text-left">Fecha</th>
                            <th class="px-3 py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($venta_reciente as $venta)
                            <tr class="border-b">
                                <td class="px-3 py-2 font-semibold">{{ $venta->no_venta }}</td>
                                <td class="px-3 py-2">{{ $venta->cliente->nombres_cliente }}</td>
                                <td class="px-3 py-2">{{ $venta->fecha_venta }} {{ $venta->hora_venta }}</td>
                                <td class="px-3 py-2 text-right font-semibold">Q {{ $venta->total_venta }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                    Sin registros
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

          <!-- Productos bajos -->
        <div class="bg-white rounded-xl shadow p-4">
            <x-frk.components.subtitle label="Productos con baja existencia" />

            <div class="overflow-x-auto mt-3">
                <table class="min-w-full text-sm">
                    <thead class="bg-orange-400 text-white">
                        <tr>
                            <th class="px-3 py-2 text-left">Código</th>
                            <th class="px-3 py-2 text-left">Producto</th>
                            <th class="px-3 py-2 text-right">Existencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos_baja_existencia as $producto)
                            <tr class="border-b">
                                <td class="px-3 py-2 font-semibold">{{ $producto->codigo }}</td>
                                <td class="px-3 py-2">{{ $producto->nombre }}</td>
                                <td class="px-3 py-2 text-right">{{ $producto->existencia }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-4 text-center text-gray-500">
                                    Sin registros
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Envíos -->
        <div class="bg-white rounded-xl shadow p-4 lg:col-span-2">
            <x-frk.components.subtitle label="Envíos pendientes de finalizar" />

            <div class="overflow-x-auto mt-3">
                <table class="min-w-full text-sm">
                    <thead class="bg-orange-400 text-white">
                        <tr>
                            <th class="px-3 py-2 text-left">No Envío</th>
                            <th class="px-3 py-2 text-left">Ruta</th>
                            <th class="px-3 py-2 text-left">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($envios as $envio)
                            <tr class="border-b">
                                <td class="px-3 py-2 font-semibold">{{ $envio->envio_no }}</td>
                                <td class="px-3 py-2">{{ $envio->ruta->nombre }}</td>
                                <td class="px-3 py-2">{{ $envio->envio_fecha }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-4 text-center text-gray-500">
                                    Sin registros
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</div>

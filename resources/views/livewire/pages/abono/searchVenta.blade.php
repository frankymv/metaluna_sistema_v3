<x-frk.components.template-crud maxWidth="5xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">

                <i class="fa-solid fa-file-invoice-dollar text-orange-500"></i>

            </div>

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Buscar Venta
                </h2>

                <p class="text-sm text-gray-500">
                    Seleccione una venta para continuar
                </p>

            </div>

        </div>

    </x-slot:title>

    <x-slot:body>

        <div class="flex flex-col space-y-5">

            {{-- FILTROS --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                    <div class="md:col-span-2">

                        <x-frk.components.label-input
                            label="No. Venta"
                            wire:model.live="search_no_venta" />

                    </div>

                    <div class="md:col-span-4">

                        <x-frk.components.label-input
                            label="Nombre Cliente"
                            wire:model.live="search_nombres_cliente" />

                    </div>

                    <div class="md:col-span-3">

                        <x-frk.components.label-input
                            label="Código Cliente"
                            wire:model.live="search_codigo_cliente" />

                    </div>

                    <div class="md:col-span-3 flex items-end">

                        <x-frk.components.button
                            label="Cancelar"
                            wire:click="cancelarBuscarVenta()" />

                    </div>

                </div>

            </div>

            {{-- RESULTADOS --}}
            @if ($ventas)

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                    <div class="px-5 py-3 bg-orange-400 text-white">

                        <div class="flex justify-between items-center">

                            <h3 class="font-semibold">
                                Ventas Encontradas
                            </h3>

                            <span class="bg-white/20 px-3 py-1 rounded-lg text-sm">

                                {{ count($ventas) }} registros

                            </span>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-orange-100">

                                <tr>

                                    <th class="px-4 py-3 text-left">
                                        Venta
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Cliente
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Detalle Financiero
                                    </th>

                                    <th class="px-4 py-3 text-right">
                                        Saldo Actual
                                    </th>

                                    <th class="px-4 py-3 text-center">
                                        Acción
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach($ventas as $value)

                                    <tr class="hover:bg-orange-50">

                                        <td class="px-4 py-3">

                                            <div class="font-semibold text-gray-800">

                                                #{{ $value->no_venta }}

                                            </div>

                                            <div class="text-gray-500 text-xs">

                                                {{ $value->fecha_venta }}

                                            </div>

                                        </td>

                                        <td class="px-4 py-3">

                                            <div class="font-medium">

                                                {{ $value->cliente->nombres_cliente }}
                                                {{ $value->cliente->apellidos_cliente }}

                                            </div>

                                            <div class="text-gray-500 text-xs">

                                                Código:
                                                {{ $value->cliente->codigo_mayorista }}

                                            </div>

                                        </td>

                                        <td class="px-4 py-3">

                                            <div>
                                                Venta:
                                                <span class="font-medium">
                                                    Q {{ number_format($value->total_venta, 2) }}
                                                </span>
                                            </div>

                                            <div>
                                                Nota Crédito:
                                                <span class="font-medium">
                                                    Q {{ number_format($value->total_nota_credito, 2) }}
                                                </span>
                                            </div>

                                            <div>
                                                Abonos:
                                                <span class="font-medium">
                                                    Q {{ number_format($value->total_abono, 2) }}
                                                </span>
                                            </div>

                                        </td>

                                        <td class="px-4 py-3 text-right">

                                            <span class="font-bold text-orange-600">

                                                Q {{
                                                    number_format(
                                                        ($value->total_venta
                                                        - $value->total_nota_credito)
                                                        - $value->total_abono,
                                                        2
                                                    )
                                                }}

                                            </span>

                                        </td>

                                        <td class="px-4 py-3 text-center">

                                            <x-frk.buttons.plus-button
                                                color="blue"
                                                label="Seleccionar"
                                                wire:click="agregarVenta({{ $value->no_venta }})" />

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                            

                        </table>

                    </div>

                </div>

            @endif

        </div>

    </x-slot:body>

    <x-slot:footer>
    </x-slot:footer>

</x-frk.components.template-crud>

<x-frk.components.template-crud maxWidth="4xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">

                <i class="fa-solid fa-users text-orange-500"></i>

            </div>

            <div>

                <h2 class="font-bold text-xl text-gray-800">
                    Buscar Cliente
                </h2>

                <p class="text-sm text-gray-500">
                    Seleccione un cliente para continuar
                </p>

            </div>

        </div>

    </x-slot:title>

    <x-slot:body>

        <div class="flex flex-col space-y-5">

            {{-- FILTROS --}}
            <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                    <div class="md:col-span-4">

                        <x-frk.components.label-input
                            label="Código Cliente"
                            wire:model.live="search_codigo_cliente_anticipado" />

                    </div>

                    <div class="md:col-span-6">

                        <x-frk.components.label-input
                            label="Nombre Cliente"
                            wire:model.live="search_nombres_cliente_anticipado" />

                    </div>

                    <div class="md:col-span-2 flex items-end">

                        <x-frk.components.button
                            label="Cancelar"
                            wire:click="cancelarBuscarVenta()" />

                    </div>

                </div>

            </div>

            {{-- RESULTADOS --}}
            @if ($clientes_search)

                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                    <div class="px-5 py-3 bg-orange-400 text-white">

                        <div class="flex justify-between items-center">

                            <h3 class="font-semibold">
                                Resultados de Búsqueda
                            </h3>

                            <span class="text-sm bg-white/20 px-3 py-1 rounded-lg">

                                {{ count($clientes_search) }} clientes

                            </span>

                        </div>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-orange-100">

                                <tr>

                                    <th class="px-4 py-3 text-left">
                                        Código Mayorista
                                    </th>

                                    <th class="px-4 py-3 text-left">
                                        Cliente
                                    </th>

                                    <th class="px-4 py-3 text-center">
                                        Acción
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @forelse($clientes_search as $value)

                                    <tr class="hover:bg-orange-50">

                                        <td class="px-4 py-3 font-medium">

                                            {{ $value->codigo_mayorista }}

                                        </td>

                                        <td class="px-4 py-3">

                                            {{ $value->nombres_cliente }}
                                            {{ $value->apellidos_cliente }}

                                        </td>

                                        <td class="px-4 py-3 text-center">

                                            <x-frk.buttons.plus-button
                                                color="blue"
                                                label="Seleccionar"
                                                wire:click="agregarCliente({{ $value->id }})" />

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="3"
                                            class="text-center py-10 text-gray-500">

                                            No se encontraron clientes

                                        </td>

                                    </tr>

                                @endforelse

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

<x-frk.components.template-crud maxWidth="4xl">

    <x-slot:title>
        <div class="flex items-center gap-3">

            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-orange-100">
                <i class="fa-solid fa-users text-orange-500"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Buscar Cliente
                </h2>
                <p class="text-sm text-gray-500">
                    Seleccione un cliente para continuar con la venta
                </p>
            </div>

        </div>
    </x-slot:title>

    <x-slot:body>

       {{-- FILTROS --}}
<div class="flex flex-col w-full bg-orange-50 border border-orange-100 rounded-2xl p-4 mb-5">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 w-full">

        <x-frk.components.label-input
            label="Código"
            :disabled="$disabled"
            wire:model.live="search_codigo_cliente" />

        <x-frk.components.label-input
            label="Nombre"
            :disabled="$disabled"
            wire:model.live="search_nombres_cliente" />

        <x-frk.components.label-input
            label="NIT"
            :disabled="$disabled"
            wire:model.live="search_nit_cliente" />

        <div class="flex items-end">
            <x-frk.components.button
                label="Cancelar"
                color="red"
                wire:click="cancelarBuscarCliente()" />
        </div>

    </div>

</div>

{{-- RESULTADOS --}}
@if ($clientes)

<div class="flex flex-col w-full bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    <div class="flex items-center justify-between px-5 py-3 bg-orange-400 text-white">

        <h3 class="font-semibold">
            Clientes encontrados
        </h3>

        <span class="bg-white/20 px-3 py-1 rounded-lg text-sm">
            {{ count($clientes) }} registros
        </span>

    </div>

    <div class="w-full overflow-x-auto">

        <table class="min-w-full text-sm">

            <thead class="bg-orange-100">

                <tr>

                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                        Código
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                        Cliente
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                        Empresa
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                        Tipo
                    </th>

                    <th class="px-4 py-3 text-center font-semibold text-gray-700">
                        Acción
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse($clientes as $value)

                <tr class="hover:bg-orange-50 transition-all duration-200">

                    <td class="px-4 py-3">

                        <div>

                            <p class="font-semibold text-gray-800">
                                {{ $value->codigo_interno }}
                            </p>

                            <p class="text-xs text-gray-500">
                                Mayorista: {{ $value->codigo_mayorista }}
                            </p>

                        </div>

                    </td>

                    <td class="px-4 py-3">

                        <div>

                            <p class="font-medium text-gray-800">
                                {{ $value->nombres_cliente }}
                            </p>

                            <p class="text-xs text-gray-500">
                                NIT: {{ $value->nit_cliente }}
                            </p>

                        </div>

                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $value->nombre_empresa }}
                    </td>

                    <td class="px-4 py-3">

                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-600">
                            {{ $value->tipo_cliente }}
                        </span>

                    </td>

                    <td class="px-4 py-3 text-center">

                        <button
                            wire:click="agregarCliente({{ $value->id }})"
                            class="bg-orange-400 hover:bg-orange-500 text-white px-4 py-2 rounded-xl shadow-sm transition-all duration-200">

                            <i class="fa-solid fa-plus mr-1"></i>
                            Seleccionar

                        </button>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="py-12 text-center">

                            <i class="fa-solid fa-users text-5xl text-gray-300"></i>

                            <p class="mt-4 text-gray-500">
                                No se encontraron clientes.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endif

    </x-slot:body>

    <x-slot:footer>
    </x-slot:footer>

</x-frk.components.template-crud>

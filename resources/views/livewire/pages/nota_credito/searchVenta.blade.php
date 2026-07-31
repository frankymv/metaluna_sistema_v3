<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>
        <x-frk.components.title label="Buscar Cliente" />
    </x-slot>

        <x-slot:body>
            <div class="flex flex-wrap w-full">
                    <div class="    flex-wrap w-full">
                        <div class="flex-wrap w-full">
                            <div class="flex w-full ">
                                <x-frk.components.label-input label="No Venta"  wire:model.live="search_no_venta" />
                                <x-frk.components.label-input label="nombres_cliente"  wire:model.live="search_nombres_cliente" />
                                <x-frk.components.label-input label="codigo_cliente"  wire:model.live="search_codigo_cliente" />
                                <x-frk.components.button label="cancelar" wire:click="cancelarBuscarVenta()" />
                            </div>

                        </div>

                        @if ($ventas)

                        <div class="w-full   shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-2 py-1">
                                            No Venta
                                        </th>
                                        <th scope="col" class="px-2 py-1">
                                            Fecha venta
                                        </th>
                                        <th scope="col" class="px-2 py-1">
                                            Datos Cliente
                                        </th>

                                        <th scope="col" class="px-2 py-1">
                                            Detalle
                                        </th>
                                        <th scope="col" class="px-2 py-1">
                                            Saldo Actual
                                        </th>
                                        <th scope="col" class="px-2 py-1">
                                            Accion
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($ventas as $key => $value)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                       <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-prewrap dark:text-white">
                                            {{$value->no_venta}}
                                        </th>
                                        <td class="px-2 py-1">
                                            {{$value->fecha_venta}}
                                        </th>
                                        <td class="px-2 py-1">
                                            Codigo: {{$value->cliente->codigo_mayorista}}</br>
                                            {{$value->cliente->nombres_cliente}} {{$value->cliente->apellidos_cliente}}
                                        </th>
                                        <td class="px-2 py-1">
                                            Total Venta: Q. {{$value->total_venta}}</br>
                                            Nota Credito: Q. {{$value->total_nota_credito}}</br>
                                            Abonos: {{ $value->total_abono }}</br>
                                        </th>
                                        <td class="px-2 py-1">
                                            Q. {{($value->total_venta - $value->total_nota_credito) - $value->total_abono}}
                                        </th>

                                        <td class="px-2 py-1">
                                            <x-frk.buttons.plus-button label="agregar" wire:click="agregarVenta({{$value->id}})" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @endif

                    </div>
                </div>
        </x-slot>

    <x-slot:footer>
    </x-slot>


</x-frk.modal>


<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Detalle {{$title}}" />
    </x-slot>
       <x-slot:body>
            

            <div class="w-full p-4">

            {{-- Encabezado --}}
            <div class="bg-orange-500 text-white font-bold text-center py-2 border border-gray-700">
                Estado Cuenta Venta
            </div>

            {{-- Información de la venta --}}
            <div class="border-l border-r border-b border-gray-700">

                <div class="flex border-b border-gray-700">
                    <div class="w-1/3 bg-gray-200 font-bold p-2">No Venta</div>
                    <div class="w-2/3 p-2">{{ $venta->no_venta }}</div>
                </div>

                <div class="flex border-b border-gray-700">
                    <div class="w-1/3 bg-gray-200 font-bold p-2">Fecha Venta</div>
                    <div class="w-2/3 p-2">{{ $venta->fecha_venta }}</div>
                </div>

                <div class="flex border-b border-gray-700">
                    <div class="w-1/3 bg-gray-200 font-bold p-2">Código Mayorista</div>
                    <div class="w-2/3 p-2">{{ $venta->cliente->codigo_mayorista }}</div>
                </div>

                <div class="flex border-b border-gray-700">
                    <div class="w-1/3 bg-gray-200 font-bold p-2">Cliente</div>
                    <div class="w-2/3 p-2">{{ $venta->cliente->nombres_cliente }}</div>
                </div>

            </div>

                    @php

    $totalVenta = $venta->total_venta;

    $totalAbonos = $venta->abonos->sum('total_abono');

    $totalNotas = $venta->notacreditos->sum('total_nota_credito');

    $saldo = $totalVenta - $totalAbonos - $totalNotas;

@endphp

            {{-- Movimientos --}}
            <div class="bg-orange-500 text-white font-bold text-center py-2 border-l border-r border-b border-gray-700">
                Movimientos
            </div>

            <div class="border-l border-r border-b border-gray-700">
                <div class="flex border-b border-gray-700">
                    <div class="w-1/3 bg-gray-200 font-bold p-2">
                        Movimientos
                    </div>

                    <div class="w-2/3 p-2">

                        @forelse($movimientos as $movimiento)
                            <div class="mb-1">
                                {{ $movimiento->fecha }}
                                | {{ $movimiento->tipo }}
                                | Q {{ number_format($movimiento->monto, 2) }}
                            </div>
                        @empty
                            Sin movimientos
                        @endforelse

                    </div>
                </div>
            </div>

                {{-- Saldo --}}
                <div class="bg-orange-500 text-white font-bold text-center py-2 border-l border-r border-b border-gray-700">
                    Saldo:
                </div>

                <div class="border-l border-r border-b border-gray-700">

                    <div class="flex border-b border-gray-700">
                        <div class="w-1/3 bg-gray-200 font-bold p-2 flex items-center">
                            Saldos:
                        </div>

                        <div class="w-2/3 p-2">
                                <div>
        <strong>Total Venta:</strong>
        {{ number_format($totalVenta,2) }}
    </div>

    <div>
        <strong>Total Abonos:</strong>
        {{ number_format($totalAbonos,2) }}
    </div>

    <div>
        <strong>Total Nota Crédito:</strong>
        {{ number_format($totalNotas,2) }}
    </div>

    <hr>

    <div>

        <strong>Saldo:</strong>

        @if($saldo > 0)

            <span class="text-danger fw-bold">
                {{ number_format($saldo,2) }}
            </span>

        @else

            <span class="text-success fw-bold">
                {{ number_format($saldo,2) }}
            </span>

        @endif

    </div>
                            
                        </div>
                    </div>

                    <div class="flex border-b border-gray-700">
                        <div class="w-1/3 bg-gray-200 font-bold p-2">
                            Anulado
                        </div>
                        <div class="w-2/3 p-2">
                            {{ $venta->anulado ? 'Si' : 'No' }}
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-1/3 bg-gray-200 font-bold p-2">
                            Cancelado
                        </div>
                        <div class="w-2/3 p-2">
                            {{ $venta->cancelado ? 'Si' : 'No' }}
                        </div>
                    </div>
                </div>
            </div>

    




        </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.components.template-crud>




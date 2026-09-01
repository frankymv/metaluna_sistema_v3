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
            <div class="w-2/3 p-2">{{ $venta->mayorista_id }}</div>
        </div>

        <div class="flex border-b border-gray-700">
            <div class="w-1/3 bg-gray-200 font-bold p-2">Cliente</div>
            <div class="w-2/3 p-2">{{ $venta->cliente_nombre }}</div>
        </div>

    </div>

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



@php


// Crédito inicial
if ($venta->credi) {
    $movimientos->push([
        'tipo' => 'credito',
        'no' => $venta->no_venta,
        'correlativo' => 1,
        'fecha' => $venta->fecha_venta,
        'total' => $venta->total_credito,
    ]);
}

// Abonos
foreach ($venta->abonos as $abono) {
    $movimientos->push([
        'tipo' => 'abono',
        'no' => $abono->no_abono,
        'correlativo' => $abono->correlativo,
        'fecha' => $abono->fecha_abono,
        'total' => $abono->total_abono,
    ]);
}

// Notas de crédito
foreach ($venta->notacreditos as $nota) {
    $movimientos->push([
        'tipo' => 'nota_credito',
        'no' => $nota->no_nota_credito,
        'correlativo' => $nota->correlativo,
        'fecha' => $nota->fecha_nota_credito,
        'total' => $nota->total_nota_credito,
    ]);
}

// Ordenar por correlativo
$movimientos = $movimientos->sortBy('correlativo');
@endphp


<div class="p-2">
    @forelse($movimientos as $movimiento)

        <div class="mb border-bottom pb
            {{ $movimiento['tipo'] == 'nota_credito' ? 'text-danger' : '' }}">

            @if($movimiento['tipo'] == 'credito')

                <strong>Crédito No:</strong>
                {{ $movimiento['no'] }},
                
                <strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }},                

                <strong>Total Crédito:</strong>
                Q {{ number_format($movimiento['total'], 2) }}

            @elseif($movimiento['tipo'] == 'abono')

                <strong>Abono No:</strong>
                {{ $movimiento['no'] }},
                <strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }},
                <strong>Total Abono:</strong>
                Q {{ number_format($movimiento['total'], 2) }}

            @elseif($movimiento['tipo'] == 'nota_credito')

                <strong>Nota Crédito No:</strong>
                {{ $movimiento['no'] }},
                <strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }},
                <strong>Total Nota Credito:</strong>
                Q {{ number_format($movimiento['total'], 2) }}

            @endif

        </div>

    @empty

        <span class="text-secondary">
            Sin movimientos
        </span>

    @endforelse

</div>











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
                    Q {{ number_format($venta->total, 2) }}
                </div>

                <div>
                    <strong>Total Abonos:</strong>
                    Q {{ number_format($total_abonos, 2) }}
                </div>

                <div>
                    <strong>Total Notas Crédito:</strong>
                    Q {{ number_format($total_notas_credito, 2) }}
                </div>

                <div>
                    <strong>Saldo Actual:</strong>
                    Q {{ number_format($saldo_actual, 2) }}
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
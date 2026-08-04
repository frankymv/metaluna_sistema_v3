@php
$movimientos = collect();

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
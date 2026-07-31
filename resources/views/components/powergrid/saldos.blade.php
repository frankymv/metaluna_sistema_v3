@php

    $totalVenta = $venta->total_venta;

    $totalAbonos = $venta->abonos->sum('total_abono');

    $totalNotas = $venta->notacreditos->sum('total_nota_credito');

    $saldo = $totalVenta - $totalAbonos - $totalNotas;

@endphp

<div class="p-2">

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

<div class="p-2">

    @foreach($venta->abonos as $abono)

        <div class="mb-3 border-bottom pb-2">

            <strong>No. Abonoooooo:</strong>
            {{ $abono->correlativo_abono }}

            <br>

            <strong>Fecha:</strong>
            {{ \Carbon\Carbon::parse($abono->fecha_abono)->format('d/m/Y') }}

            <br>

            <strong>Total:</strong>

            Q {{ number_format($abono->total_abono,2) }}

        </div>

    @endforeach


    {{-- NOTAS DE CRÉDITO --}}
    @foreach($venta->notacreditos as $nota)

        <div class="mb-3 border-bottom pb-2 text-danger">

            <strong>No. Nota Crédito:</strong>
            {{ $nota->correlativo_nota_credito }}

            <br>

            <strong>Fecha:</strong>
            {{ \Carbon\Carbon::parse($nota->fecha_nota_credito)->format('d/m/Y') }}

            <br>

            <strong>Total:</strong>

            Q {{ number_format($nota->total_nota_credito,2) }}

        </div>

    @endforeach


    @if($venta->abonos->isEmpty() && $venta->notacreditos->isEmpty())

        <span class="text-secondary">
            Sin movimientos
        </span>

    @endif

</div>

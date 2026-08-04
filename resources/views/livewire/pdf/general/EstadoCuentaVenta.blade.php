<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte</title>
    <style type="text/css">

        @page{
            size: letter landscape;
            margin: 12mm;
            }
            *{
                margin:0;
                padding:0;
                text-indent:0;
            }
            body{
                font-family: DejaVu Sans, sans-serif;
                font-size:11px;
            }
            h1{
                font-size:20px;
                font-weight:bold;
            }
            table{
                width:100%;
                border-collapse:collapse;
            }
            th,td{
                border:1px solid #000;
                padding:5px;
                text-align:center;
                vertical-align:middle;
            }

            .titulo-seccion{
                background:#e86e3d;
                color:#FFF;
                font-weight:bold;
            }

            .gris{
                background:#EFEFEF;
                font-weight:bold;
            }

            .salmon{
                background:#f7d7cc;
            }

    </style>
</head>

<body style="padding:10px">
    @php
        $bg_base64 = base64_encode(file_get_contents(public_path('assets/imagenes/encabezado.png')));
        $totalVenta = 0;
        $totalCredito = 0;
        $totalAbono = 0;
        $totalNotaCredito = 0;
        $totalSaldoVenta = 0;
        $clienteCodigo = $data->first()?->cliente_id;
        $clienteNombre = $data->first()?->cliente?->nombres_cliente;
        $primeraFecha = $data->min('fecha_venta');
        $ultimaFecha = $data->max('fecha_venta');
    @endphp

<div style="width:100%;">

    <!-- ===================== ENCABEZADO ===================== -->
    <div style="
        position:relative;
        width:100%;
        height:100px;
        overflow:hidden;
        background-image:url('data:image/png;base64,{{$bg_base64}}');
        background-size:cover;
        background-repeat:no-repeat;
        background-position:right center;
        margin-bottom:12px;
        ">
        <div style="
            position:absolute;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background:linear-gradient(90deg,
                rgba(255,255,255,.98) 0%,
                rgba(255,255,255,.92) 45%,
                rgba(255,255,255,.25) 100%);
        ">
        </div>

        <div style="
            position:relative;
            padding:18px;
            text-align:right;
            ">

            <h1>DISTRIBUIDORA METALUNA</h1>

            <p style="font-size:10px;">
                9 calle, Zona 3, Totonicapán
            </p>

            <p style="font-size:10px;">
                <strong>Pedidos a Oficina:</strong>
                7766-4092 · 3023-9120 · 4642-7166 · 3059-7733
            </p>

            <p style="font-size:10px;">
                Correo Electrónico:
                metaluna@gmail.com
            </p>

        </div>

    </div>


    <!-- ===================== Encabezado Tabla ===================== -->


    <table>
    <thead>
        <tr class="titulo-seccion">
            <td>No Venta</td>
            <td>Fecha Venta</td>
            <td>Cogido Mayorista</td>
            <td>Cliente</td>
            <td>Movimientos</td>
            <td>Saldos</td>
            <td>Anulado</td>
            <td>Cancelado</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        @php
            $totalVenta += $row->total_venta;
            $totalCredito += $row->total_credito;
            $totalAbono += $row->total_abono;
            $totalNotaCredito += $row->total_nota_credito;
            $totalSaldoVenta += $row->saldo_venta;

            $fechaLimite = $row->fecha_limite_credito
                ? \Carbon\Carbon::parse($row->fecha_limite_credito)
                : null;

            $hoy = \Carbon\Carbon::today();
            if ($row->saldo_venta <= 0) {
                $estadoCredito = 'CANCELADO';
                $colorEstado = '#6b7280';
            } elseif ($fechaLimite && $fechaLimite->lt($hoy)) {
                $dias = (int) $fechaLimite->diffInDays($hoy);
                $estadoCredito = "VENCIDA ({$dias} días)";
                $colorEstado = '#dc2626';
            } elseif ($fechaLimite) {
                $dias = (int) $hoy->diffInDays($fechaLimite);
                $estadoCredito = "RESTAN {$dias} días";
                $colorEstado = '#16a34a';
            } else {
                $estadoCredito = 'SIN FECHA';
                $colorEstado = '#6b7280';
            }
        @endphp
        <tr>
    <td>{{ $row->no_venta }}</td>
    <td>
        {{ \Carbon\Carbon::parse($row->fecha_venta)->format('d/m/Y') }}
    </td>
    <td>{{ $row->codigo_mayorista }}</td>
    <td>
        {{ $row->cliente->nombres_cliente ?? '' }}
    </td>
    {{-- MOVIMIENTOS --}}
    <td style="text-align:left; font-size:8px;">
        @php
            $movimientos = collect();
            if ($row->credi) {
                $movimientos->push([
                    'tipo' => 'credito',
                    'no' => $row->no_venta,
                    'correlativo' => 1,
                    'fecha' => $row->fecha_venta,
                    'total' => $row->total_credito,
                ]);
            }
            foreach ($row->abonos as $abono) {
                $movimientos->push([
                    'tipo' => 'abono',
                    'no' => $abono->no_abono,
                    'correlativo' => $abono->correlativo,
                    'fecha' => $abono->fecha_abono,
                    'total' => $abono->total_abono,
                ]);
            }
            foreach ($row->notacreditos as $nota) {
                $movimientos->push([
                    'tipo' => 'nota_credito',
                    'no' => $nota->no_nota_credito,
                    'correlativo' => $nota->correlativo,
                    'fecha' => $nota->fecha_nota_credito,
                    'total' => $nota->total_nota_credito,
                ]);
            }

            $movimientos = $movimientos->sortBy('correlativo');
        @endphp

        @forelse($movimientos as $movimiento)

            @if($movimiento['tipo'] == 'credito')

                <strong>CRÉDITO</strong>
                No: {{ $movimiento['no'] }}
               <strong> Fecha: </strong>{{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}
                <strong>Total </strong>Q {{ number_format($movimiento['total'],2) }}<br>

            @elseif($movimiento['tipo'] == 'abono')

                <strong>ABONO</strong>
               <strong> Fecha: </strong> No: {{ $movimiento['no'] }}
                {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}
               <strong>Total </strong> Q {{ number_format($movimiento['total'],2) }}<br>

            @elseif($movimiento['tipo'] == 'nota_credito')

                <strong>NOTA CRÉDITO</strong>
                <strong> Fecha: </strong>No: {{ $movimiento['no'] }}
                {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}
                <strong>Total </strong>Q {{ number_format($movimiento['total'],2) }}<br>

            @endif

            <br><br>

        @empty

            Sin movimientos

        @endforelse

    </td>

    {{-- SALDOS --}}
    <td style="text-align:left; font-size:8px;">

        @php
            $totalVenta = $row->total_venta;
            $totalAbonos = $row->abonos->sum('total_abono');
            $totalNotas = $row->notacreditos->sum('total_nota_credito');
            $saldo = $totalVenta - $totalAbonos - $totalNotas;
        @endphp
        <strong>Total Venta:</strong>
        Q {{ number_format($totalVenta, 2) }}<br>
        <strong>Total Abonos:</strong>
        Q {{ number_format($totalAbonos, 2) }}<br>
        <strong>Total Notas Crédito:</strong>
        Q {{ number_format($totalNotas, 2) }}<br>
        <strong>Total Saldo:</strong>
        Q {{ number_format($saldo, 2) }}<br>
    </td>

    <td>{{ $row->anulado }}</td>

    <td>{{ $row->cancelado }}</td>
</tr>

        @endforeach

       

    </tbody>
</table>
  <!-- ===================== Fin Tabla ===================== -->
</div>

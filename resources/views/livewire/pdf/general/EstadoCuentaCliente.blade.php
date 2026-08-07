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
            th{
                font-size: 11px;
                border:1px solid #000;
                padding:5px;
                text-align:center;
                vertical-align:middle;
            }
            td{
                font-size: 8px;
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
<table style="width:100%; border-collapse:collapse;">

    <thead>
        <tr class="titulo-seccion">
            <th colspan="2">ESTADO DE CUENTA CLIENTE</th>
        </tr>
    </thead>
</table>
   






    <!-- ===================== Encabezado Tabla ===================== -->


    <table>
    <thead>
        <tr class="titulo-seccion">
            <td>Cod. Int</td>
            <td>Cod. May</td>
            <td>Nombre Cliente</td>
            <td>Tipo de Cliente</td>
            <td>No Venta</td>
            <td>Fecha Venta</td>
            <td>Fecha Límite</td>
            <td>Vencimiento</td>
            <td>Forma de Pago</td>
            <td>Total Venta</td>
            <td>Total Crédito</td>
            <td>Total Abono</td>
            <td>Total Nota Crédito</td>
            <td>Saldo Actual</td>
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
                    $estadoCredito = 'Cancelado';
                    $colorEstado = '#6b7280'; // Gris
                } elseif ($fechaLimite && $fechaLimite->lt($hoy)) {
                    $dias = (int) $fechaLimite->diffInDays($hoy);
                    $estadoCredito = "Vencida ({$dias} días)";
                    $colorEstado = '#dc2626'; // Rojo
                } elseif ($fechaLimite && $fechaLimite->gt($hoy)) {
                    $dias = (int) $hoy->diffInDays($fechaLimite);
                    $estadoCredito = "Restan {$dias} días";
                    $colorEstado = '#16a34a'; // Verde
                } elseif ($fechaLimite && $fechaLimite->isSameDay($hoy)) {
                    $estadoCredito = 'Vence hoy';
                    $colorEstado = '#eab308'; // Amarillo
                } else {
                    $estadoCredito = 'Sin fecha';
                    $colorEstado = '#6b7280'; // Gris
                }

                




        
    @endphp

    <tr>
        <td>
            {{ $row->cliente->codigo_interno ?? '' }}
        </td>
        <td>
            {{ $row->cliente->codigo_mayorista ?? '' }}
        </td>
        <td>
            {{ $row->cliente->nombres_cliente ?? '' }}
        </td>
        <td>
            {{ $row->cliente->tipo_cliente ?? '' }}
        </td>
        <td>
            {{ $row->no_venta }}
        </td>
        <td>
            {{ \Carbon\Carbon::parse($row->fecha_venta)->format('d/m/Y') }}
        </td>
        <td>
            <div class="text-xs">

{{ $row->fecha_limite_credito
                ? \Carbon\Carbon::parse($row->fecha_limite_credito)->format('d/m/Y')
                : ''
            }}
            </div>
            
        </td>
        <td style="color: {{ $colorEstado }}; font-weight:bold;">
            {{ $estadoCredito }}
        </td>
        <td>
            {{ $row->forma_pago_venta }}
        </td>
        <td>
            Q. {{ number_format($row->total_venta, 0) }}
        </td>
        <td>
            Q. {{ number_format($row->total_credito, 0) }}
        </td>
        <td>
            Q. {{ number_format($row->total_abono, 0) }}
        </td>
        <td>
            Q. {{ number_format($row->total_nota_credito, 0) }}
        </td>
        <td>
            Q. {{ number_format($row->saldo_venta, 0) }}
        </td>

    </tr>

    @endforeach

    <tr style="font-weight:bold; background:#f2f2f2">
        <td colspan="9">
            TOTALES
        </td>
        <td>
            Q. {{ number_format($totalVenta, 0) }}
        </td>
        <td>
            Q. {{ number_format($totalCredito, 0) }}
        </td>
        <td>
            Q. {{ number_format($totalAbono, 0) }}
        </td>
        <td>
            Q. {{ number_format($totalNotaCredito, 0) }}
        </td>
        <td>
            Q. {{ number_format($totalSaldoVenta, 0) }}
        </td>
    </tr>
</tbody>
</table>
  <!-- ===================== Fin Tabla ===================== -->
</div>

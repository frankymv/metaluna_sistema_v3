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
  

@php
    $movimientos = collect();

    if ($data->credi) {
        $movimientos->push([
            'tipo' => 'credito',
            'no' => $data->no_venta,
            'correlativo' => 1,
            'fecha' => $data->fecha_venta,
            'total' => $data->total_credito,
        ]);
    }



    foreach ($data->abonos as $abono) {
        $movimientos->push([
            'tipo' => 'abono',
            'no' => $abono->no_abono,
            'correlativo' => $abono->correlativo,
            'fecha' => $abono->fecha_abono,
            'total' => $abono->total_abono,
        ]);
    }

    foreach ($data->notacreditos as $nota) {
        $movimientos->push([
            'tipo' => 'nota_credito',
            'no' => $nota->no_nota_credito,
            'correlativo' => $nota->correlativo,
            'fecha' => $nota->fecha_nota_credito,
            'total' => $nota->total_nota_credito,
        ]);
    }

    $movimientos = $movimientos->sortBy('correlativo');

    $totalVenta = $data->total_venta;
    $totalAbonos = $data->abonos->sum('total_abono');
    $totalNotas = $data->notacreditos->sum('total_nota_credito');
    $saldo = $totalVenta - $totalAbonos - $totalNotas;
@endphp


    <table style="width:100%; border-collapse:collapse; margin-bottom:15px;">
        <thead>
            <tr class="titulo-seccion">
                <th colspan="2">
                    Estado Cuenta Venta
                </th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td class="gris" style="width:30%; text-align:left;">
                    No Venta
                </td>
                <td style="text-align:left;">
                    {{ $data->no_venta }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Fecha Venta
                </td>
                <td style="text-align:left;">
                    {{ \Carbon\Carbon::parse($data->fecha_venta)->format('d/m/Y') }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Código Mayorista
                </td>
                <td style="text-align:left;">
                    {{ $data->cliente->codigo_mayorista ?? '' }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Cliente
                </td>
                <td style="text-align:left;">
                    {{ $data->cliente->nombres_cliente ?? '' }}
                </td>
            </tr>
            <tr class="titulo-seccion">
                <th colspan="2">Movimientos</th>
            </tr>
            <tr>

                <td class="gris" style="text-align:left;">
                    Movimientos
                </td>
                <td style="text-align:left; font-size:10px;">
                    @forelse($movimientos as $movimiento)

                        @if($movimiento['tipo'] == 'credito')
                            <strong>CRÉDITO</strong>
                            <strong>No:</strong> {{ $movimiento['no'] }}
                            <strong>Fecha:</strong>
                            {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}
                            <strong>Total:</strong> Q {{ number_format($movimiento['total'],2) }}
                            <br>

                        @elseif($movimiento['tipo'] == 'abono')
                            <strong>ABONO</strong>
                            <strong>No:</strong> {{ $movimiento['no'] }}
                            <strong>Fecha:</strong>
                            {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}
                            <strong>Total:</strong> Q {{ number_format($movimiento['total'],2) }}
                            <br>

                        @elseif($movimiento['tipo'] == 'nota_credito')
                            <strong>NOTA CRÉDITO</strong>
                            <strong>No:</strong> {{ $movimiento['no'] }}
                            <strong>Fecha:</strong>
                            {{ \Carbon\Carbon::parse($movimiento['fecha'])->format('d/m/Y') }}
                            <strong>Total:</strong> Q {{ number_format($movimiento['total'],2) }}
                            <br>
                        @endif

                    @empty
                        Sin movimientos
                    @endforelse
                </td>
            </tr>
            <tr class="titulo-seccion">
                <th colspan="2">Saldo:</th>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Saldos:
                </td>
                <td style="text-align:left; font-size:10px;">
                   <strong>Total Venta:</strong>  Q {{ number_format($totalVenta, 2) }}<br>
                    <strong>Total Abonos:</strong>  Q {{ number_format($totalAbonos, 2) }}<br>
                    <strong>Total Notas Crédito:</strong> Q {{ number_format($totalNotas, 2) }}<br>
                    <strong>Saldo Actual:</strong>  Q {{ number_format($saldo, 2) }}<br>
                </td>
            </tr>



<tr>
    <td class="gris" style="text-align:left;">
        Anulado
    </td>
    <td style="text-align:left;">
        {{ $data->anulado == 1 ? 'Sí' : 'No' }}
    </td>
</tr>

<tr>
    <td class="gris" style="text-align:left;">
        Cancelado
    </td>
    <td style="text-align:left;">
        {{ $data->cancelado == 1 ? 'Sí' : 'No' }}
    </td>
</tr>

        </tbody>
    </table>



  <!-- ===================== Fin Tabla ===================== -->
</div>

</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte</title>

    <style>
    @page{
            size: letter portrait;
            margin: 10mm;
        }

        *{
            margin:0;
            padding:0;
            text-indent:0;
            box-sizing:border-box;
        }

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:11px;
        }

        h1{
            font-size:20px;
            font-weight:bold;
            margin-bottom:3px;
        }

        p{
            font-size:9px;
            line-height:1.3;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        th,td{
            border:1px solid #000;
            padding:4px;
            text-align:center;
            vertical-align:middle;
            font-size:9px;
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

    <!-- ENCABEZADO -->
<div style="
        position:relative;
        width:100%;
        height:80px;
        overflow:hidden;
        background-image:url('data:image/png;base64,{{$bg_base64}}');
        background-size:cover;
        background-repeat:no-repeat;
        background-position:right center;
        margin-bottom:10px;
        ">

        <div style="
            position:absolute;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background:rgba(255,255,255,.82);
        ">
        </div>

        <div style="
            position:relative;
            padding:12px 15px;
            text-align:right;
        ">

            <h1>DISTRIBUIDORA METALUNA</h1>

            <p>9 calle, Zona 3, Totonicapán</p>

            <p>
                <strong>Pedidos:</strong>
                7766-4092 · 3023-9120 · 4642-7166 · 3059-7733
            </p>

            <p>metaluna@gmail.com</p>

        </div>

    </div>

   <table style="width:100%; border-collapse:collapse;">

        <thead>
            <tr class="titulo-seccion">
                <th colspan="2">Abono</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td class="gris" style="width:28%; text-align:left;">
                    No. Abono
                </td>
                <td style="text-align:left;">
                    {{ $data->no_abono }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Fecha del Abono
                </td>
                <td style="text-align:left;">
                    {{ \Carbon\Carbon::parse($data->fecha_abono)->format('d/m/Y') }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Cliente
                </td>
                <td style="text-align:left;">
                    {{ $data->cliente->nombre }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    No. Venta
                </td>
                <td style="text-align:left;">
                    {{ $data->venta->venta_no }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Total Abonado
                </td>
                <td style="text-align:left;">
                    Q {{ number_format($data->total_abono,2) }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Tipo de Pago
                </td>
                <td style="text-align:left;">
                    {{ $data->tipo_pago }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Detalle del Pago
                </td>
                <td style="text-align:left;">
                    {{ $data->detalle_pago ?: 'Sin detalle' }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Correlativo
                </td>
                <td style="text-align:left;">
                    {{ $data->correlativo ?: 'N/A' }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Abono Anticipado
                </td>
                <td style="text-align:left;">
                    {{ $data->abono_anticipado ? 'Sí' : 'No' }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Asignado
                </td>
                <td style="text-align:left;">
                    {{ $data->abono_anticipado_asignado ? 'Sí' : 'No' }}
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Fecha Asignación
                </td>
                <td style="text-align:left;">
                    @if($data->fecha_abono_anticipado_asignado)
                        {{ \Carbon\Carbon::parse($data->fecha_abono_anticipado_asignado)->format('d/m/Y') }}
                    @else
                        No asignado
                    @endif
                </td>
            </tr>

            <tr>
                <td class="gris" style="text-align:left;">
                    Observaciones
                </td>
                <td style="text-align:left;">
                    {{ $data->observaciones ?: 'Sin observaciones' }}
                </td>
            </tr>



        </tbody>

    </table>

</div>

</body>
</html>

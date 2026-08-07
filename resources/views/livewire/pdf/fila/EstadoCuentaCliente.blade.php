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

    <!------------------- TABLA ------------------->
<table style="width:100%; border-collapse:collapse;">

    <thead>
        <tr class="titulo-seccion">
            <th colspan="2">Estado Cuenta Cliente</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td class="gris" style="width:28%; text-align:left;">
                Código Interno
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->codigo_interno }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Código Mayorista
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->codigo_mayorista ?: 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Tipo de Cliente
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->tipo_cliente }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Empresa
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->nombre_empresa ?: 'No aplica' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Nombre Completo
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->nombres_cliente }} {{ $data->cliente?->apellidos_cliente }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Teléfono Principal
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->telefono_principal }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Dirección
            </td>
            <td style="text-align:left;">
                {{ $data->cliente?->direccion_fisica }}
            </td>
        </tr>

        <tr class="titulo-seccion">
            <th colspan="2">Venta</th>
        </tr>
        <tr>
            <td class="gris" style="text-align:left;">
                No_venta
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
                {{ $data->fecha_venta }} días
            </td>
        </tr>
        <tr>
        <td class="gris" style="text-align:left;">
                Fecha Limite Credito
            </td>
            <td style="text-align:left;">
                {{ $data->fecha_limite_credito }} días
            </td>
        </tr>
        <tr>
            <td class="gris" style="text-align:left;">
                Vencimiento
            </td>

         

            @php
                $fechaLimite = $data->fecha_limite_credito
                    ? \Carbon\Carbon::parse($data->fecha_limite_credito)
                    : null;

                $hoy = \Carbon\Carbon::today();

                if ($data->saldo_venta <= 0) {
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
            <td
                style="
                text-align:left;
                    color: {{ $colorEstado }};
                    font-weight:bold;
                "
            >
                {{ $estadoCredito }}
          
        </tr>
        <tr>
            <td class="gris" style="text-align:left;">
                Forma de pago
            </td>
            <td style="text-align:left;">
                {{ $data->forma_pago_venta }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Total Venta
            </td>
            <td style="text-align:left;">
                Q. {{ $data->total_venta }}
            </td>
        </tr>
        
        <tr>
            <td class="gris" style="text-align:left;">
                Total Credito
            </td>
            <td style="text-align:left;">
                Q. {{ $data->total_credito }}
            </td>
        </tr>
        <tr>
            <td class="gris" style="text-align:left;">
                Total Abono
            </td>
            <td style="text-align:left;">
                Q. {{ $data->total_abono }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Total Nota Credito
            </td>
            <td style="text-align:left;">
                Q. {{ $data->total_nota_credito }} 
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Saldo Actual
            </td>
            <td style="text-align:left;">
                Q. {{ $data->saldo_venta }}
            </td>
        </tr>


      


    </tbody>

</table>

</div>

</body>
</html>

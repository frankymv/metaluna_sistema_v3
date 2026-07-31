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
            <th colspan="2">Envío</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td class="gris" style="width:28%; text-align:left;">
                No. Envío
            </td>
            <td style="text-align:left;">
                {{ $data->envio_no }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Fecha de Envío
            </td>
            <td style="text-align:left;">
                {{ \Carbon\Carbon::parse($data->envio_fecha)->format('d/m/Y H:i') }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Ruta
            </td>
            <td style="text-align:left;">
                {{ $data->ruta->nombre }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Proceso
            </td>
            <td style="text-align:left;">
                {{ $data->proceso_nombre }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Estado del Envío
            </td>
            <td style="text-align:left;">
                {{ $data->estado_envio }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Estado Actual
            </td>
            <td style="text-align:left;">
                {{ $data->estado_nombre }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Fecha Estado
            </td>
            <td style="text-align:left;">
                {{ \Carbon\Carbon::parse($data->estado_fecha)->format('d/m/Y H:i') }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Observación Estado
            </td>
            <td style="text-align:left;">
                {{ $data->estado_observacion ?: 'Sin observaciones' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Usuario Registro
            </td>
            <td style="text-align:left;">
                {{ $data->user_name_created_at }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Observaciones Inicio
            </td>
            <td style="text-align:left;">
                {{ $data->observaciones_inicio_envio ?: 'Sin observaciones' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Observaciones Final
            </td>
            <td style="text-align:left;">
                {{ $data->observaciones_fin_envio ?: 'Sin observaciones' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Visible
            </td>
            <td style="text-align:left;">
                {{ $data->visible ? 'Sí' : 'No' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Finalizado
            </td>
            <td style="text-align:left;">
                {{ $data->finalizado ? 'Sí' : 'No' }}
            </td>
        </tr>


    </tbody>

</table>

</div>

</body>
</html>

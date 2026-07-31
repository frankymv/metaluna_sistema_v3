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
            <th colspan="2">Cliente</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td class="gris" style="width:28%; text-align:left;">
                Código Interno
            </td>
            <td style="text-align:left;">
                {{ $data->codigo_interno }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Código Mayorista
            </td>
            <td style="text-align:left;">
                {{ $data->codigo_mayorista ?: 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Tipo de Cliente
            </td>
            <td style="text-align:left;">
                {{ $data->tipo_cliente }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Empresa
            </td>
            <td style="text-align:left;">
                {{ $data->nombre_empresa ?: 'No aplica' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Nombre Completo
            </td>
            <td style="text-align:left;">
                {{ $data->nombres_cliente }} {{ $data->apellidos_cliente }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                CUI
            </td>
            <td style="text-align:left;">
                {{ $data->cui ?: 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                NIT
            </td>
            <td style="text-align:left;">
                {{ $data->nit ?: 'CF' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Número de Patente
            </td>
            <td style="text-align:left;">
                {{ $data->numero_patente ?: 'No aplica' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Teléfono Principal
            </td>
            <td style="text-align:left;">
                {{ $data->telefono_principal }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Teléfono Secundario
            </td>
            <td style="text-align:left;">
                {{ $data->telefono_secundario ?: 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Correo Electrónico
            </td>
            <td style="text-align:left;">
                {{ $data->correo_electronico ?: 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Dirección
            </td>
            <td style="text-align:left;">
                {{ $data->direccion_fisica }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Municipio
            </td>
            <td style="text-align:left;">
                {{ $data->direccion_municipio }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Departamento
            </td>
            <td style="text-align:left;">
                {{ $data->direccion_departamento }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Ubicación GPS
            </td>
            <td style="text-align:left;">
                Lat: {{ $data->ubicacion_latitud ?? 'N/A' }}
                &nbsp;&nbsp;
                Long: {{ $data->ubicacion_longitud ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Límite de Crédito
            </td>
            <td style="text-align:left;">
                Q {{ number_format($data->limite_credito,2) }}
            </td>
        </tr>

        <tr>
            <td class="gris" style="text-align:left;">
                Días de Crédito
            </td>
            <td style="text-align:left;">
                {{ $data->dias_limite_credito }} días
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
                Estado
            </td>
            <td style="text-align:left;">
                {{ $data->estado ? 'Activo' : 'Inactivo' }}
            </td>
        </tr>



    </tbody>

</table>

</div>

</body>
</html>

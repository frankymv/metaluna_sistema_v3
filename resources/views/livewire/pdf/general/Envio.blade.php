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
    <table>
        <thead>
            <tr class="titulo-seccion">
                <td>No Envio</td>
                <td>Fecha Envio</td>
                <td>Estado Envio</td>
                <td>Ruta Codigo</td>
                <td>Ventas</td>
                <td>Usuarios</td>
                <td>Vehiculos</td>
            </tr>
        </thead>
        <!-- ===================== Contenido Tabla ===================== -->
        <tbody>
            @foreach ($data as $data)
            <tr>
                <td>{{$data->envio_no}}</td>
                <td>{{$data->envio_fecha}}</td>
                <td>{{$data->estado_envio}}</td>
                <td>
                    <p>No Ruta: {{$data->ruta->id}} </p>
                    <p>Nombre Ruta: {{$data->ruta->nombre}} </p>
                        @foreach ($data->ruta->departamentos as $key=>$dataa)
                        <p>DEPARTAMENTO:{{$dataa->nombre}}</p>
                        <p>MUNICIPIO:{{$data->ruta->municipios[$key]['nombre']}}</p>
                        <p>Observacion:{{$data->ruta->municipios[$key]['pivot']->observaciones}}</p>
                        @endforeach

                </td>
                <td>
                    @foreach ($data->ventas as $data_a)
                    <p>{{$data_a->no_venta}}: {{$data_a->fecha_venta}}</p>
                    @endforeach
                </td>

                <td>
                    @foreach ($data->users as $data_a)
                    <p>{{$data_a->codigo}}: {{$data_a->nombres}} {{$data_a->apellidos}}</p>
                    @endforeach
                </td>
                <td>
                    @foreach ($data->vehiculos as $data_a)
                    <p>{{$data_a->codigo}}: {{$data_a->alias}}</p>
                    @endforeach
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  <!-- ===================== Fin Tabla ===================== -->
</div>

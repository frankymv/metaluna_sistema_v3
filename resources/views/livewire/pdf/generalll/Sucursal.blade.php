<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>REPORTE DE SUCURSAL</title>
<meta name="author" content="Franky Emmanuel Mejía Vicente"/>
<style type="text/css">
  * { margin:0; padding:0; text-indent:0; }
  body { font-family:"Times New Roman", serif; color:#000; }

  /* Tipografías como el segundo HTML */
  .s1 { font-weight: bold;   font-size: 11pt; } /* títulos/encabezados */
  .s2 { font-weight: normal; font-size: 8pt;  } /* línea auxiliar (Usuario, paginación) */
  .s3 { font-weight: normal; font-size: 11pt; } /* contenido normal */

  /* Bordes y tablas */
  table, tbody { vertical-align: top; overflow: visible; }
  table { border-collapse: collapse; width: 100%; }
  .b1 { border: 1pt solid #000; }
  .thead { background-color: #FB923C; }

  /* Utilidades */
  .pt1 { padding: 1pt; }
  .pt2 { padding: 2pt; }
  .pt4 { padding: 4pt; }
  .pt5 { padding: 5pt; }
  .mt4 { margin-top: 4pt; }
  .mt6 { margin-top: 6pt; }
  .mt8 { margin-top: 8pt; }
  .ta-left  { text-align: left; }
  .ta-right { text-align: right; }
  .ta-center{ text-align: center; }

  /* Anchos sugeridos */
  .w-15 { width: 15%; }
  .w-20 { width: 20%; }
  .w-25 { width: 25%; }
  .w-30 { width: 30%; }
  .w-35 { width: 35%; }
  .w-50 { width: 50%; }
  .w-67 { width: 67pt; } /* compatible con tu HTML original si lo prefieres en puntos */

  /* Evita cortes feos en impresión */
  @media print {
    thead { display: table-header-group; }
    tr, td, th { page-break-inside: avoid; }
  }
</style>
</head>
<body>

@php
  $bg_base64   = base64_encode(file_get_contents(public_path('assets/imagenes/encabezado_pdf.png')));
@endphp

<div style="margin: 10px;">

    <!-- ============ BLOQUE 1: ENCABEZADO ============ -->
    <div style="
    font-family: Arial, sans-serif;
    color:#1a1a1a;
    position: relative;
    width: %;
    min-height: 50px;
    border: 0px solid #000;
    box-sizing: border-box;
    overflow: hidden;
    background-image: url('data:image/png;base64,{{$bg_base64 ?? ''}}'); /* Pega aquí tu Base64 si no usarás la variable */
    background-size: 770 55;
    background-position: right center;
    background-repeat: no-repeat;
    margin-bottom: 2px;
    ">
    <!-- Capa para mejorar contraste del texto sobre el fondo -->
    <div style="
        position:absolute; inset:0;
        background: linear-gradient(90deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.90) 45%, rgba(255,255,255,0.25) 100%);
        pointer-events:none;
    "></div>

    <!-- Contenido del encabezado -->
    <div style="
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 16px 4px;
        box-sizing: border-box;
    ">


        <!-- INFORMACIÓN ALINEADA A LA DERECHA -->
        <div style="flex: 1 1 auto; text-align: right;">
        <h1 style="margin:0; font-size: 18px; letter-spacing: 1px; color:#000000;">
            DISTRIBUIDORA METALUNA
        </h1>

        <p style="margin:0 0 0 0; font-size: 10px;">
            9 calle, Zona 3, Totonicapán |           <strong>Pedidos a Oficina:</strong>
            Cel: 7766-4092 · 3023-9120 · 4642-7166 · 3059-7733
        </p>


        <p style="margin:0 0 0 0; font-size: 10px;">
            <span style="color:#333;">Correo Electrónico:</span>
            <a href="mailto:metaluna@gmail.com" style="color:#1a1a1a; text-decoration:none;">metaluna@gmail.com</a>
        </p>

        <p style="margin:0 0 0 0; font-size: 10px; color:#555;">
            Usuario: {{$usuario ?? 'Franky Mejia'}} &nbsp;&nbsp;|&nbsp;&nbsp;
            Fecha Impresión: {{$fecha_impresion ?? '01/01/2024 12:00 am'}}
        </p>
        </div>
    </div>
</div>



  <!-- ======= TÍTULO ======= -->
  <table cellspacing="0">
    <tr>
      <td class="pt1">
        <p class="s1 ta-center">REPORTE DE SUCURSAL</p>
      </td>
    </tr>
  </table>

  <!-- ======= LÍNEA AUXILIAR (Usuario / Paginación) =======
  <table cellspacing="0" class="mt4">
    <tr>
      <td class="pt1">
        <p class="s2 ta-left">Usuario: {{$usuario ?? 'Franky Mejia'}}</p>
      </td>
      <td class="pt1">
        <p class="s2 ta-right">Página {{$pagina_actual ?? 1}} de {{$paginas_totales ?? 1}}</p>
      </td>
    </tr>
  </table>-->



  <!-- ======= TABLA DE SUCURSALES ======= -->
  <table cellspacing="0">
    <thead>
      <tr class="thead">
        <th class="b1 pt2 ta-center s1">Id</th>
        <th class="b1 pt2 ta-center s1">Nombre</th>
        <th class="b1 pt2 ta-center s1">Descripción</th>
        <th class="b1 pt2 ta-center s1">Estado</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $data)
      <tr>
        <td class="b1 pt2 ta-left s3">{{$data->id}}</td>
        <td class="b1 pt2 ta-left s3">{{$data->nombre}}</td>
        <td class="b1 pt2 ta-left s3">{{$data->descripcion}}</td>
        <td class="b1 pt2 ta-left s3">{{$data->estado}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>

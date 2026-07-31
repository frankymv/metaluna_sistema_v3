<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>fd251001-618d-469f-952a-1511aa2990df</title>
<meta name="author" content="Franky Emmanuel Mejía Vicente"/>
<style type="text/css"> * {margin:0; padding:0; text-indent:0; }
 h1 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 16pt; }
 p { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 9pt; margin:0pt; }
 a { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: underline; font-size: 9pt; }
 .s1 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 7pt; }
 .s2 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; }
 .s3 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; }
 .s4 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt; }
 .s5 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 11pt; }
 .s6 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 10pt; }
 table, tbody {vertical-align: top; overflow: visible; }


</style>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #000;
        padding: 4px;
    }
    .titulo-seccion {
        background-color: #e86e3d;
        color: white;
        font-weight: bold;
        text-align: center;
    }
    .gris {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    .salmon {
        background-color: #f7d7cc;
    }
</style>

</head>
<body>

@php
  $bg_base64   = base64_encode(file_get_contents(public_path('assets/imagenes/encabezado.png')));
@endphp


<div style="margin: 9px;">
    <!-- ============ BLOQUE 1: ENCABEZADO ============ -->
    <div style="
    font-family: Arial, sans-serif;
    color:#1a1a1a;
    position: relative;
    width: %;
    min-height: 140px;
    border: 0px solid #000;
    box-sizing: border-box;
    overflow: hidden;
    background-image: url('data:image/png;base64,{{$bg_base64 ?? ''}}'); /* Pega aquí tu Base64 si no usarás la variable */
    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
    margin-bottom: 14px;
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
        padding: 16px 20px;
        box-sizing: border-box;
    ">


        <!-- INFORMACIÓN ALINEADA A LA DERECHA -->
        <div style="flex: 1 1 auto; text-align: right;">
        <h1 style="margin:0; font-size: 24px; letter-spacing: 1px; color:#000000;">
            DISTRIBUIDORA METALUNA
        </h1>

        <p style="margin: 2px 0 0 0; font-size: 9px;">
            9 calle, Zona 3, Totonicapán
        </p>

        <p style="margin: 2px 0 0 0; font-size: 9px; line-height: 1.4;">
            <strong>Pedidos a Oficina:</strong>
            Cel: 7766-4092 · 3023-9120 · 4642-7166 · 3059-7733
        </p>

        <p style="margin: 2px 0 0 0; font-size: 9px;">
            <span style="color:#333;">Correo Electrónico:</span>
            <a href="mailto:metaluna@gmail.com" style="color:#1a1a1a; text-decoration:none;">metaluna@gmail.com</a>
        </p>


        </div>
    </div>
</div>





    <p style="text-indent: 0pt;text-align: left;">
    <br/>
    </p>




<!-- ENCABEZADO -->
<table>
    <tr>
        <th colspan="6" style="background-color:#e86e3d;  color:white; font-size: 11px;">ENTREGA:</th>
    </tr>
   <tr>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Vendedor:</td>
        <td style="font-size: 9px;">Pedro Gómez</td>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Fecha Cotización:</td>
        <td style="font-size: 9px;">{{$venta['fecha_venta']}}</td>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">No. Venta:</td>
        <td style="font-size: 9px;">{{$venta['no_venta']}}</td>
    </tr>

    <tr>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Tipo Pago:</td>
        <td style="font-size: 9px;">{{$venta['forma_pago_venta']}}</td>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Envío:</td>
        <td style="font-size: 9px;">{{$venta['no_venta']}}</td>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Página:</td>
        <td style="font-size: 9px;">1 de 1</td>
    </tr>




    <tr>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Código:</td>
        <td style="font-size: 9px;">{{$cliente['codigo_mayorista']}}</td>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Teléfono:</td>
        <td style="font-size: 9px;">{{$cliente['telefono_principal']}}</td>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Correo Electronico:</td>
        <td style="font-size: 9px;">    {{$cliente['correo_electronico']}}</td>
    </tr>

    <tr>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Empresa:</td>
        <td style="font-size: 9px;" colspan="5">{{$cliente['nombre_empresa']}}</td>
    </tr>

    <tr>
        <td  style=" background-color: #f7d7cc; font-size: 9px;">Dirección:</td>
        <td style="font-size: 9px;" colspan="5">{{$cliente['direccion_fisica']}}</td>
    </tr>
</table>
<br>
    <!-------------------------------------------------------------------------------------------------detalle venta------------------------------------------------------------->
<!-- DETALLE COTIZACIÓN -->
<table>
    <tr>
        <th colspan="5" class="titulo-seccion" style="font-size: 11px;">DETALLE COTIZACIÓN</th>
    </tr>
    <tr class="gris">
        <th style="font-size: 9px;" width="5%">Código</th>
        <th style="font-size: 9px;" width="5%">Cant.</th>
        <th style="font-size: 9px;" width="70%">Descripción</th>
        <th style="font-size: 9px;" width="10%">Precio</th>
        <th style="font-size: 9px;" width="10%">Subtotal</th>
    </tr>
    @foreach ($venta['productos'] as $data)
    <tr>
        <td style="font-size: 9px;" width="5%">{{$data['codigo']}}</td>
        <td style="font-size: 9px;" width="5%">{{$data['producto_venta']['cantidad']}}</td>
        <td style="font-size: 9px;" width="70%"> {{$data['nombre_venta']}}</td>
        <td style="font-size: 9px;" width="10%">Q. {{$data['producto_venta']['precio_venta']}}</td>
        <td style="font-size: 9px;" width="10%">Q. {{$data['producto_venta']['sub_total']}}</td>
    </tr>
    @endforeach

    <!-- FILA SALMÓN (como en tu imagen) -->
    <tr>
        <td colspan="4"   style="background-color:#f7d7cc ; text-align:right; font-weight:bold; font-size: 9px;">TOTAL:</td>
        <td style="font-size: 9px;">Q. {{$venta['total_venta']}}</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="6"   style="background-color:#f7d7cc ; text-align:right; font-weight:bold; font-size: 9px;">Nuevo Credito:</td>
        <td style="font-size: 9px;">Q. {{$venta['total_venta']}}</td>
    </tr>
    <tr>
        <td colspan="6"   style="background-color:#f7d7cc ; text-align:right; font-weight:bold; font-size: 9px; ">Saldo Anterior Credito:</td>
        <td style="font-size: 9px; border-bottom: 3px solid black; text-align:">+ Q. {{$venta['saldo_anterior_v']}}</td>
    </tr>
    <tr>
        <td colspan="6"   style="background-color:#f7d7cc ; text-align:right; font-weight:bold; font-size: 9px;">Saldo Nuevo Credito:</td>
        <td style="font-size: 9px;">Q. {{$venta['total_venta']+$venta['saldo_anterior_v']}}</td>
    </tr>
        <tr>
        <td colspan="6"   style="background-color:#f7d7cc ; text-align:right; font-weight:bold; font-size: 9px;">Abono Anticipo:</td>
        <td style="font-size: 9px; border-bottom: 3px solid black; text-align:">- Q. {{$venta['anticipo_v']}}</td>
    </tr>

    <tr>
        <td colspan="6"   style="background-color:#f7d7cc ; text-align:right; font-weight:bold; font-size: 9px;">Total :</td>
        <td style="font-size: 9px; text-align:">{{($venta['total_venta']+$venta['saldo_anterior_v'])-$venta['anticipo_v']}}</td>
    </tr>
</table>
<br>
<!-- ENTREGA -->
<table>
    <tr>
        <th width="20%" style="background-color:#e86e3d; font-size: 11px;color:white;">ENTREGA:</th>
        <td width="20%" style="font-size: 9px;">Fecha entrega:</td>
        <td width="30%" style="font-size: 9px;">Nombre recibe:</td>
        <td width="30%" style="font-size: 9px;">Firma:</td>
    </tr>
    <tr>
        <td colspan="4" style="font-size: 9px;">Nota:</td>
    </tr>
</table>
</div>
</body>
</html>

<?php
/** frk */
namespace App\Constantes;

class ModulosSistema
{

public static $modulosInicio = [
    ['role'=>'invitado','route'=>'inicio','name'=>'Inicio','name_permission'=>'inicio','permission'=>['create','read','update','delete','show']],
];

public static $modulosAdministracion = [
    ['role'=>'','route'=>'rol','name'=>'Rol','name_permission'=>'rol','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'usuario','name'=>'Usuario','name_permission'=>'usuario','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'sucursal','name'=>'sucursal','name_permission'=>'sucursal','permission'=>['create','read','update','delete','show']],

];


public static $modulosInventario = [
    ['role'=>'','route'=>'inventario','name'=>'inventario','name_permission'=>'inventario','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'producto','name'=>'Producto','name_permission'=>'producto','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'color','name'=>'Color','name_permission'=>'color','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'marca','name'=>'Marca','name_permission'=>'marca','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'categoria','name'=>'Categoria','name_permission'=>'categoria','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'tipo','name'=>'Tipo','name_permission'=>'tipo','permission'=>['create','read','update','delete','show']],
];

public static $modulosCompra = [
   ['role'=>'','route'=>'compra','name'=>'compra','name_permission'=>'compra','permission'=>['create','read','update','delete','show']],
   ['role'=>'','route'=>'precio_producto','name'=>'precio_producto','name_permission'=>'precio_producto','permission'=>['create','read','update','delete','show']],
   ['role'=>'','route'=>'proveedor','name'=>'Proveedor','name_permission'=>'proveedor','permission'=>['create','read','update','delete','show']],
];


public static $modulosVenta = [
    ['role'=>'','route'=>'venta','name'=>'venta','name_permission'=>'venta','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'venta_historial','name'=>'venta_historial','name_permission'=>'venta_historial','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'cliente','name'=>'cliente','name_permission'=>'cliente','permission'=>['create','read','update','delete','show']],
];

public static $modulosContabilidad = [
    ['role'=>'','route'=>'venta_cobrar','name'=>'venta_cobrar','name_permission'=>'venta_cobrar','permission'=>['create','read','update','delete','show']],
    ['role'=>'','route'=>'compra_pagar','name'=>'compra_pagar','name_permission'=>'compra_pagar','permission'=>['create','read','update','delete','show']],
];


public static $permission =
    ['crear','leer','editar','borrar','reporte'];
}

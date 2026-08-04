<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteInventario extends Model
{
    use HasFactory;
    const INGRESO = '0';
    const EGRESO = '1';

    protected $fillable = ['fecha_ajuste_inventario','ajuste_inventario_no','sucursal_id','producto_id','tipo_ajuste','descripcion','cantidad_traslado'];


    public function Producto(){
       // return $this->hasMany(Producto::class ,'productos_id', 'id');

        //return $this->hasMany(Producto::class );
        return $this->belongsTo(Producto::class );
    }

    public function Sucursal(){
        // return $this->hasMany(Producto::class ,'productos_id', 'id');

         return $this->belongsTo(Sucursal::class );
     }

       public static function siguienteNoRegistro(): int {
        $numero = self::max('id');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'nombre_venta',
        'descripcion',
        'calibre',
        'longitud',
        'tipo_longitud',
        'diametro',
        'tipo_diametro',
        'peso',
        'tipo_peso',
        'divisible',
        'existencia',
        'precio_venta',
        'estado',
        'marca_id',
        'tipo_id',
        'material_id',
        'precio_unitario',
        'precio_final',
        'disenio_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        //Para que siempre tenga 2 decimales cuando recuperes el valor:
        'precio_unitario' => 'decimal:2',
        'precio_final' => 'decimal:2',
    ];

    public function Marca(){
        return $this->belongsTo(Marca::class);
    }

    public function Tipo(){
        return $this->belongsTo(Tipo::class);
    }

    public function Material(){
        return $this->belongsTo(Material::class);
    }


    public function Disenio(){
        return $this->belongsTo(Disenio::class);
    }

    public function Inventario(){
        return $this->belongsTo(Inventario::class);
    }

    public function AjusteInventarios(){
        return $this->hasMany(AjusteInventario::class);
    }

    public function Compras(){
        return $this->belongsToMany(Compra::class)
        ->withTimestamps()
        ->withPivot('cantidad','producto_id');
    }

    public function Ventas(){
        return $this->belongsToMany(Venta::class)
        ->as('producto_final')
        ->withTimestamps()
        ->withPivot('cantidad','subtotal','precio_final');

    }

    public function Cotizaciones(){
        return $this->belongsToMany(Cotizacion::class)
        ->as('cotizacion_producto')
        ->withTimestamps()
        ->withPivot('cantidad','sub_total','precio_cotizacion');
    }
    /*
    public function Sucursals(){
        return $this->belongsToMany(Sucursal::class)
        ->as('producto_sucursal')
        ->withPivot('cantidad')
        ->using(ProductoSucursal::class);
    }
    */

    public function Sucursales(){
        return $this->belongsToMany(Sucursal::class)
        ->withPivot('cantidad');
    }

    public function Traslados(){
        return $this->belongsToMany(Traslado::class)
        ->withTimestamps()
        ->withPivot('cantidad','producto_id');
    }


    //mutadadores

    //nombre del atributo
    protected function Estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==true ? 'Activo':'Inactivo',
            set: fn (string $value) => $value=='Activo'? true:false,
        );
    }
    protected function divisible(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==='1' ? true:false,
            //  set: fn (string $value) => $value==='Activo'? true:false,
        );
    }

        public static function siguienteNoRegistro(): int {
        $numero = self::max('id');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'direccion_fisica',
        'departamento_id',
        'municipio_id',
        'telefono_principal',
        'telefono_secundario',
        'correo_electronico',
        'bodega',
        'visible',
        'estado'];

    public function Users(){
        return $this->hasMany(User::class);
    }
/*
    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->as('producto_sucursal')
        ->withPivot('cantidad')
        ->using(ProductoSucursal::class);
    }

    */

    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->withPivot('cantidad');
    }

    public function Inventario(){
        return $this->belongsTo(Inventario::class);
    }
      public function Departamento(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Departamento::class);
     }

     public function Municipio(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Municipio::class);
     }

    protected function Estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==true ? 'Activo':'Inactivo',
            set: fn (string $value) => $value=='Activo'? true:false,
        );
    }
    protected function visible(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==='1' ? true:false,
            //  set: fn (string $value) => $value==='Activo'? true:false,

        );
    }
    protected function bodega(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==='1' ? true:false,
            //  set: fn (string $value) => $value==='Activo'? true:false,
        );
    }

    public function AjusteInventarios(){
        return $this->hasMany(AjusteInventario::class);
    }


    public function Traslados(){
        return $this->hasMany(Traslado::class);
    }

        public static function siguienteNoRegistro(): int {
        $numero = self::max('id');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion','nit', 'nombre_representante','telefono_principal','telefono_secundario','direccion_fisica',    'direccion_departamento','direccion_municipio','correo_electronico','estado'];


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
}

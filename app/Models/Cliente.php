<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'codigo_interno',
    'codigo_mayorista',
    'nombre_empresa',
    'nombres_cliente',
    'apellidos_cliente',
    'cui',
    'numero_patente',
    'nit',
    'telefono_principal',
    'telefono_secundario',
    'direccion_fisica',
    'direccion_departamento',
    'direccion_municipio',
    'ubicacion_latitud',
    'ubicacion_longitud',
    'correo_electronico',
    'limite_credito',
    'dias_limite_credito',
    'tipo_cliente',
    'ruta_id',
    'estado'];




    public function Departamento(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Departamento::class);
     }

     public function Municipio(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Municipio::class);
     }

     public function Ruta(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Ruta::class);
     }
     public function Abonos(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Abono::class);
    }

     public function Ventas(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Venta::class);
     }

    protected function Estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==true ? 'Activo':'Inactivo',
            set: fn (string $value) => $value=='Activo'? true:false,
        );
    }

    public function EstadoCuenta(){
        return $this->belongsTo(EstadoCuenta::class);
    }

    public function Credito(){
        return $this->belongsTo(Credito::class);
    }

    public static function siguienteCodigoMayorista(): int {
        $numero = self::max('codigo_mayorista');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }

    public static function siguienteCodigoInterno(): int {
        $numero = self::max('codigo_interno');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }

}

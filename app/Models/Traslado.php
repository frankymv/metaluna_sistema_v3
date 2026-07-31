<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;

    protected $fillable=['traslado_no',
    'traslado_fecha',
    'producto_id',
    'sucursal_origen_id',
    'sucursal_destino_id',
    'cantidad',
    'estado',

    ];


    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->withTimestamps()
        ->withPivot('cantidad','producto_id');
    }

    public function SucursalOrigen(){
        return $this->belongsTo(Sucursal::class,'sucursal_origen_id');

    }

    public function SucursalDestino(){
        return $this->belongsTo(Sucursal::class,'sucursal_destino_id');

    }

    protected function Estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==true ? 'Activo':'Inactivo',
            set: fn (string $value) => $value=='Activo'? true:false,
        );
    }

}

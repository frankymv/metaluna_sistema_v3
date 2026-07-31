<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;



    protected $fillable = [
        'no_servicio',
        'fecha_servicio',
        'total_servicio',
        'vehiculo_id',
        'descripcion',
        'observaciones',
        'estado',
    ];


    public function Vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    protected function Estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==true ? 'Activo':'Inactivo',
            set: fn (string $value) => $value=='Activo'? true:false,
        );
    }
}




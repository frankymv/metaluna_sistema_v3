<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
        use HasFactory;

    protected $fillable = ['no_movimiento','fecha_movimiento','venta_id','total_movimiento','observaciones','cliente_id','tipo_movimiento','tipo_pago'];

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function Venta(){
        return $this->belongsTo(Venta::class);
    }
}

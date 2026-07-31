<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCuenta extends Model
{
    protected $fillable =['cliente_id','total_abono','total_credito','dias_limite_credito','observaciones'];
    use HasFactory;


    public function Venta(){
        return $this->belongsTo(Venta::class);
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCredito extends Model
{
    protected $fillable =['no_nota_credito','venta_id','cliente_id','fecha_nota_credito','total_nota_credito','anulacion_venta','observaciones','correlativo','anulacion_venta'];

    use HasFactory;


    public function Venta(){
        return $this->belongsTo(Venta::class);
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public static function siguienteNoRegistro(): int {
        $numero = self::max('id');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }
}

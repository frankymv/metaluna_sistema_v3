<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;
    protected $fillable =[
        'no_abono',
        'fecha_abono',
        'total_abono',
        'observaciones',
        'abono_anticipado',
        'abono_anticipado_asignado',
        'fecha_abono_anticipado_asignado',
        'tipo_pago',
        'detalle_pago',
        'correlativo',
        'venta_id',
        'cliente_id',
        ];


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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_venta',
        'fecha_venta',
        'total_venta',
        'observaciones_venta',
        'forma_pago_venta',
        /////cancelado el total de la venta///////////
        'cancelado_total_venta',
        'fecha_cancelado_total_venta',
        /////credito///////////
        'credi',
        'total_credito',
        'fecha_limite_credito',
        'fecha_cancelado_credito',
        'observaciones_credito',
        'saldo_venta',
        /////anulado///////////
        'anulado',
        'fecha_anulado',
        /////notacredito///////////
        'nota_credito',
        'total_nota_credito',
                'correlativo_nota_credito',
        /////abono///////////
        'abono',
        'total_abono',
        'correlativo_abono',
        /////si requiere envio o traslado a la ubicacion del cliente
        'envio',
        'estado_envio',
        //registro de operaciones a una venta
        'correlativo',
        ////visible ante los registros y operaciones
        'visible',
        //////CLIENTE////////
        'cliente_id',
        'sucursal_id',
        'anticipo_id',
        'anticipo_v',
        'nuevo_saldo_v',
        'saldo_anterior_v'
    ];

    protected $casts = [
        //Para que siempre tenga 2 decimales cuando recuperes el valor:
        'total_venta'  => 'decimal:2',
        'total_credito'  => 'decimal:2',
        'total_nota_credito'  => 'decimal:2',
        'total_abono'  => 'decimal:2',
        'saldo_venta'  => 'decimal:2',
        'anticipo_v'  => 'decimal:2',
        'nuevo_saldo_v'  => 'decimal:2',
        'saldo_anterior_v'  => 'decimal:2',
    ];

    public function Abonos(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Abono::class);
    }

     public function NotaCreditos(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(NotaCredito::class);
    }

    public function EstadoCuentas(){
        return $this->hasMany(EstadoCuenta::class);
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->as('producto_venta')
        ->withTimestamps()
        ->withPivot('cantidad','sub_total','precio_venta');
    }

    public function Asignacion(){
        return $this->belongsToMany(Asignacion::class);
    }

    public function Envios(){
        return $this->belongsToMany(Envio::class)
        ->withTimestamps()
        ->withPivot('entregado','observaciones');
    }

    public function Credito(){
        return $this->hasOne(Credito::class);
    }

    public function Rutas(){
        return $this->hasMany(Ruta::class);
    }

    public function Departamentos(){
        return $this->belongsToMany(Departamento::class)
        ->withPivot('observaciones');
    }

    public static function siguienteNoRegistro(): int {
        $numero = self::max('id');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($numero === null || $numero === 0) ? 1 : (int) $numero + 1;
    }

    public static function siguienteCorrelativoWhere(string $columna, int $valor): int
    {
        // Filtra por el registro específico (por ejemplo, cliente_id = 5)
        $ultimo = self::where($columna, $valor)->max('correlativo');
        
        return ($ultimo === null || $ultimo === 0) ? 1 : (int) $ultimo + 1;
    }
}

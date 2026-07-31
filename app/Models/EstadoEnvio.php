<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEnvio extends Model
{
    protected $fillable = [
        'envio_id',
        'proceso_id',
        'proceso_nombre',
        'estado_id',
        'estado_nombre',
        'estado_observacion',
        'user_id_created_at',
        'user_name_created_at'
    ];

    use HasFactory;

    public function Envio(){
        return $this->belongsTo(Envio::class);
    }


}

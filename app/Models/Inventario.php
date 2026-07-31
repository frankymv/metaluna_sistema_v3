<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'sucursal_id', 'cantidad'];

    public function Productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function Sucursals(){
        return $this->belongsToMany(Sucursal::class);
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $fillable = ['no_orden','fecha','estado','ruta_id'];


    public function Ventas(){
        return $this->belongsToMany(Venta::class);
    }

    public function Users(){
        return $this->belongsToMany(User::class);
    }

    public function Ruta(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Ruta::class);
     }


     public function Vehiculos(){
        // $this->belongsTo('App\Models\Rol');
        return $this->belongsToMany(Vehiculo::class);
     }



}

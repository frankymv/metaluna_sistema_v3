<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{

    protected $fillable =[
        'no_combustible',
        'vehiculo_id',
        'user_id',
        'fecha_combustible',
        'total_combustible',
        'observaciones'];

    use HasFactory;


    public function Venta(){
        return $this->belongsTo(Venta::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }



}

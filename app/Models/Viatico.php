<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viatico extends Model
{

    protected $fillable =[
        'no_viatico',
        'user_id',
        'fecha_viatico',
        'total_viatico',
        'observaciones'];

    use HasFactory;


    public function Venta(){
        return $this->belongsTo(Venta::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }


}

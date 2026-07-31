<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','estado'];

    public function Productos(){
        return $this->hasMany(Producto::class);
    }

    protected function Estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==true ? 'Activo':'Inactivo',
            set: fn (string $value) => $value=='Activo'? true:false,
        );
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disenio extends Model
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


    public static function numeroRegistro(): int {
        $ultimo = self::max('id');
        // Si no hay registros (null) o el último es 0, asigna 1. Si no, suma 1.
        return ($ultimo === null || $ultimo === 0) ? 1 : (int) $ultimo + 1;
    }




    }

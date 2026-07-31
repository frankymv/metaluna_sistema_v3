<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductoSucursal extends Pivot
{
    //
    protected $fillable = ['cantidad','sucursal_id','producto_id'];

}

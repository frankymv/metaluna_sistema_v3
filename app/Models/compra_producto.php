<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra_producto extends Model
{

    protected $fillable = ['cantidad'];
    use HasFactory;
}

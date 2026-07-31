<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['id','opcion_estado','observacion','user_id','user_name'];
    use HasFactory;


}

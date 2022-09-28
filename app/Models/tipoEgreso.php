<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoEgreso extends Model
{
    use HasFactory; 
    protected $table="tipo_egreso";
    protected $primaryKey ="Tex_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

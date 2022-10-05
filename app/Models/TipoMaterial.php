<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{
    use HasFactory;
    protected $table="tipo_material";
    protected $guarded = []; 
    protected $primaryKey ="Tmx_Id";
    public $timestamps = false;
}

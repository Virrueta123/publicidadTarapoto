<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos extends Model
{
    use HasFactory;
    protected $table="ingresos";
    protected $primaryKey ="Igx_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

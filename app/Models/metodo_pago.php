<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodo_pago extends Model
{
    use HasFactory;
    protected $table="metodo_pago";
    protected $primaryKey ="Mpx_Id";
    protected $guarded = []; 
    public $timestamps = false;
    
}

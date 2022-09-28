<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deudas extends Model
{
    use HasFactory;
    protected $table="deudas";
    protected $primaryKey ="Dex_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

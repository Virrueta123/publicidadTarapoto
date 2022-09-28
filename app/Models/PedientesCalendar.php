<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedientesCalendar extends Model
{
    use HasFactory;
    protected $table="pendientes";
    protected $primaryKey ="Pex_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

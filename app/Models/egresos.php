<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class egresos extends Model
{
    use HasFactory;
    protected $table="egresos";
    protected $primaryKey ="Egx_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

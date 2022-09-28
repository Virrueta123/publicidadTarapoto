<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rollo extends Model
{
    use HasFactory;
    protected $table="rollo";
    protected $primaryKey ="Rox_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

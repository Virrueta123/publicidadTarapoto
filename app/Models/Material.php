<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory; 
    protected $table="materiales";
    protected $primaryKey ="Mx_Id";
    protected $guarded = []; 
    public $timestamps = false;
}

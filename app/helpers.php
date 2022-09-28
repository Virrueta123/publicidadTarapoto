<?php
use Illuminate\Support\Carbon as dateController;

function fecha_hoy(){
     
    return dateController::now()->format('Y-m-d');
    
}

function limite_texto($value, $limit = 20, $end = '...'){
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}
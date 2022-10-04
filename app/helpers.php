<?php
use Illuminate\Support\Carbon as dateController;

function fecha_hoy(){
     
    return dateController::now()->format('Y-m-d');
    
}

function mesActual(){ 
    return dateController::now()->isoFormat("MM");
}

function mesyanotext(){
    return dateController::now()->isoFormat("MMMM Y"); 
}

function mesActualtext(){ 
     return dateController::now()->isoFormat('MMMM');
}
function anoActual(){ 
     return dateController::now()->format('Y');
}

function fechaactualText(){  
    return dateController::now()->isoFormat("D \D\E MMMM Y");
}
function fechaactual(){  
    return dateController::now()->format('Y-m-d');
}

function limite_texto($value, $limit = 20, $end = '...'){
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}

function generateDates(string $since, string $until = null) {
    $dates = [];

    if (! $until) {
        $until = date('Y-m-d');
    }

    $since = strtotime($since);
    $until = strtotime($until);

    do {
        $period           = date('Y-m', $since); // para agrupar por periodo AÑO-MES
        $dates[] = date('d-m-Y', $since);
        $since            = strtotime("+ 1 day", $since);
    } while($since <= $until);

    return $dates;
}

function moneyformat($money){
    return number_format($money, 2, '.', ',');
}
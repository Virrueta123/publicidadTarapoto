<?php

namespace App\Http\Livewire;

use App\Models\Rollo;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConsultarRollo extends Component
{
    public function getRox($cod,$ancho,$largo,$sobranteA,$sobranteL,$orientacion){
        $Rox = Rollo::where("active","A")->where("Rox_Cod",$cod)->first(); 

        if($Rox){
            $response = "";
            if($orientacion == 0){
                $rolloVertical = DB::select('CALL u236882933_publitarapoto.consultarRollo(?,?,?,?,?) ', [$cod,$ancho,$largo,$sobranteA,$sobranteL]);
                if(count($rolloVertical) != 0){
                    foreach ($rolloVertical as $rv) {
                        $longitudtotal = $rv->total;
                        if($rv->total==0){
                            $longitudtotal =  $rv->longitud;
                        }
        
                        if(  ($largo+$sobranteL) < $longitudtotal){
                            $response = '{"tipo":"success","mensaje":{ 
                                "cod":'.$cod.',
                                "ancho":'.$ancho.',
                                "largo":'.$largo.',
                                "rancho":'.$rv->Rox_Ancho.',
                                "rlongitud":'.$rv->longitud.',
                                "total":'.$longitudtotal.',
                                "orientacion":0,
                                "resto":'.$rv->resto.',
                                "descuento":'.$rv->descuentoRollo.',
                                "sobranteA":'.$sobranteA.',
                                "sobranteL":'.$sobranteL.' 
                            }}';
        
                        }else{
                            $response = '{"tipo":"error","mensaje":"las medidas del diseño de manera vertical superan las medidas de este rollo"}'; 
                        }  
                    }
                }else{
                    $response = '{"tipo":"error","mensaje":"las medidas del diseño de manera vertical superan las medidas de este rollo"}'; 
                }

            }else{
                
                $rolloHorizontal= DB::select('CALL u236882933_publitarapoto.consultarRollo(?,?,?,?,?) ', [$cod,$largo,$ancho,$sobranteL,$sobranteA]);
                if(count($rolloHorizontal) != 0){
                    foreach ($rolloHorizontal as $rh) {
                        $longitudtotal = $rh->total;
                            if($rh->total==0){
                                $longitudtotal =  $rh->longitud;
                            }
                        if(  ($ancho+$sobranteA) < $longitudtotal){
                        
                            $response = '{"tipo":"success","mensaje":{ 
                                "cod":'.$cod.',
                                "ancho":'.$largo.',
                                "largo":'.$ancho.',
                                "rancho":'.$rh->Rox_Ancho.',
                                "rlongitud":'.$rh->longitud.',
                                "total":'.$longitudtotal.',
                                "orientacion":1,
                                "resto":'.$rh->resto.',
                                "descuento":'.$rh->descuentoRollo.',
                                "sobranteA":'.$sobranteL.',
                                "sobranteL":'.$sobranteA.' 
                            }}';
                        }else{
                            $response = '{"tipo":"error","mensaje":"las medidas del diseño de manera horizontal superan las medidas de este rollo"}'; 
                        } 
                    }
                }else{
                    $response = '{"tipo":"error","mensaje":"las medidas del diseño de manera horizontal superan las medidas de este rollo"}'; 
                } 
            } 
            return $response;
        }else{
            return false;
        }
        
    }
    public function consultar($ancho,$largo,$sobranteA,$sobranteL,$tipoMaterial){
        $rolloVertical = DB::select('CALL u236882933_publitarapoto.consultarRolloVertical(?,?,?,?,?) ', [$ancho,$largo,$sobranteA,$sobranteL,$tipoMaterial]);

        $rolloHorizontal = DB::select('CALL u236882933_publitarapoto.consultarRolloVertical(?,?,?,?,?) ', [$largo,$ancho,$sobranteL,$sobranteA,$tipoMaterial]);
        
        $html = "";

        $htmlV = "";
        $htmlH = "";
         

        if(count($rolloVertical) != 0){
          
            $htmlV = "<tr>
                        <td> Posicion vertical <i class='fa-solid fa-up-down'></i> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>";
            
            foreach ($rolloVertical as $rv) {
                    $longitudtotal = $rv->total;
                    if($rv->total==0){
                        $longitudtotal =  $rv->longitud;
                    }
                if(  ($largo+$sobranteL) < $longitudtotal){
                    
                    $htmlV = $htmlV . "<tr><td> Rx{$rv->cod} </td>
                    <td><span class='badge badge-success'>{$rv->Rox_Ancho} ancho x {$longitudtotal} largo (actual)</span></td>
                    <td> {$rv->resto}</td>
                    <td>
                        <div class='sparkbar' data-color='#00a65a' data-height='20'><button type='button' onclick='elegirRollo({$rv->cod},{$ancho},{$largo},{$rv->Rox_Ancho},{$rv->longitud},{$longitudtotal},0,{$rv->resto},{$rv->descuentoRollo},{$sobranteA},{$sobranteL})' class='btn btn-xs btn-success'><i class='fa fa-check'> </i></button></div>
                    </td></tr>";
                }  
            }

        }

        if(count($rolloHorizontal) != 0){
            $htmlH = "<tr>
                        <td> Posicion Horizontal <i class='fa-solid fa-left-right'></i> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>";

            foreach ($rolloHorizontal as $rh) {
                $longitudtotal = $rh->total;
                    if($rh->total==0){
                        $longitudtotal =  $rh->longitud;
                    }
                if(  ($ancho+$sobranteA) < $longitudtotal){
                $htmlH = $htmlH . "<tr><td> Rx{$rh->cod} </td>
                        <td><span class='badge badge-success'>{$rh->Rox_Ancho} ancho x {$longitudtotal} largo (actual)</span></td>
                        <td> {$rh->resto} </td>
                        <td>
                            <div class='sparkbar' data-color='#00a65a' data-height='20'><button type='button' onclick='elegirRollo({$rv->cod},{$largo},{$ancho},{$rv->Rox_Ancho},{$rv->longitud},{$longitudtotal},1,{$rv->resto},{$rv->descuentoRollo},{$sobranteL},{$sobranteA})' class='btn btn-xs btn-success'><i class='fa fa-check'> </i></button></div>
                        </td></tr>"; 
                }
            }
        }

        $html = $htmlV . $htmlH;

        return $html;
    }
    public function render()
    {
        return view('livewire.consultar-rollo');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\cliente;
use Consulta\Laravel\Consulta;
use Livewire\Component;
use GuzzleHttp\Client;
use Peru\Jne\DniFactory;
use Peru\Sunat\RucFactory;
class ClienteAdd extends Component
{
    private function sunat($ruc){
        $token = env("CONSULTA_TOKEN");
        $number = $ruc;
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Referer' => 'https://apis.net.pe/api-consulta-ruc',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $number]
        ];
        $res = $client->request('GET', '/v1/ruc', $parameters);
        $response = json_decode($res->getBody()->getContents(), true);
        return $response;  

    }

    private function dni($dni){
        $dni = $dni; 
        $factory = new DniFactory();
        $cs = $factory->create(); 
        $person = $cs->get($dni);
        if (!$person) {
            return '{"tipo":"error","mensaje":"dni no encontrado"}'; 
        }else{
            return '{"tipo":"success","mensaje":'.json_encode($person).'}'; 
        }  
    }

    public function addCliente(
        $isruc,
        $Clx_Ruc,  
        $Clx_RazonSocial,
        $Clx_Direc,
        $Clx_Nombre,
        $Clx_Apellido,
        $Clx_Cel,
        $Clx_Dni
    )
    {   
        if( $isruc == 0 ){
            $search =  cliente::where("Clx_RazonSocial",$Clx_RazonSocial)->first();
        }else{
            $search =  cliente::where("Clx_Nombre",$Clx_Nombre)->where("Clx_Apellido",$Clx_Apellido)->first();
        } 

        if(is_null($search)){
            $create = cliente::create([
                "Clx_Ruc"=>$Clx_Ruc,  
                "Clx_RazonSocial"=>$Clx_RazonSocial,
                "Clx_Direc"=>$Clx_Direc,
                "Clx_Nombre"=>$Clx_Nombre,
                "Clx_Apellido"=>$Clx_Apellido,
                "Clx_Cel"=>$Clx_Cel,
                "Clx_Dni"=>$Clx_Dni
            ]);
            if($Clx_Ruc=="" && $Clx_RazonSocial==""){
                $alias = $Clx_Nombre ." ". $Clx_Apellido;
            }else{
                $alias = $Clx_RazonSocial;
            }
            if($create){
                return '{"tipo":"success","mensaje":{
                    "alias":"'.$alias.'",
                    "cod":'.$create->Clx_Id.'
                }}'; 
            }else{
                return '{"tipo":"error","mensaje":"cliente no se registro correctamente, intentelo una vez mas!"}'; 
            } 
        }else{
            return '{"tipo":"error","mensaje":"cliente Ya esta registrado"}';
        }
        
    }

    public function consultaRuc($num){ 
        $sunat = $this->sunat($num);
        return $sunat;
    }

    public function consultaDni($num){ 
        $dni = $this->dni($num);
        return  $dni;  
    }

    public function render()
    {
        return view('livewire.cliente-add');
    }
}

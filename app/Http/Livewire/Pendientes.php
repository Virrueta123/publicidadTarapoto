<?php

namespace App\Http\Livewire;

use App\Models\PedientesCalendar;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pendientes extends Component
{
    public $events = '';

    public function eventInfo($id){
        $eventdata = PedientesCalendar::select("pendientes.Pex_Id","pendientes.Pex_Id as id","pendientes.Pex_Desc as desc",'pendientes.Pex_Fecha as start','cliente.Clx_RazonSocial as Rz',DB::raw('CONCAT(cliente.Clx_Nombre,"-",cliente.Clx_Apellido) AS nombres'))
        ->join('cliente', 'cliente.Clx_Id', '=', 'pendientes.Clx_Id')
        ->where("pendientes.Pex_Id",$id) 
        ->first(); 
        return json_encode($eventdata);
    }

    public function eventDrop($event){
          
         $eventdata = PedientesCalendar::find($event['id']);
         $eventdata->Pex_Fecha= $event["start"]; 
         $eventdata->save(); 
         if($eventdata->save()){
            return true; 
         }else{
            return false; 
         }
         
    }

    public function render()
    {
        $events = PedientesCalendar::select("pendientes.Pex_Id as id","pendientes.Pex_Desc",'pendientes.Pex_Fecha as start','cliente.Clx_RazonSocial as Rz',DB::raw('CONCAT(cliente.Clx_Nombre,"-",cliente.Clx_Apellido) AS nombres'))
        ->join('cliente', 'cliente.Clx_Id', '=', 'pendientes.Clx_Id')
        ->where("pendientes.active","A") 
        ->get(); 
        $json = "[";
        foreach ($events as $event) {
            if($event->Rz != ""){ 
                $json = $json.'{
                    "id":"'.$event->id.'",
                    "title":"'.$event->Rz.'",
                    "start":"'.$event->start.'",
                    "allDay" : "true",
                    "className":"event'.$event->id.'"
                },';
            }else{
                $json = $json.'{
                    "id":"'.$event->id.'",
                    "title":"'.$event->nombres.'",
                    "start":"'.$event->start.'",
                    "allDay" : "true",
                    "className":"event'.$event->id.'"
                },';
            } 
        } 
        $json = substr($json, 0, strlen($json)-1);
        $json = $json . "]";
        $this->events = $json;
        return view('livewire.pendientes');
    }
}

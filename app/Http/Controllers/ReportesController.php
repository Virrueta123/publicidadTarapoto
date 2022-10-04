<?php

namespace App\Http\Controllers;

use App\Models\egresos;
use App\Models\ingresos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ruta = "modules.reportes.";
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
     

     public function ShowFecha($fecha)
    {
         
        return View($this->ruta."showFecha",[
            "fecha"=> $fecha
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function betweenDate()
    {
        $FechaI = "";
        $FechaF = "";
        $reporte = [];
        $isSearch = false;
        return View($this->ruta."between",[
            "FechaI"=>$FechaI,
            "FechaF"=>$FechaF,
            "reporte"=>$reporte,
            "isSearch"=>$isSearch
        ]); 
    }

    public function betweenDateSearch(Request $request)
    {   

        $FechaI = $request->all()["FechaI"];
        $FechaF = $request->all()["FechaF"];
        $isSearch = true;

        $IgxTotalG = ingresos::select(DB::raw('coalesce(SUM(ingresos.Igx_Monto),0) as total'))
        ->where("actives","A") 
        ->whereBetween('Igx_Fecha', [$FechaI, $FechaF])
        ->first();
            
        $IgxTarjetaG = ingresos::select(DB::raw('coalesce(SUM(Igx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","N") 
        ->whereBetween('ingresos.Igx_Fecha', [$FechaI, $FechaF])
        ->where("ingresos.actives","A")->first();
       
        $IgxEfectivoG = ingresos::select(DB::raw('coalesce(SUM(Igx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","Y")
        ->whereBetween('ingresos.Igx_Fecha', [$FechaI, $FechaF])
        ->where("ingresos.actives","A")->first();

        $EgxTotalG = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total')) 
        ->whereBetween('Egx_Fecha', [$FechaI, $FechaF])
        ->where("active","A")->first();
        
        $EgxTarjetaG = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","N") 
        ->whereBetween('egresos.Egx_Fecha', [$FechaI, $FechaF])
        ->where("egresos.active","A")->first();
       
        $EgxEfectivoG = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","Y")
        ->whereBetween('egresos.Egx_Fecha', [$FechaI, $FechaF])
        ->where("egresos.active","A")->first();
        
        $ganaciaTotal = $IgxTotalG->total - $EgxTotalG->total;
      
        $gananciaEfectivo = $IgxEfectivoG->total - $EgxEfectivoG->total;
        $gananciaTarjeta = $IgxTarjetaG->total - $EgxTarjetaG->total;

        $reporteGlobal = array(
            "ganaciaTotal" => moneyformat($ganaciaTotal),
            "gananciaEfectivo" => moneyformat($gananciaEfectivo),
            "gananciaTarjeta" => moneyformat($gananciaTarjeta),
            "IgxTotalG" => moneyformat($IgxTotalG->total),  
            "IgxTarjetaG" => moneyformat($IgxTarjetaG->total),  
            "IgxEfectivoG" => moneyformat($IgxEfectivoG->total),   
            "EgxTotalG" => moneyformat($EgxTotalG->total),   
            "EgxTarjetaG" => moneyformat($EgxTarjetaG->total),   
            "EgxEfectivoG" => moneyformat($EgxEfectivoG->total)
        );
 
        $now = $FechaI; 
        $latest = $FechaF; 

        $days = generateDates($now,$latest);
        
        $reporte = []; 

        foreach ($days as $day) { 
            $isReport = 0;

            $IgxTotal = ingresos::select(DB::raw('coalesce(SUM(ingresos.Igx_Monto),0) as total'))->where("Igx_Fecha",date('Y-m-d', strtotime($day)))->first();
            
            $IgxTarjeta = ingresos::select(DB::raw('coalesce(SUM(Igx_Monto),0) as total'))
            ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
            ->where("metodo_pago.Mpx_IsEfectivo","N")
            ->where("ingresos.Igx_Fecha",date('Y-m-d', strtotime($day)))->first();
           
            $IgxEfectivo = ingresos::select(DB::raw('coalesce(SUM(Igx_Monto),0) as total'))
            ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
            ->where("metodo_pago.Mpx_IsEfectivo","Y")
            ->where("ingresos.Igx_Fecha",date('Y-m-d', strtotime($day)))->first();

            $EgxTotal = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))->where("Egx_Fecha",date('Y-m-d', strtotime($day)))->first();
            
            $EgxTarjeta = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
            ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
            ->where("metodo_pago.Mpx_IsEfectivo","N")
            ->where("egresos.Egx_Fecha",date('Y-m-d', strtotime($day)))->first();
           
            $EgxEfectivo = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
            ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
            ->where("metodo_pago.Mpx_IsEfectivo","Y")
            ->where("egresos.Egx_Fecha",date('Y-m-d', strtotime($day)))->first();
            
            if($EgxTotal->total!=0){
                $isReport++;
            } 
            if($IgxTotal->total!=0){
                $isReport++;
            }
       
            if($isReport != 0){
                array_push($reporte,array(
                    "fecha"=>$day,
                    "IgxTotal"=>moneyformat($IgxTotal->total),
                    "IgxTarjeta"=>moneyformat($IgxTarjeta->total),
                    "IgxEfectivo"=>moneyformat($IgxEfectivo->total),
                    "EgxTotal"=>moneyformat($EgxTotal->total),
                    "EgxTarjeta"=>moneyformat($EgxTarjeta->total),
                    "EgxEfectivo"=>moneyformat($EgxEfectivo->total)
                ));
            }
            
        }
        return View($this->ruta."between",
        [
            "FechaI"=>$FechaI,
            "FechaF"=>$FechaF, 
            "reporte" => $reporte,
            "reporteGlobal" => $reporteGlobal,
            "isSearch"=>$isSearch
        ]); 
    }
    public function egresos(Request $request)
    {
        
        if ($request->ajax()) {
            $fecha = Carbon::parse($request->get("fecha"))->format("Y-m-d");
            $model = egresos::select("*")
            ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
            ->where("Egx_Fecha", $fecha ) 
            ->where("egresos.active","A") 
            ->get();

            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $msm = 'estas segur@ que desea elminar este egreso';
                    $actionBtn = '
                    <a href="'.route("Egresos.edit",$data->Egx_Id).'" class="edit btn btn-success btn-xs"><i class="fas fa-edit"> </i></a>
                    <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeleteMetodoPago'.$data->Egx_Id.'" action="'.route("Egresos.delete",$data->Egx_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'MetodoPago'.$data->Egx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                    '; 
                    return $actionBtn;
                }) 
                ->rawColumns(['action']) 
                ->make(true);
        }  

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ingresos(Request $request)
    {
        if ($request->ajax()) {
            $fecha = Carbon::parse($request->get("fecha"))->format("Y-m-d");
            $model = ingresos::select("*")
            ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
            ->join("cliente","cliente.Clx_Id","=","ingresos.Clx_Id")
            ->where("ingresos.Igx_Fecha",$fecha)
            ->where("actives","A")->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn("clientes",function($Data){ 
                    if($Data->Clx_RazonSocial!=""){
                        return $Data->Clx_RazonSocial;
                    }else{
                        return $Data->Clx_Nombre ." | ".$Data->Clx_Apellido; 
                    }
                })
                ->addColumn("monto",function($Data){
                    return "S/ ".moneyformat($Data->Igx_Monto);
                })
                ->addColumn('action', function($Data){
                    $msm = "estas segur@ que desea elminar este cliente";
                    $actionBtn = '
                    <a href="'.route("Cliente.show",$Data->Igx_Id).'" class="edit btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="'.route("Cliente.edit",$Data->Igx_Id).'" class="edit btn btn-success btn-sm"><i class="fas fa-edit"> </i></a> 
                    <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeletecliente'.$Data->Igx_Id.'" action="'.route("Cliente.delete",$Data->Igx_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'cliente'.$Data->Igx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                    ';
                    return $actionBtn;
                }) 
                ->rawColumns(['action']) 
                ->make(true);
         }  
    }

     
   
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\egresos;
use App\Models\ingresos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {   

        $clientes = cliente::select(DB::raw("count(*) as number"))->where("active","A")->first();

        $IgxTotalG = ingresos::select(DB::raw('coalesce(SUM(ingresos.Igx_Monto),0) as total'))
        ->where("actives","A")
        ->whereMonth( 'Igx_Fecha', '=', mesActual() )
        ->whereYear( 'Igx_Fecha', '=', anoActual() )
        ->first();
            
        $IgxTarjetaG = ingresos::select(DB::raw('coalesce(SUM(Igx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","N")
        ->whereMonth( 'ingresos.Igx_Fecha', '=', mesActual() )
        ->whereYear( 'ingresos.Igx_Fecha', '=', anoActual() )
        ->where("ingresos.actives","A")->first();
       
        $IgxEfectivoG = ingresos::select(DB::raw('coalesce(SUM(Igx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","Y")
        ->whereMonth( 'ingresos.Igx_Fecha', '=', mesActual() )
        ->whereYear( 'ingresos.Igx_Fecha', '=', anoActual() )
        ->where("ingresos.actives","A")->first();

        $EgxTotalG = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
        ->whereMonth( 'Egx_Fecha', '=', mesActual() )
        ->whereYear( 'Egx_Fecha', '=', anoActual() )
        ->where("active","A")->first();
        
        $EgxTarjetaG = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","N")
        ->whereMonth( 'egresos.Egx_Fecha', '=', mesActual() )
        ->whereYear( 'egresos.Egx_Fecha', '=', anoActual() )
        ->where("egresos.active","A")->first();
       
        $EgxEfectivoG = egresos::select(DB::raw('coalesce(SUM(Egx_Monto),0) as total'))
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","egresos.Mpx_Id")
        ->where("metodo_pago.Mpx_IsEfectivo","Y")
        ->whereMonth( 'egresos.Egx_Fecha', '=', mesActual() )
        ->whereYear( 'egresos.Egx_Fecha', '=', anoActual() )
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
 
        $now = Carbon::now()->startofMonth()->toDateString(); 
        $latest = date("Y-m-t", strtotime(fecha_hoy())); 

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
         
        return view('home',[
            "reporte" => $reporte,
            "reporteGlobal" => $reporteGlobal,
        ]);
    }
}

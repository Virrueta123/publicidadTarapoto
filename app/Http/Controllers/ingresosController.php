<?php

namespace App\Http\Controllers;

use App\Models\deudas;
use App\Models\ingresos;
use App\Models\metodo_pago;
use App\Models\Rollo;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ingresosController extends Controller
{
    private $ruta = "modules.ingresos.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function create()
    {      
        $metodoPago = metodo_pago::where("active","A")->get();
        $TipoMaterial = TipoMaterial::where("active","A")->get(); 
        return view($this->ruta."add",["TipoMaterial"=>$TipoMaterial,"metodoPago"=>$metodoPago]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
         
        if( $data["Clx_Id"] == 0){
            $clx_Id = $data["Clx_IdC"];
        }else{
            $clx_Id = $data["Clx_Id"];
        }
        
        $showRollo = Rollo::where("Rox_Cod",$data["Rox_Id"])->first();
        if($data["Igx_Orientacion"]=="V"){
            if($data["Igx_Monto"] != $data["Amortizacion"]){
                $ingresos = ingresos::create([ 
                    "Rox_Id"=>$showRollo->Rox_Id,
                    "Igx_Descripcion"=>$data["Igx_Descripcion"],
                    "Clx_Id"=>$clx_Id,
                    "Igx_Monto"=>$data["Amortizacion"],
                    "Igx_LimiteD"=>$data["Igx_LimiteL"],
                    "Igx_LimiteC"=>$data["Igx_LimiteA"],
                    "Igx_Ancho"=>$data["Igx_Ancho"],
                    "Igx_Largo"=>$data["Igx_Longitud"],
                    "Igx_Orientacion"=>$data["Igx_Orientacion"],
                    "Igx_Fecha"=>fecha_hoy(), 
                    "Mpx_Id"=> $data["Mpx_Id"],
                    "Igx_IsGastar"=>$data["Rox_IsGastado"],
                ]); 
            }else{
                $ingresos = ingresos::create([ 
                    "Rox_Id"=>$showRollo->Rox_Id,
                    "Igx_Descripcion"=>$data["Igx_Descripcion"],
                    "Clx_Id"=>$clx_Id,
                    "Igx_Monto"=>$data["Igx_Monto"],
                    "Igx_LimiteD"=>$data["Igx_LimiteL"],
                    "Igx_LimiteC"=>$data["Igx_LimiteA"],
                    "Igx_Ancho"=>$data["Igx_Ancho"],
                    "Igx_Largo"=>$data["Igx_Longitud"],
                    "Igx_Orientacion"=>$data["Igx_Orientacion"],
                    "Igx_Fecha"=>fecha_hoy(),
                    "Mpx_Id"=> $data["Mpx_Id"],
                    "Igx_IsGastar"=>$data["Rox_IsGastado"],
                ]); 
            }
        }else{
            $ingresos = ingresos::create([ 
                "Rox_Id"=>$showRollo->Rox_Id,
                "Igx_Descripcion"=>$data["Igx_Descripcion"],
                "Clx_Id"=>$clx_Id,
                "Igx_Monto"=>$data["Igx_Monto"],
                "Igx_LimiteD"=>$data["Igx_LimiteA"],
                "Igx_LimiteC"=>$data["Igx_LimiteL"],
                "Igx_Ancho"=>$data["Igx_Longitud"],
                "Igx_Largo"=>$data["Igx_Ancho"],
                "Igx_Orientacion"=>$data["Igx_Orientacion"],
                "Igx_Fecha"=>fecha_hoy(),
                "Mpx_Id"=> $data["Mpx_Id"],
                "Igx_IsGastar"=>$data["Rox_IsGastado"],
            ]);  
        } 
          
        if( $ingresos ){  
            
            if($data["Igx_Monto"] != $data["Amortizacion"]){
               $dx = deudas::create([ 
                    "Igx_Id" =>  $ingresos->Igx_Id,
                    "Dex_Total" => $data["Igx_Monto"],
                    "Dex_Amortizado" => $data["Amortizacion"],
                    "Dex_Deuda" => $data["Igx_Monto"] - $data["Amortizacion"],
               ]);
               if($dx){
                 session()->flash('successo', 'Un ingreso se registro correctamente');
                 return redirect()->route("home");
               }else{
                session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
                return redirect()->route("Ingresos.create");
               }
            } else{
                session()->flash('successo', 'Un ingreso se registro correctamente');
                return redirect()->route("home");
            }
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Ingresos.create");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all(); 
         
        if( $data["Clx_Id"] == 0){
            $clx_Id = $data["Clx_IdC"];
        }else{
            $clx_Id = $data["Clx_Id"];
        }
        
        $showRollo = Rollo::where("Rox_Cod",$data["Rox_Id"])->first();
        $ingresos = ingresos::where("Igx_Id",$id)->first();
        if($data["Igx_Orientacion"]=="V"){
            if($data["Igx_Monto"] != $data["Amortizacion"]){
                $ingresos->update([ 
                    "Rox_Id"=>$showRollo->Rox_Id,
                    "Igx_Descripcion"=>$data["Igx_Descripcion"],
                    "Clx_Id"=>$clx_Id,
                    "Igx_Monto"=>$data["Amortizacion"],
                    "Igx_LimiteD"=>$data["Igx_LimiteL"],
                    "Igx_LimiteC"=>$data["Igx_LimiteA"],
                    "Igx_Ancho"=>$data["Igx_Ancho"],
                    "Igx_Largo"=>$data["Igx_Longitud"],
                    "Igx_Orientacion"=>$data["Igx_Orientacion"],
                    "Igx_Fecha"=>$data["Igx_Fecha"], 
                    "Mpx_Id"=> $data["Mpx_Id"],
                    
                ]); 
            }else{
                $ingresos->update([ 
                    "Rox_Id"=>$showRollo->Rox_Id,
                    "Igx_Descripcion"=>$data["Igx_Descripcion"],
                    "Clx_Id"=>$clx_Id,
                    "Igx_Monto"=>$data["Igx_Monto"],
                    "Igx_LimiteD"=>$data["Igx_LimiteL"],
                    "Igx_LimiteC"=>$data["Igx_LimiteA"],
                    "Igx_Ancho"=>$data["Igx_Ancho"],
                    "Igx_Largo"=>$data["Igx_Longitud"],
                    "Igx_Orientacion"=>$data["Igx_Orientacion"],
                    "Igx_Fecha"=>$data["Igx_Fecha"],
                    "Mpx_Id"=> $data["Mpx_Id"],
                    
                ]); 
            }
        }else{
            $ingresos->update([ 
                "Rox_Id"=>$showRollo->Rox_Id,
                "Igx_Descripcion"=>$data["Igx_Descripcion"],
                "Clx_Id"=>$clx_Id,
                "Igx_Monto"=>$data["Igx_Monto"],
                "Igx_LimiteD"=>$data["Igx_LimiteA"],
                "Igx_LimiteC"=>$data["Igx_LimiteL"],
                "Igx_Ancho"=>$data["Igx_Longitud"],
                "Igx_Largo"=>$data["Igx_Ancho"],
                "Igx_Orientacion"=>$data["Igx_Orientacion"],
                "Igx_Fecha"=>$data["Igx_Fecha"],
                "Mpx_Id"=> $data["Mpx_Id"],
                
            ]);  
        } 
          
        if( $ingresos ){  
            
            if($data["Igx_Monto"] != $data["Amortizacion"]){
               $dx = deudas::create([ 
                    "Igx_Id" =>  $ingresos->Igx_Id,
                    "Dex_Total" => $data["Igx_Monto"],
                    "Dex_Amortizado" => $data["Amortizacion"],
                    "Dex_Deuda" => $data["Igx_Monto"] - $data["Amortizacion"],
               ]);

               $ingresos->update([  
                "Igx_Monto"=>$data["Amortizacion"], 
               ]); 

               if($dx){
                 session()->flash('successo', 'Un ingreso se edito correctamente');
                 return redirect()->route("home");
               }else{
                session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
                return redirect()->route("Ingresos.create");
               }
            } else{
                session()->flash('successo', 'Un ingreso se edito correctamente');
                return redirect()->route("home");
            }
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Ingresos.create");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Mpxs = metodo_pago::where("active","A")->get(); 
        $Igx = ingresos::select("*")
        ->join("cliente","cliente.Clx_Id","=","ingresos.Clx_Id")
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->join("rollo","rollo.Rox_Id","=","ingresos.Rox_Id")
        ->where("Igx_Id",$id)->where("actives","A")
        ->first();
        if($Igx){ 
            return view($this->ruta."edit",["Igx"=>$Igx,"Mpxs"=>$Mpxs ]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este ingreso no se encontro",
                     "desc"=>"intente de nuevo"
                   ]); 
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
        $Igx = ingresos::where("Igx_Id",$id)->where("actives","A")->first();
        $Igx = $Igx->update( ["actives"=>"D"] );
        if( $Igx){  
            session()->flash('successo', 'Un ingresos se elimino');
            return redirect()->route("home");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("home");
        }
    }
}

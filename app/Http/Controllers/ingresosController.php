<?php

namespace App\Http\Controllers;

use App\Models\deudas;
use App\Models\ingresos;
use App\Models\Rollo;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ingresosController extends Controller
{
    private $ruta = "modules.Ingresos.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        $TipoMaterial = TipoMaterial::where("active","A")->get(); 
        return View($this->ruta."add",["TipoMaterial"=>$TipoMaterial]);
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
       
        $showRollo = Rollo::where("Rox_Cod",$data["Rox_Id"])->first();
        if($data["Igx_Orientacion"]=="V"){
            $ingresos = ingresos::create([ 
                "Rox_Id"=>$showRollo->Rox_Id,
                "Igx_Descripcion"=>$data["Igx_Descripcion"],
                "Clx_Id"=>$data["Clx_IdC"],
                "Igx_Monto"=>$data["Igx_Monto"],
                "Igx_LimiteD"=>$data["Igx_LimiteL"],
                "Igx_LimiteC"=>$data["Igx_LimiteA"],
                "Igx_Ancho"=>$data["Igx_Ancho"],
                "Igx_Largo"=>$data["Igx_Longitud"],
                "Igx_Orientacion"=>$data["Igx_Orientacion"],
                "Igx_Fecha"=>fecha_hoy(), 
            ]); 
        }else{
            $ingresos = ingresos::create([ 
                "Rox_Id"=>$showRollo->Rox_Id,
                "Igx_Descripcion"=>$data["Igx_Descripcion"],
                "Clx_Id"=>$data["Clx_IdC"],
                "Igx_Monto"=>$data["Igx_Monto"],
                "Igx_LimiteD"=>$data["Igx_LimiteA"],
                "Igx_LimiteC"=>$data["Igx_LimiteL"],
                "Igx_Ancho"=>$data["Igx_Longitud"],
                "Igx_Largo"=>$data["Igx_Ancho"],
                "Igx_Orientacion"=>$data["Igx_Orientacion"],
                "Igx_Fecha"=>fecha_hoy(), 
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
        //
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

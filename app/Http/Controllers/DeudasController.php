<?php

namespace App\Http\Controllers;

use App\Models\deudas;
use App\Models\ingresos;
use App\Models\metodo_pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
 
class DeudasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ruta = "modules.deudas.";

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
    public function pay(Request $request, $id)
    {
        $dex = deudas::select("*")
        ->join('ingresos', 'ingresos.Igx_Id', '=', 'deudas.Igx_Id')
        ->leftjoin('metodo_pago', 'metodo_pago.Mpx_Id', '=', 'ingresos.Mpx_Id')
        ->leftjoin('cliente', 'cliente.Clx_Id', '=', 'ingresos.Clx_Id') 
        ->where("Dex_Id",$id)
        ->where("deudas.active","A") ->first();

        $ingresos = ingresos::create([ 
            "Rox_Id"=>$dex->Rox_Id,
            "Igx_Descripcion"=>$dex->Igx_Descripcion,
            "Clx_Id"=>$dex->Clx_Id,
            "Igx_Monto"=>$request->all()["Mpx_Deuda"],
            "Igx_LimiteD"=>0,
            "Igx_LimiteC"=>0,
            "Igx_Ancho"=>0,
            "Igx_Largo"=>0,
            "Igx_Orientacion"=>"V",
            "Igx_Fecha"=>fecha_hoy(),
            "Mpx_Id"=> $request->all()["Mpx_Id"],
            "Igx_IsGastar"=>"N"
        ]); 
 
        if( $ingresos ){ 
            $dex = deudas::where("Dex_Id",$id)->first(); 
            $dex = $dex->update([
                "active"=>"D"
            ]);
            session()->flash('successo', 'se pago la deuda correctamente');
            return redirect()->route("MetodoPago.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("MetodoPago.index");
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
        $Mpxs = metodo_pago::where("active","A")->get();
        $dex = deudas::select("*")
        ->join('ingresos', 'ingresos.Igx_Id', '=', 'deudas.Igx_Id')
        ->leftjoin('metodo_pago', 'metodo_pago.Mpx_Id', '=', 'ingresos.Mpx_Id')
        ->leftjoin('cliente', 'cliente.Clx_Id', '=', 'ingresos.Clx_Id') 
        ->where("Dex_Id",$id)
        ->where("deudas.active","A") ->first();

        if($dex){ 
            $fechaHuman = Carbon::parse($dex->Igx_Fecha)->diffInDays(fecha_hoy());
            return view($this->ruta."show",["dex"=>$dex,"fechaHuman"=>$fechaHuman,"Mpxs"=>$Mpxs]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este deuda no se encontro",
                     "desc"=>"intente de nuevo"
                   ]); 
        }
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

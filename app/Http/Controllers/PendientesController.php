<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\PedientesCalendar;
use Illuminate\Http\Request;

class PendientesController extends Controller
{
    private $ruta = "modules.pendientes.";
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
        return view($this->ruta."index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->ruta."add");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            "Pex_Desc"=>"required",
            "Clx_Id"=>"required", 
            "Pex_Fecha"=>"required",
        ]);
        $create = PedientesCalendar::create($valid); 
        if( $create ){  
            session()->flash('successo', 'Un trabajo pendiente fue creado correctamente');
            return redirect()->route("Pendientes.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Pendientes.index");
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
    public function edit($id)
    {
        $Pex = PedientesCalendar::where("Pex_Id",$id)->where("active","A")->first();
        if($Pex){ 
            $Clx = cliente::where("Clx_Id",$Pex->Clx_Id)->first();
            if($Clx->Clx_RazonSocial!=""){
                $cliente = "Ruc =".$Clx->Clx_Ruc."-".$Clx->Clx_RazonSocial." | Nombres = ".$Clx->Clx_Nombre."-".$Clx->Clx_Apellido;
            }else{
                $cliente = "Dni =".$Clx->Clx_Dni."-".$Clx->Clx_Nombre."-".$Clx->Clx_Apellido;
            }
            return view($this->ruta."edit",["Pex"=>$Pex,"cliente"=>$cliente,"cod"=>$Pex->Clx_Id]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este pendiente no se encontro",
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
        $valid = $request->validate([
            "Pex_Desc"=>"required",
            "Clx_Id"=>"required", 
            "Pex_Fecha"=>"required",
        ]);
        $Pex = PedientesCalendar::where("Pex_Id",$id)->where("active","A")->first();
        $Pex = $Pex->update( $valid );
        if( $Pex){  
            session()->flash('successo', 'Un pendiente se actualizo correctamente');
            return redirect()->route("Pendientes.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Pendientes.index");
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
        $Pex = PedientesCalendar::where("Pex_Id",$id)->where("active","A")->first();
        $Pex = $Pex->update( ["active"=>"D"] );
        if( $Pex ){  
            session()->flash('successo', 'Un Pendiente se elimino correctamente');
            return redirect()->route("Pendientes.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Pendientes.index");
        }
    }

    public function data(Request $request)
    {
        //
    }
}

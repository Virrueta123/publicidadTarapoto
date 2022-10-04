<?php

namespace App\Http\Controllers;

use App\Models\metodo_pago;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MetodoPagoController extends Controller
{
    private $ruta = "modules.MetodoPago.";
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
        return View($this->ruta."index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View($this->ruta."create");
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
            "Mpx_Nombre"=>"required" 
        ]);
        $create = metodo_pago::create($valid); 
        if( $create ){  
            session()->flash('successo', 'Un metodo de pago se creó correctamente');
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
        $Mpx = metodo_pago::where("Mpx_Id",$id)->where("active","A")->first();
        if($Mpx){ 
            return View($this->ruta."edit",["Mpx"=>$Mpx]); 
        }else{
            return View("layouts.error404",[
                     "title"=>"este metodo de pago no se encontro",
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
            "Mpx_Nombre"=>"required"  
        ]);
        $Mpx = metodo_pago::where("Mpx_Id",$id)->where("active","A")->first();
        $Mpx = $Mpx->update( $valid );
        if( $Mpx){  
            session()->flash('successo', 'Un metodo de pago se actualizo correctamente');
            return redirect()->route("TipoEgresos.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("TipoEgresos.index");
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
        $Mpx = metodo_pago::where("Mpx_Id",$id)->where("active","A")->first();
        $Mpx = $Mpx->update( ["active"=>"D"] );
        if( $Mpx){  
            session()->flash('successo', 'Un metodo de pago se elimino');
            return redirect()->route("MetodoPago.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("MetodoPago.index");
        }
    }

    public function data(Request $request){
        if ($request->ajax()) {
            $model = metodo_pago::where("active","A")->where("Mpx_IsEfectivo","N")->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $msm = 'estas segur@ que desea elminar este metodo de pago';
                    $actionBtn = '
                    <a href="'.route("TipoEgresos.edit",$data->Mpx_Id).'" class="edit btn btn-success btn-xs"><i class="fas fa-edit"> </i></a>
                    <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeleteMetodoPago'.$data->Mpx_Id.'" action="'.route("MetodoPago.delete",$data->Mpx_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'MetodoPago'.$data->Mpx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                    '; 
                    return $actionBtn;
                }) 
                ->rawColumns(['action']) 
                ->make(true);
        }  
    }
}

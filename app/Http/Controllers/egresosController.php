<?php

namespace App\Http\Controllers;

use App\Models\egresos;
use App\Models\metodo_pago;
use App\Models\tipoEgreso;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class egresosController extends Controller
{
    private $ruta = "modules.egresos.";
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
        $Mpxs = metodo_pago::where("active","A")->get();
        $Texs = tipoEgreso::where("active","A")->get();
        return View($this->ruta."add",["Texs"=>$Texs,"Mpxs"=>$Mpxs]);
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
            "Egx_Desc"=>"required",
            "Egx_Monto"=>"required", 
            "Tpx_Id"=>"required", 
            "Mpx_Id"=>"required", 
        ]);
        $valid["Egx_Fecha"] = fecha_hoy();
        $create = egresos::create($valid); 
        if( $create ){  
            session()->flash('successo', 'Registro creado correctamente');
            return redirect()->route("Egresos.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Egresos.index");
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

    public function edit($id)
    {
        $Mpxs = metodo_pago::where("active","A")->get();
        $Texs = tipoEgreso::where("active","A")->get();
        $Egx = egresos::where("Egx_Id",$id)->where("active","A")->first();
        if($Egx){ 
            return View($this->ruta."edit",["Egx"=>$Egx,"Mpxs"=>$Mpxs,"Texs"=>$Texs]); 
        }else{
            return View("layouts.error404",[
                     "title"=>"este egreso no se encontro",
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
            "Egx_Desc"=>"required",
            "Egx_Monto"=>"required", 
            "Tpx_Id"=>"required", 
            "Mpx_Id"=>"required", 
        ]);
        
        $Egx = egresos::where("Egx_Id",$id)->where("active","A")->first();
        $Egx = $Egx->update( $valid );
        if( $Egx){  
            session()->flash('successo', 'Un egreso se actualizo correctamente');
            return redirect()->route("Egresos.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Egresos.index");
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
        $Egx = egresos::where("Egx_Id",$id)->where("active","A")->first();
        $Egx = $Egx->update( ["active"=>"D"] );
        if( $Egx){  
            session()->flash('successo', 'Un egreso se elimino');
            return redirect()->route("Egresos.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Egresos.index");
        }
    }

    public function data(Request $request){
        if ($request->ajax()) {
            $model = egresos::where("active","A")->get();
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
}

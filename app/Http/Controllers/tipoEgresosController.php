<?php

namespace App\Http\Controllers;

use App\Models\tipoEgreso;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class tipoEgresosController extends Controller
{
    private $ruta = "modules.tipoegresos.";
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
            "Tex_Desc"=>"required",
            "Tex_Alias"=>"required", 
        ]);
        $create = tipoEgreso::create($valid); 
        if( $create ){  
            session()->flash('successo', 'Un tipo de egreso se creó correctamente');
            return redirect()->route("TipoEgresos.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("TipoEgresos.index");
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
        $Tex = tipoEgreso::where("Tex_Id",$id)->where("active","A")->first();
        if($Tex){ 
            return view($this->ruta."edit",["Tex"=>$Tex]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este tipo de egreso no se encontro",
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
            "Tex_Desc"=>"required",
            "Tex_Alias"=>"required", 
        ]);
        $Tex = tipoEgreso::where("Tex_Id",$id)->where("active","A")->first();
        $Tex = $Tex->update( $valid );
        if( $Tex){  
            session()->flash('successo', 'Un tipo de egreso se actualizo correctamente');
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
        $Tex = tipoEgreso::where("Tex_Id",$id)->where("active","A")->first();
        $Tex = $Tex->update( ["active"=>"D"] );
        if( $Tex){  
            session()->flash('successo', 'Un tipo de egreso se elimino');
            return redirect()->route("TipoEgresos.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("TipoEgresos.index");
        }
    }

    public function data(Request $request){
        if ($request->ajax()) {
            $model = tipoEgreso::where("active","A")->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $msm = 'estas segur@ que desea elminar este tipo de egreso';
                    $actionBtn = '
                    <a href="'.route("TipoEgresos.edit",$data->Tex_Id).'" class="edit btn btn-success btn-xs"><i class="fas fa-edit"> </i></a>
                    <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeletetipoegreso'.$data->Tex_Id.'" action="'.route("TipoEgresos.delete",$data->Tex_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'tipoegreso'.$data->Tex_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                    '; 
                    return $actionBtn;
                }) 
                ->rawColumns(['action']) 
                ->make(true);
        }  
    }
}

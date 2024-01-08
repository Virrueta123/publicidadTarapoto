<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use Facade\FlareClient\view;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class TipoMaterialController extends Controller
{
    private $ruta = "modules.TipoMaterial.";
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
        return view("modules.TipoMaterial.index");
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->ruta."create");
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
            "Tmx_Nombre"=>"required" 
        ]);
        $create = TipoMaterial::create($valid); 
        if( $create ){  
            session()->flash('successo', 'Un tipo de material se creó correctamente');
            return redirect()->route("TipoMaterial.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("TipoMaterial.index");
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
        $Tmx = TipoMaterial::where("Tmx_Id",$id)->where("active","A")->first();
        if($Tmx){ 
            return view($this->ruta."edit",["Tmx"=>$Tmx]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este tipo de material no se encontro",
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
            "Tmx_Nombre"=>"required"  
        ]);
        $Tmx = TipoMaterial::where("Tmx_Id",$id)->where("active","A")->first();
        $Tmx = $Tmx->update( $valid );
        if( $Tmx){  
            session()->flash('successo', 'Un tipo de material se actualizo correctamente');
            return redirect()->route("TipoMaterial.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("TipoMaterial.index");
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
        $Tmx = TipoMaterial::where("Tmx_Id",$id)->where("active","A")->first();
        $Tmx = $Tmx->update( ["active"=>"D"] );
        if( $Tmx){  
            session()->flash('successo', 'Un tipo de material se elimino');
            return redirect()->route("TipoMaterial.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("TipoMaterial.index");
        }
    }

    public function data(Request $request){
        if ($request->ajax()) {
            $model = TipoMaterial::where("active","A")->get();
            return Datatables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $msm = 'estas segur@ que desea elminar este tipo de egreso';
                    $actionBtn = '
                    <a href="'.route("TipoMaterial.edit",$data->Tmx_Id).'" class="edit btn btn-success btn-xs"><i class="fas fa-edit"> </i></a>
                    <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeletetipomaterial'.$data->Tmx_Id.'" action="'.route("TipoMaterial.delete",$data->Tmx_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'tipomaterial'.$data->Tmx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                    '; 
                    return $actionBtn;
                }) 
                ->rawColumns(['action']) 
                ->make(true);
        }  
    }
}

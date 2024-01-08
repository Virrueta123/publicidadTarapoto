<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Rollo;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
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
        return view("modules.Material.index");
    }

    public function create(){
        $data = [];
        $Tmxs = TipoMaterial::where("active","A")->get();
        array_push($data,["Tmxs"=>$Tmxs]);
 
        return view("modules.Material.add",["Tmxs"=>$Tmxs]);
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
            "Mx_Ancho"=>"required",
            "Mx_Longitud"=>"required",
            "Mx_Nombre"=>"required|max:149",
            "Tmxs"=>"required",
        ]);
        $Tmxs = Arr::pull($valid, 'Tmxs');
        $Tmxs = Arr::add($valid, 'Tmx_Id', $Tmxs); 
        $create = Material::create($Tmxs);
         
        if( $create ){ 
            session()->flash('successo', 'Registro creado correctamente');
            return redirect()->route("Material.show",$create->Mx_Id);
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Material.index");
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
        $show = Material::select("*")
        ->join('tipo_material', 'tipo_material.Tmx_Id', '=', 'materiales.Tmx_Id') 
        ->where("materiales.Mx_Id",$id)
        ->where("materiales.active","A")->first(); 
        if($show){ 
            $rollos = DB::select('CALL bd_publitara.showRollos(?) ', [$show->Mx_Id]);
           
            return view("modules.Material.show",["cod"=>$id,"show"=>$show,"rollos"=>$rollos]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este material no se encontro",
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
    public function edit( $id)
    {
        $Tmxs = TipoMaterial::where("active","A")->get(); 
        $Mx = Material::select("*") 
        ->join("tipo_material","tipo_material.Tmx_Id","=","materiales.Tmx_Id") 
        ->where("Mx_Id",$id)->where("materiales.active","A")
        ->first();
        if($Mx){ 
            return view("modules.Material.edit",["Mx"=>$Mx,"Tmxs"=>$Tmxs ]); 
        }else{
            return view("layouts.error404",[
                     "title"=>"este material no se encontro",
                     "desc"=>"intente de nuevo"
                   ]); 
        }
    }

    public function update(Request $request, $id)
        {
            $valid = $request->validate([
                "Mx_Ancho"=>"required",
                "Mx_Longitud"=>"required",
                "Mx_Nombre"=>"required|max:149",
                "Tmxs"=>"required",
            ]);
            $Tmxs = Arr::pull($valid, 'Tmxs');
            $Tmxs = Arr::add($valid, 'Tmx_Id', $Tmxs); 
            $create = Material::where("Mx_Id",$id)->where("active","A")
            ->first()->update($Tmxs);
             
            if( $create ){ 
                session()->flash('successo', 'Registro se edito correctamente');
                return redirect()->route("Material.index");
            }else{
                session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
                return redirect()->route("Material.index");
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
        $Mx = Material::where("Mx_Id",$id)->where("active","A")->first();
        $Mx = $Mx->update( ["active"=>"D"] );
        if( $Mx){  
            session()->flash('successo', 'Un material se elimino');
            return redirect()->route("Material.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Material.index");
        } 
    }

    public function data(Request $request){
         if ($request->ajax()) {
             $model = Material::where("active","A")->get();
             return DataTables::of($model)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                    $msm = 'estas segur@ que desea elminar este material';
                     $actionBtn = '
                     <a href="'.route("Material.show",$row->Mx_Id).'" class="edit btn btn-success btn-sm"><i class="far fa-eye"> </i></a>
                     <a href="'.route("Material.edit",$row->Mx_Id).'" class="edit btn btn-success btn-sm"><i class="fas fa-edit"> </i></a> 
                     <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeletematerial'.$row->Mx_Id.'" action="'.route("Material.delete",$row->Mx_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'material'.$row->Mx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                     ';
                     return $actionBtn;
                 }) 
                 ->rawColumns(['action']) 
                 ->make(true);
         }  
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Material;
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
        return View("modules.Material.index");
    }

    public function create(){
        $data = [];
        $Tmxs = TipoMaterial::where("active","A")->get();
        array_push($data,["Tmxs"=>$Tmxs]);
 
        return View("modules.Material.add",["Tmxs"=>$Tmxs]);
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
            return View("modules.Material.show",["cod"=>$id,"show"=>$show,"rollos"=>$rollos]); 
        }else{
            return View("layouts.error404",[
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

    public function data(Request $request){
         if ($request->ajax()) {
             $model = Material::where("active","A")->get();
             return DataTables::of($model)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $actionBtn = '
                     <a href="'.route("Material.show",$row->Mx_Id).'" class="edit btn btn-success btn-sm"><i class="far fa-eye"> </i></a>
                     <a href="javascript:void(0)" class="edit btn btn-success btn-sm"><i class="fas fa-edit"> </i></a> 
                     <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"> </i></a>
                     ';
                     return $actionBtn;
                 }) 
                 ->rawColumns(['action']) 
                 ->make(true);
         }  
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\egresos;
use App\Models\ingresos;
use App\Models\Material;
use App\Models\Rollo;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RolloController extends Controller
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
        return View("modules.Lote.index");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($cod)
    {  
        $showMx = Material::select("*")
        ->join('tipo_material', 'tipo_material.Tmx_Id', '=', 'materiales.Tmx_Id')
        ->where("materiales.Mx_Id",$cod)
        ->where("materiales.active","A")->first(); 
        if($showMx){ 
            $ultimoCod = Rollo::max("Rox_Cod");

            if(is_null($ultimoCod)){
                $codRollo = 100;
            }else{
                $codRollo = $ultimoCod + 1;
            }   
            return View("modules.Rollo.add",["cod"=>$cod,"codRollo"=>$codRollo,"showMx"=>$showMx]); 
        }else{
            return View("layouts.error404",[
                     "title"=>"este material no se encontro",
                     "desc"=>"intente de nuevo"
                   ]); 
        }
        
    } 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($codmaterial,Request $request)
    {
        $valid = $request->validate([  
            "Rox_IsGastado"=>"required",  
        ]);

        $mxshow = Material::where("Mx_Id",$codmaterial)->first(); 
 
        $valid["Rox_Ancho"] = $mxshow->Mx_Ancho;
        $valid["Rox_Longitud"] = $mxshow->Mx_Longitud;

        $valid["Rox_Fecha"] = fecha_hoy();
        $valid["Mx_Id"] = $codmaterial;
        $ultimoCod = Rollo::max("Rox_Cod");

        if(is_null($ultimoCod)){
            $valid["Rox_Cod"] = 100;
        }else{
            $valid["Rox_Cod"] = $ultimoCod + 1;
        }  

        $create = Rollo::create($valid); 

        if( $create ){  
            session()->flash('successo', 'Registro creado correctamente');
            return redirect()->route("Material.show",$codmaterial);
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Material.index");
        }
    }
    // ajax
    public function cbx(Request $request)
    {
        $Roxs = Rollo::where('Rox_Cod', 'like', '%'.$request->all()["searchTerm"].'%')
                ->limit(7)
                ->get(); 
        $valid_tags = [];
        
            foreach ($Roxs  as $Rox) {
                if( $Rox->Rox_IsGastado == "Y" ){ 
                        $valid_tags[] = ['id' => $Rox->Rox_Cod, 'text' => $Rox->Rox_Cod ];  
                }
            } 
        echo json_encode($valid_tags);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Rollo::select("*")
        ->leftjoin('materiales', 'materiales.Mx_Id', '=', 'rollo.Mx_Id')
        ->leftjoin('tipo_material', 'tipo_material.Tmx_Id', '=', 'materiales.Tmx_Id')
        ->where("rollo.Rox_Cod",$id) 
        ->where("rollo.active","A") 
        ->first();  

        $usado = ingresos::select(DB::raw("coalesce(sum(Igx_Largo + Igx_LimiteD),0) as descuentoRollo"))
        ->where("Rox_Id",$show->Rox_Id)
        ->where("actives","A")
        ->where("Igx_IsGastar","Y")->first(); 
    
        return View("modules.Rollo.show",["show"=>$show,"usado"=>$usado]);
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
        $Rox = Rollo::where("Rox_Id",$id)->where("active","A")->first();
        $Rox = $Rox->update( ["active"=>"D"] );
        if( $Rox){  
            session()->flash('successo', 'Un rollo se elimino');
            return redirect()->route("home");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("home");
        }
    }

    public function Igxs(Request $request){
    if ($request->ajax()) {
        $model = ingresos::select("*")
        ->join("rollo","rollo.Rox_Id","=","ingresos.Rox_Id")
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->where("rollo.Rox_Cod",$request->get("Rox_Cod"))
        ->where("actives","A")->get();
        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn("monto",function($Data){
                return "S/ ".moneyformat($Data->Igx_Monto);
            })
            ->addColumn('action', function($Data){
                $msm = "estas segur@ que desea elminar este cliente";
                $actionBtn = '
                <a href="'.route("Cliente.show",$Data->Igx_Id).'" class="edit btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                <a href="'.route("Cliente.edit",$Data->Igx_Id).'" class="edit btn btn-success btn-sm"><i class="fas fa-edit"> </i></a> 
                <a  class="edit btn  btn-xs">
                <form method="POST"  id="formdeletecliente'.$Data->Igx_Id.'" action="'.route("Cliente.delete",$Data->Igx_Id).'">
                        <input type="hidden" name="_token" value="'. csrf_token() .'">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit"  onclick="FormDelete(\'cliente'.$Data->Igx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                 </form></a>
                ';
                return $actionBtn;
            }) 
            ->rawColumns(['action']) 
            ->make(true);
     }  
    }
}

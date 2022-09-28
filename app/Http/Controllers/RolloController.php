<?php

namespace App\Http\Controllers;

use App\Models\egresos;
use App\Models\Material;
use App\Models\Rollo;
use App\Models\TipoMaterial;
use Illuminate\Http\Request;

class RolloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $codRollo = Rollo::latest('Rox_Cod')->first()->Rox_Cod + 1; 
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
            "Rox_Precio"=>"required", 
            "Rox_Monto"=>"required", 
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

        $mx = Material::where("Mx_Id",$codmaterial)->first();

        $createEgx = egresos::create([
            "Egx_Desc" => "Compra de rollo ".$mx->Mx_Nombre,
            "Egx_Monto"=> $request->all()["Rox_Monto"],
            "Tpx_Id"=> 1,
            "Mpx_Id"=>1
        ]);

        $valid["Egx_Id"] = $createEgx->Egx_Id;

        $create = Rollo::create($valid); 

        if( $create ){  
            session()->flash('successo', 'Registro creado correctamente');
            return redirect()->route("Material.show",$codmaterial);
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
        $show = Rollo::select("*")
        ->leftjoin('materiales', 'materiales.Mx_Id', '=', 'rollo.Mx_Id')
        ->leftjoin('tipo_material', 'tipo_material.Tmx_Id', '=', 'materiales.Tmx_Id')
        ->where("rollo.Rox_Cod",$id) 
        ->where("rollo.active","A") 
        ->first();  

        $showMx = Material::select("*")
        ->join('tipo_material', 'tipo_material.Tmx_Id', '=', 'materiales.Tmx_Id')
        ->where("materiales.Mx_Id",$id)
        ->where("materiales.active","A")->first(); 
       
        return View("modules.Rollo.show",["show"=>$show]);
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

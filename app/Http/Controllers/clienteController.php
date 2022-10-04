<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\ingresos;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class clienteController extends Controller
{
    private $ruta = "modules.cliente.";
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
        return View($this->ruta."add");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Clx = cliente::where("Clx_Id",$id)->where("active","A")->first(); 
        if($Clx){ 
            return View($this->ruta."show",["Clx"=>$Clx]);
        }else{
            return View("layouts.error404",[
                     "title"=>"este cliente no se encontro",
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
    public function edit($id)
    {
        $Clx = cliente::where("Clx_Id",$id)->where("active","A")->first();
        if($Clx){ 
            return View($this->ruta."edit",["Clx"=>$Clx]); 
        }else{
            return View("layouts.error404",[
                     "title"=>"este cliente no se encontro",
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
        $data = $request->all();
        $Clx = cliente::where("Clx_Id",$id)->first();
        $Clx = $Clx->update( [
            "Clx_RazonSocial" => $data["Clx_RazonSocial"],
            "Clx_Nombre" => $data["Clx_Nombre"],
            "Clx_Apellido" => $data["Clx_Apellido"],
            "Clx_Ruc" => $data["Clx_Ruc"],
            "Clx_Dni" => $data["Clx_Dni"],
            "Clx_Cel" => $data["Clx_Cel"],
            "Clx_Direc" => $data["Clx_Direc"]
        ] );
        if( $Clx){  
            session()->flash('successo', 'Un cliente se actualizo correctamente');
            return redirect()->route("Cliente.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Cliente.index");
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
        $Clx = cliente::where("Clx_Id",$id)->where("active","A")->first();
        $Clx = $Clx->update( ["active"=>"D"] );
        if( $Clx){  
            session()->flash('successo', 'Un Cliente se elimino');
            return redirect()->route("Cliente.index");
        }else{
            session()->flash('erroro', 'fallo el registro, intentelo de nuevo');
            return redirect()->route("Cliente.index");
        }
    }

    // ajax
    public function data(Request $request)
    {
        $Clx = cliente::where('Clx_Nombre', 'like', '%'.$request->all()["searchTerm"].'%')
                ->orWhere('Clx_Apellido', 'like', '%'.$request->all()["searchTerm"].'%')
                ->orWhere('Clx_RazonSocial', 'like', '%'.$request->all()["searchTerm"].'%') 
                ->limit(7)
                ->get(); 
        $valid_tags = [];
        
            foreach ($Clx  as $Cl) {
                if( $Cl->active == "A" ){
                    if($Cl->Clx_RazonSocial!=""){
                        $valid_tags[] = ['id' => $Cl->Clx_Id, 'text' =>  "Ruc =".$Cl->Clx_Ruc."-".$Cl->Clx_RazonSocial." | Nombres = ".$Cl->Clx_Nombre."-".$Cl->Clx_Apellido];
                    }
                    if($Cl->Clx_Nombre!=""){
                        $valid_tags[] = ['id' => $Cl->Clx_Id, 'text' =>  "Dni =".$Cl->Clx_Dni."-".$Cl->Clx_Nombre."-".$Cl->Clx_Apellido];
                    }
                }
            }
        
        
        echo json_encode($valid_tags);
    }

    public function datas(Request $request){
        if ($request->ajax()) {
            $model = cliente::where("active","A")->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($Data){
                    $msm = "estas segur@ que desea elminar este cliente";
                    $actionBtn = '
                    <a href="'.route("Cliente.show",$Data->Clx_Id).'" class="edit btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="'.route("Cliente.edit",$Data->Clx_Id).'" class="edit btn btn-success btn-sm"><i class="fas fa-edit"> </i></a> 
                    <a  class="edit btn  btn-xs">
                    <form method="POST"  id="formdeletecliente'.$Data->Clx_Id.'" action="'.route("Cliente.delete",$Data->Clx_Id).'">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit"  onclick="FormDelete(\'cliente'.$Data->Clx_Id.'\',\''.$msm.'\',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"> </i></button>
                     </form></a>
                    ';
                    return $actionBtn;
                }) 
                ->rawColumns(['action']) 
                ->make(true);
        }  
   }

   public function Igxs(Request $request){
    if ($request->ajax()) {
        $model = ingresos::select("*")
        ->join("metodo_pago","metodo_pago.Mpx_Id","=","ingresos.Mpx_Id")
        ->where("Clx_Id",$request->get("Clx_Id"))
        ->where("actives","A")->get();
        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn("monto",function($Data){
                return "S/ ".moneyformat($Data->Igx_Monto);
            })
            ->addColumn('action', function($Data){
                $msm = "estas segur@ que desea elminar este cliente";
                $actionBtn = '
                
                ';
                return $actionBtn;
            }) 
            ->rawColumns(['action']) 
            ->make(true);
     }  
    }

}

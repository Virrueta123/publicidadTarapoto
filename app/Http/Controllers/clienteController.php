<?php

namespace App\Http\Controllers;

use App\Models\cliente;
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
    public function store(Request $request)
    {
        //
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
        return View($this->ruta."show",["Clx"=>$Clx]);
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
            if($Cl->Clx_RazonSocial!=""){
                $valid_tags[] = ['id' => $Cl->Clx_Id, 'text' =>  "Ruc =".$Cl->Clx_Ruc."-".$Cl->Clx_RazonSocial." | Nombres = ".$Cl->Clx_Nombre."-".$Cl->Clx_Apellido];
            }
            if($Cl->Clx_Nombre!=""){
                $valid_tags[] = ['id' => $Cl->Clx_Id, 'text' =>  "Dni =".$Cl->Clx_Dni."-".$Cl->Clx_Nombre."-".$Cl->Clx_Apellido];
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
                    $actionBtn = '
                    <a href="'.route("Cliente.show",$Data->Clx_Id).'" class="edit btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
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

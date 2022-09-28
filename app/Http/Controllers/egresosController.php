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
            $model = egresos::where("active","A")->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
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

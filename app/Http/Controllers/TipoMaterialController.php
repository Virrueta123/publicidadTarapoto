<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class TipoMaterialController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View("modules.TipoMaterial.index");
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
            $model = TipoMaterial::where("active","A")->get();
            return Datatables::of($model)
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

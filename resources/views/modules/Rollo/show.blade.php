@extends('layouts.admin')

@section('name')
    Rollo
@endsection
@section('content') 


<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row  ">
      <div class="col-12 ">
        <h4 class="text-primary">
          <i class="fa-solid fa-scroll"></i> Rollo {{$show->Rox_Cod}} 
        </h4>
          <button class="btn btn-tool bg-info text-info float-right" title="Collapse" data-toggle="modal" data-target="#modal-ingreso">
            <i class="fas fa-plus text-white"> </i> <span>Agregar Ingresos</span> 
          </button>  
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Nombre del material
        <address>
          <strong>{{$show->Mx_Nombre}} </strong> 
        </address>
      </div>  
      <div class="col-sm-4 invoice-col">
        Tipo de material
        <address>
          <strong>{{$show->Tmx_Nombre}} </strong> 
        </address>
      </div>  
    </div>


    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Ancho
        <address>
          <strong>{{$show->Rox_Ancho}} centimetros </strong><br> 
        </address>
      </div>
      
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Longitud Inicial
        <address>
          <strong>{{$show->Rox_Longitud}} metros</strong><br>
         
        </address>
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Longitud Usado
        <address>
          <strong>0 mm usados</strong><br>
          
        </address>
      </div>
      <!-- /.col -->
       
    </div>
    <!-- /.row -->
    <h2 class="text-blue">Todo los ingresos del Rollo</h2>
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Cliente</th>
            <th>Descripcion</th>
            <th>Longitud actual</th>
            <th>Longitud gastado</th> 
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>Call of Duty</td>
            <td>455-981-221</td>
            <td>El snort testosterone trophy driving gloves handsome</td> 
          </tr> 
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div> 
 
  </div>
  
 
@endsection
@extends('layouts.admin')

@section('name')
    Material
@endsection
@section('content') 


<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row  ">
      <div class="col-12 ">
        <h4 class="text-primary">
          <i class="fa-solid fa-clone"></i> {{ $show->Mx_Nombre }} 
        </h4>
          <a href="{{ route("Rollo.create",$cod) }}" class="btn btn-tool bg-info text-info float-right" title="Collapse">
            <i class="fas fa-plus text-white"> </i> <span>Agregar Rollo</span> 
          </a> 
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Ancho
        <address>
          <strong>{{ $show->Mx_Ancho }} metros</strong><br> 
        </address>
      </div>
      
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Longitud | altura
        <address>
          <strong>{{ $show->Mx_Longitud }} metros</strong><br>
         
        </address>
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Tipo de material
        <address>
          <strong>{{ $show->Tmx_Nombre }} </strong><br>
          
        </address>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row -->
    <h2 class="text-blue">Rollos</h2>
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead class="text-center">
          <tr>
            <th>Codigo</th> 
            <th>Longitud actual</th>
            <th>Longitud gastado</th>
            <th>Nº Diseños Impresos</th> 
            <th>Ope</th>
          </tr>
          </thead>
          <tbody class="text-center">
            @foreach ( $rollos as $rx )
              <tr>
                <td>Rox{{ $rx->cod }}</td>
                
                @if ($rx->total =="false")
                  <td>no gastado</td>
                @else
                  <td>{{ $rx->total }} metros</td>
                @endif
                
                @if ($rx->descuentoRollo =="false")
                  <td>no gastado</td>
                @else
                <td>{{ $rx->descuentoRollo }} metros</td>
                @endif 
                <td>{{ $rx->ds}}</td>
                <td>
                  @if ($rx->ds > 0)
                    <a href="{{ route("Rollo.show",$rx->cod) }}" class="edit btn btn-warning btn-sm"><i class="far fa-eye"> </i></a>
                  @else
                    <a href="{{ route("Rollo.show",$rx->cod) }}" class="edit btn btn-warning btn-sm"><i class="far fa-eye"> </i></a>
                    <a href="javascript:void(0)" class="edit btn btn-success btn-sm"><i class="fas fa-edit"> </i></a> 
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"> </i></a>
                  @endif 
                </td> 
              </tr> 
            @endforeach 
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div> 
    
    @if (count($rollos)=="0")
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="fa-regular fa-empty-set"></i> No hay ningun Rollo!</h5>
        <a href="{{ route("Rollo.create",$cod) }}" class="btn btn-tool bg-white text-info" title="agregar">
            <i class="fas fa-plus text-info"> </i> <span>Agregar un Rollo</span> 
        </a> 
      </div>
      <!-- /.row --> 
    @endif
    
  </div>
@endsection
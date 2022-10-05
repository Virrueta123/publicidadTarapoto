@extends('layouts.admin')

@section('name')
   Reporte entre fecha 
@endsection
@section('content') 
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Elige dos fechas</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formTipoEgresos" method="POST" action="{{ route("Reporte.betweenSearch") }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label>Fecha Inicio  </label>
                        <div class="input-group mb-3">
                            @if ( $FechaI != "" )
                                <input type="date" value="{{ $FechaI }}" name="FechaI" class="form-control form-control-border" >
                            @else
                                <input type="date" name="FechaI" class="form-control form-control-border" >
                            @endif
                            
                        </div>
                    </div> 
                    <div class="form-group col-6">
                        <label>Fecha Final  </label>
                        <div class="input-group mb-3">
                            @if ( $FechaF != "" )
                                <input type="date" value="{{ $FechaF }}" name="FechaF" class="form-control form-control-border" >
                            @else
                                <input type="date" name="FechaF" class="form-control form-control-border" >
                            @endif
                        </div>
                    </div> 
                </div> 
            </div> 
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Buscar</button>
              <a href="{{ URL::previous() }}" class="btn btn-danger">Retroceder</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
 
      </div>
      
    </div>
    <!-- /.row -->
  </div>
    
@if ( $isSearch )
  <div class="card  bg-blue">
    <div class="card-header " >
       
        <div class="col-12 text-center">
          <h1> Ganacias </h1> 
        </div>
       
    </div>
    <!-- /.card-header -->
    <div class="card-body ">
    <div class="row text-center">
      <div class="col-12 ">
        <h1>S/ {{ $reporteGlobal["ganaciaTotal"] }}</h1>
      </div>
      <div class="col-6 ">
        <i class="fa-solid fa-piggy-bank" style="opacity: .6;"></i> S/ {{ $reporteGlobal["gananciaEfectivo"] }}
      </div>
      <div class="col-6 ">
        <i class="fa-solid fa-credit-card" style="opacity: .6;"></i> S/ {{ $reporteGlobal["gananciaTarjeta"] }}
      </div>
    </div>
  </div>
  </div>
  
  <div class="row"> 
    <div class="col-6 text-success">
       
        <div class="card  bg-success">
          <div class="card-header " >
            
              <div class="col-12 text-center">
                <h3> Ingresos Total Del mes </h3> 
              </div>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body "> 
          <div class="row text-center">
            <div class="col-12 ">
              <h1>S/ {{ $reporteGlobal["IgxTotalG"] }}</h1>
            </div>
            <div class="col-6">
              <i class="fa-solid fa-piggy-bank" style="opacity: .6;"></i> S/ {{ $reporteGlobal["IgxEfectivoG"] }}
            </div>
            <div class="col-6">
              <i class="fa-solid fa-credit-card" style="opacity: .6;"></i> S/ {{ $reporteGlobal["IgxTarjetaG"] }}
            </div>
          </div>
        </div>
        </div>
  
    </div>
    <div class="col-6 text-success">
        
        <div class="card  bg-danger">
          <div class="card-header " >
            
              <div class="col-12 text-center">
                <h3> Egresos Total Del mes </h3> 
              </div>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body ">
          <div class="row text-center">
            <div class="col-12 ">
              <h1>S/ {{ $reporteGlobal["EgxTotalG"] }}</h1>
            </div>
            <div class="col-6 ">
              <i class="fa-solid fa-piggy-bank" style="opacity: .6;"></i> S/ {{ $reporteGlobal["EgxEfectivoG"] }}
            </div>
            <div class="col-6 ">
              <i class="fa-solid fa-credit-card" style="opacity: .6;"></i> S/ {{ $reporteGlobal["EgxTarjetaG"] }}
            </div>
          </div>
        </div>
        </div>
  
    </div>
  </div>
    
          <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Reporte de mes de octubre</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-sm table-report">
                    <thead class="text-center">
                      <tr>
                        <th class="text-primary">Fecha</th>
                        <th class="text-success">Ingresos</th>
                        <th class="text-warning">Egresos</th> 
                        <th> Ver </th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      
                      @forelse ($reporte as $rp)
                        <tr>
                          <td   class="text-center" style="vertical-align : middle;text-align:center;">{{ $rp["fecha"] }}</td>
                          <td>
                            <div class="row">
                              <div class="col-12 bg-success">
                                S/ {{ $rp["IgxTotal"] }}
                              </div>
                              <div class="col-6 text-success">
                                <i class="fa-solid fa-piggy-bank" style="opacity: .6;"></i> S/ {{ $rp["IgxEfectivo"] }}
                              </div>
                              <div class="col-6 text-success">
                                <i class="fa-solid fa-credit-card"></i> S/ {{ $rp["IgxTarjeta"] }}
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="row">
                              <div class="col-12 bg-danger">
                                S/ {{ $rp["EgxTotal"] }}
                              </div>
                              <div class="col-6 text-danger">
                                <i class="fa-solid fa-piggy-bank" style="opacity: .6;"></i> S/ {{ $rp["EgxEfectivo"] }}
                              </div>
                              <div class="col-6 text-danger">
                                <i class="fa-solid fa-credit-card"></i> S/ {{ $rp["EgxTarjeta"] }}
                              </div>
                            </div>
                          </td>
                           
                          <td  class="text-center" style="vertical-align : middle;text-align:center;">
                            <a href="{{ route("Reporte.ShowFecha",$rp["fecha"]) }}" class="btn btn-warning btn-xs"> <i class="fa fa-eye"></i> ver fecha</a>
                          </td>
                        </tr> 
                      @empty
                          
                      @endforelse
                      
                     
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div> 
        @endif
@endsection

@section("script")
 
@endsection 

@section("js")
    <script>
    $(function () {
        
        $( "#formTipoEgresos" ).validate({
            rules: {
                Mpx_Nombre: {
                    required: true,
                    maxlength: 100
                } 
            } 
        });       
        
    });
          
    </script>
@endsection

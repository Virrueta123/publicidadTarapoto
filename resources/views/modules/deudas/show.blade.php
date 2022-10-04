@extends('layouts.admin')

@section('name')
    Deuda 
@endsection
@section('content') 


<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row  ">
      <div class="col-12 ">
        <h4 class="text-primary">
            @if ($dex->Clx_RazonSocial != "" )
                <i class="fa-solid fa-user-circle"></i> {{ limite_texto($dex->Clx_RazonSocial,50) }}
            @else
                <i class="fa-solid fa-person-booth"></i> {{ limite_texto($dex->Clx_Nombre." | ".$dex->Clx_Apellido,50) }}   
            @endif  
        </h4>
           
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-3 invoice-col">
        Costo total de la impresion
        <address>
          <strong> S/ {{ moneyformat($dex->Dex_Total) }} </strong><br> 
        </address>
      </div>
      
      <!-- /.col -->
      <div class="col-sm-3 invoice-col">
        Amortizado
        <address>
          <strong> S/ {{ moneyformat($dex->Dex_Amortizado) }}  </strong><br>
         
        </address>
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-sm-3 invoice-col">
        deuda pendiente
        <address>
          <strong> S/ {{ moneyformat($dex->Dex_Deuda) }} </strong><br>
          
        </address>
      </div>

      <div class="col-sm-3 invoice-col">
        dias transcurridos
        <address>
          <strong>  {{ $fechaHuman }} dias</strong><br> 
        </address>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row -->  
  </div>

  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Ingreso </h3>

          <div class="card-tools">
            {{-- <a href="{{ route("Cliente.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
              <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
            </a>  --}}
          </div>
        </div>
        <div class="card-body p-0 "> 
            <div class="table-responsive"> 
              <table id="ingresoCliente" class="table table-bordered table-striped">
                  <thead>
                      <tr> 
                          <th>Descripcion</th> 
                          <th>Fecha</th> 
                          <th>Monto</th>
                          <th>M-Pago</th>  
                      </tr>
                  </thead>
                  <tbody>
                    <tr> 
                        <td>{{ $dex->Igx_Descripcion }}</td> 
                        <td>{{ $dex->Igx_Fecha }}</td> 
                        <td>{{ moneyformat($dex->Igx_Monto) }}</td>
                        <td>{{ $dex->Mpx_Nombre }}</td>  
                    </tr>
                  </tbody>
              </table>
            </div>
        </div>
         
         
      </div>
      <!-- /.card -->
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pagar deuda</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formTipoEgresos" method="POST" action="{{ route("Deudas.pay",$dex->Dex_Id) }}">
            @csrf
            <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                        <label for="Mpx_Deuda">Monto deuda <code>*obligatorio</code>  </label>
                        <input type="number" name="Mpx_Deuda" class="form-control form-control-border" id="Mpx_Deuda"  >
                </div> 
              </div> 
              <div class="col-sm-6">
                <div class="form-group mb-6 group-symbol">  
                    <label for="Mpx_Id">Metodo de pago  </label>
                    <select name="Mpx_Id" class="custom-select form-control-border border-width-2" >
                        @foreach ($Mpxs as $Mpx) 
                            @if($Mpx->Mpx_Nombre=="efectivo")
                            <option selected value="{{ $Mpx->Mpx_Id }}">{{ $Mpx->Mpx_Nombre }}</option>
                            @else
                            <option value="{{ $Mpx->Mpx_Id }}">{{ $Mpx->Mpx_Nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                 </div>
                </div>
            </div>
            </div> 
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Registrar</button>
              <a href="{{ route("home") }}" class="btn btn-danger">Retroceder</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
 
      </div>
      
    </div>
    <!-- /.row -->
  </div>
@endsection
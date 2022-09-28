@extends('layouts.admin')

@section('name')
     Creando un nuevo Rollo
@endsection
@section('content')
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row  ">
    <div class="col-12 ">
      <h4 class="text-primary">
        <i class="fa-solid fa-clone"></i> {{ $showMx->Mx_Nombre }}
      </h4> 
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      Ancho
      <address>
        <strong>{{ $showMx->Mx_Ancho }} metros</strong><br> 
      </address>
    </div>
    
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      Longitud | altura
      <address>
        <strong>{{ $showMx->Mx_Longitud }} metros</strong><br>
       
      </address>
    </div>
    <!-- /.col -->

    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      Tipo de material
      <address>
        <strong>{{ $showMx->Tmx_Nombre }} </strong><br>
        
      </address>
    </div>
    <!-- /.col --> 
  </div>
</div> 
 
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Crear un Rollo</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formRollo" method="POST" action="{{ route("Rollo.store",$cod) }}">
            @csrf
            <div class="card-body">
             
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group mb-6 ">
                    <label for="Rox_Monto">Costo del rollo <code>*obligatorio</code> <code class="text-info">Medida en cm</code></label>
                    <input type="number" name="Rox_Monto" class="form-control form-control-border" id="Rox_Monto"  > 
                     
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-6 group-symbol">
                        <label for="Rox_Precio">Costo por mm <code>*obligatorio</code> </label>
                        <input type="number" name="Rox_Precio" class="form-control form-control-border" id="Rox_Precio"  > 
                        <span class="input-symbol">mm</span> 
                      </div>
                </div>
              </div>
              <p>EL codigo del rollo cuando este creado sera <strong>{{ $codRollo }}</strong> </p>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Crear Rollo</button>
              <a href="{{ route("Material.show",$cod) }}" class="btn btn-danger">Retroceder</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
 
      </div>
      
    </div>
    <!-- /.row -->
 
   
  </div>

@endsection

@section("script")
 
@endsection 

@section("js")
    <script>
    $(function () {
        
        $( "#formRollo" ).validate({
            rules: {
                Rox_Precio:{
                    required: true,
                    number:true
                },
                Rox_Monto:{
                    required: true,
                    number:true
                },
                Rox_Longitud:{
                    required: true,
                    number:true
                },
                Rox_Ancho: {
                    required: true,
                    number:true
                } 
            } 
        });       
        
    });
          
    </script>
@endsection

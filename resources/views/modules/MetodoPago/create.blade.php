@extends('layouts.admin')

@section('name')
    Registro
@endsection
@section('content') 
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Crear un Metodo de Pago</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formTipoEgresos" method="POST" action="{{ route("MetodoPago.store") }}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                    <label for="Mpx_Nombre">Nombre <code>*obligatorio</code> 100 caracteres </label>
                    <input type="text" name="Mpx_Nombre" class="form-control form-control-border" id="Mpx_Nombre"  >
              </div> 
               
            </div> 
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Registrar</button>
              <a href="{{ route("MetodoPago.index") }}" class="btn btn-danger">Retroceder</a>
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

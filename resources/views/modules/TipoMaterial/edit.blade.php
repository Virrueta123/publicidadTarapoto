@extends('layouts.admin')

@section('name')
    Editar
@endsection
@section('content') 
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Editar un Tipo de material</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formTipoEgresos" method="POST" action="{{ route("TipoMaterial.update",$Tmx->Tmx_Id) }}">
            @csrf
            @method("PATCH")
            <div class="card-body">
              <div class="form-group">
                    <label for="Tmx_Nombre">Nombre del tipo de material <code>*obligatorio</code> 150 caracteres </label>
                    <input type="text" value="{{  $Tmx->Tmx_Nombre }}" name="Tmx_Nombre" class="form-control form-control-border" id="Tmx_Nombre"  >
              </div> 
               
            </div> 
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Registrar</button>
              <a href="{{ route("TipoMaterial.index") }}" class="btn btn-danger">Retroceder</a>
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
                Tmx_Nombre: {
                    required: true,
                    maxlength: 100
                } 
            } 
        });       
        
    });
          
    </script>
@endsection

@extends('layouts.admin')

@section('name')
    Tipo de egreso
@endsection
@section('content') 
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Crear un Tipo de egreso</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formTipoEgresos" method="POST" action="{{ route("TipoEgresos.store") }}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                    <label for="Tex_Desc">Descripcion <code>*obligatorio</code> 150 caracteres </label>
                    <input type="text" name="Tex_Desc" class="form-control form-control-border" id="Tex_Desc"  >
              </div> 
              <div class="form-group">
                <label for="Tex_Alias">Alias <code>*obligatorio</code> 20 caracteres </label>
                <input type="text" name="Tex_Alias" class="form-control form-control-border" id="Tex_Alias"  >
              </div> 
            </div> 
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Registrar</button>
              <a href="{{ route("Material.index") }}" class="btn btn-danger">Retroceder</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
 
      </div>
      
    </div>
    <!-- /.row -->
  </div>
   
  </div>

@endsection

@section("script")
 
@endsection 

@section("js")
    <script>
    $(function () {
        
        $( "#formTipoEgresos" ).validate({
            rules: {
                Tex_Desc: {
                    required: true,
                    maxlength: 149
                },
                Tex_Alias:{
                    required: true,
                    maxlength: 20
                } 
            } 
        });       
        
    });
          
    </script>
@endsection

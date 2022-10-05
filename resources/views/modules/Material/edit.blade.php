@extends('layouts.admin')

@section('name')
     Material
@endsection
@section('content')
 

<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Crear un material</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formMateriales" method="POST" action="{{ route("Material.update",$Mx->Mx_Id) }}">
            @csrf
            @method("PATCH")
            <div class="card-body">
              <div class="form-group">
                    <label for="Mx_Nombre">Nombre del material <code>*obligatorio</code></label>
                    <input type="text" value="{{ $Mx->Mx_Nombre }}" name="Mx_Nombre" class="form-control form-control-border" id="Mx_Nombre"  >
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group mb-6 group-symbol">
                    <label for="Mx_Ancho">Ancho del materia <code>*obligatorio</code> <code class="text-info">medida en Metros</code></label>
                    <input type="number" value="{{ $Mx->Mx_Ancho }}" name="Mx_Ancho" class="form-control form-control-border" id="Mx_Ancho"  > 
                    <span class="input-symbol">metros</span> 
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-6 group-symbol">
                        <label for="Mx_Longitud">Largo del materia <code>*obligatorio</code> <code class="text-info">medida en metros</code></label>
                        <input type="number" value="{{ $Mx->Mx_Longitud }}" name="Mx_Longitud" class="form-control form-control-border" id="Mx_Longitud"  > 
                        <span class="input-symbol">metros</span> 
                      </div>
                </div>
              </div>
              <div class="form-group">
                    <label for="Tmxs">Tipo de material <code>*obligatorio</code></label>
                    <select name="Tmxs" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                        <option value="">Seleciona</option> 
                        @foreach ($Tmxs as $Tmx)
                            @if ($Tmx->Tmx_Id == $Mx->Tmx_Id)
                            <option  selected  value="{{ $Tmx->Tmx_Id }}">{{ $Tmx->Tmx_Nombre }}</option>
                            @else
                            <option  value="{{ $Tmx->Tmx_Id }}">{{ $Tmx->Tmx_Nombre }}</option>
                            @endif 
                        @endforeach
                    </select>
              </div>
              
            </div>
 
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
        
        $( "#formMateriales" ).validate({
            rules: {
                Mx_Ancho: {
                    required: true,
                    number:true
                },
                Mx_Longitud:{
                    required: true,
                    number:true
                },
                Mx_Nombre: {
                    required: true,
                    maxlength: 149,
                },
                Tmxs: {
                    required: true 
                }
            } 
        });       
        
    });
          
    </script>
@endsection

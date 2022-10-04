@extends('layouts.admin')

@section('name')
    Egreso
@endsection
@section('content')
 

<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Crear un Egreso</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formEgresos" method="POST" action="{{ route("Egresos.update",$Egx->Egx_Id) }}">
            @csrf
            @method("PATCH")
            <div class="card-body">
              <div class="form-group">
                    <label for="Egx_Desc">Descripcion <code>*obligatorio</code></label>
                    <input type="text" name="Egx_Desc" value="{{ $Egx->Egx_Desc }}" class="form-control form-control-border"    >
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group mb-6 group-symbol">
                    <label for="Egx_Monto">Monto <code>*obligatorio</code></label>
                    <input type="number" name="Egx_Monto" value="{{ $Egx->Egx_Monto }}" class="form-control form-control-border" id="Egx_Monto"  > 
                    <span class="input-symbol">Cm</span> 
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-6 group-symbol">  
                        <label for="Mpx_Id">Metodo de pago  </label>
                        <select name="Mpx_Id" class="custom-select form-control-border border-width-2" >
                            @foreach ($Mpxs as $Mpx) 
                                
                                <option  {{$Mpx->Mpx_Id == $Egx->Mpx_Id  ? '' : 'selected'}} value="{{ $Mpx->Mpx_Id }}">{{ $Mpx->Mpx_Nombre }}</option>
                       
                            @endforeach
                        </select>
                     </div>
                </div>
              </div>

              <div class="form-group">
                    <label for="Tpx_Id"> Tipo de egreso<code>*obligatorio</code></label>
                    <select name="Tpx_Id" class="custom-select form-control-border border-width-2" >
                     
                        @foreach ($Texs as $Tex)
                            <option {{$Tex->Tex_Id == $Egx->Tex_Id  ? '' : 'selected'}} value="{{ $Tex->Tex_Id }}">{{ $Tex->Tex_Alias }}</option>
                        @endforeach
                    </select>
              </div> 
            </div> 

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Registrar</button>
              <a href="{{ route("Egresos.index") }}" class="btn btn-danger">Retroceder</a>
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
        
        $("#formEgresos").validate({
            rules: {
                Egx_Desc: {
                    required: true,
                    maxlength: 149
                },
                Egx_Monto:{
                    required: true,
                    maxlength: 12,
                    number: true
                },
                Tpx_Id:{
                    required: true
                } 
            } 
        });       
        
    });
          
    </script>
@endsection

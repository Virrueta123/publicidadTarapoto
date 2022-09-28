@extends('layouts.admin')

@section('name')
    Editar Pendientes
@endsection
@section('history') 
    <li class="breadcrumb-item active"><a href="{{ route("Pendientes.index") }}">Pendientes</a></li>
    <li class="breadcrumb-item active">Editar registro</li>
@endsection
@section('content') 
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Editar</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formPedientes" method="POST" action="{{ route("Pendientes.update",$Pex->Pex_Id) }}">
            @csrf
            @method("PATCH")
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label>Descripcion  <code>180 caracteres</code></label>
                        <div class="input-group mb-3">
                            <textarea class="form-control"  name="Pex_Desc" rows="3" placeholder="ecribir ...">{{ $Pex->Pex_Desc }}</textarea>
                        </div>
                     </div> 
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label>Cliente</label>
                        <div class="input-group mb-3">
                            <select name="Clx_Id" value="{{ $Pex->Clx_Id }}"  class="form-control select" id="cbxCliente"> 
                                <option value="{{ $cod }}" selected>{{$cliente}}</option> 
                            </select>
                        </div>
                     </div> 
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label>Fecha del trabajo pendiente</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="{{ $Pex->Pex_Fecha }}" name="Pex_Fecha">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                     </div> 
                </div>
            </div> 
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Editar</button>
              <a href="{{ route("Pendientes.index") }}" class="btn btn-danger">Retroceder</a>
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
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });  

        $("#cbxCliente").select2({
                placeholder: 'Busca el cliente',
                language: "es",
                ajax: {
                    type:"post",
                    url:"{{ route('Cliente.data') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function (response) {  
                        console.log(response)
                        return {
                            results:response
                        };
                    } 
                } 
        });


        $( "#formPedientes" ).validate({
            rules: {
                Pex_Desc: {
                    required: true,
                    maxlength: 180
                },
                Pex_Fecha: {
                    required: true,
                    date: true
                },
                Clx_Id:{
                    required: true
                } 
            } 
        });       
        
    });
          
    </script>
@endsection

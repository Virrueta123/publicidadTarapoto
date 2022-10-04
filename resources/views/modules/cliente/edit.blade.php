@extends('layouts.admin')

@section('name')
    Editar un Cliente
@endsection
@section('history')
    <li class="breadcrumb-item active"><a href="{{ route("Cliente.index") }}"></a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content') 
 
<div class=" modal-cliente" aria-hidden="false">
    <div class="modal-dialog  modal-lg" >
      <div class="modal-content" >
        <div class="modal-header">
          <h4 class="modal-title">editar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
           
          <div class="card-body" wire:ignore>
            <form action="{{ route("Cliente.update",$Clx->Clx_Id) }}" method="POST" id="formCliente">
             @csrf
             @method("PATCH")
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Numero de ruc</label>
                    <div class="input-group mb-3">
                      <input id="inputRuc" type="number" value="{{ $Clx->Clx_Ruc }}" name="Clx_Ruc" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" >
                      <div class="input-group-append">
                        <button type="button" id="btnRuc" class="btn btn-primary input-group-text"><i class="fa fa-sort-numeric-asc"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Numero de Dni</label>
                    <div class="input-group mb-3">
                      <input id="inputDni" type="number" name="Clx_Dni" value="{{ $Clx->Clx_Dni }}" class="form-control" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                      <div class="input-group-append">
                        <button type="button" id="btnDni" class="btn btn-primary input-group-text"><i class="fa fa-sort-numeric-asc"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{--  --}}
              <div class="row">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Razon social</label>
                    <div class="input-group mb-3">
                      <input  type="text" id="Clx_RazonSocial" name="Clx_RazonSocial" value="{{ $Clx->Clx_RazonSocial }}" class="form-control">
                      <div class="input-group-append">
                        <span  class="input-group-text"><i class="fa-solid fa-user-tie"></i></button>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
           {{--  --}}
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Nombre del cliente</label>
                    <div class="input-group mb-3">
                      <input  type="text" id="Clx_Nombre" name="Clx_Nombre" value="{{ $Clx->Clx_Nombre }}" class="form-control">
                      <div class="input-group-append">
                        <span  class="input-group-text"><i class="fa fa-user"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Apellido del cliente</label>
                    <div class="input-group mb-3">
                      <input  type="text" id="Clx_Apellido" name="Clx_Apellido" value="{{ $Clx->Clx_Apellido }}" class="form-control">
                      <div class="input-group-append">
                        <span  class="input-group-text"><i class="fa fa-user"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              {{--  --}}

              {{--  --}}
              <div class="row">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Direccion del cliente / negocio</label>
                    <div class="input-group mb-3">
                      <input  type="text" id="Clx_Direc" name="Clx_Direc" value="{{ $Clx->Clx_Direc }}" class="form-control">
                      <div class="input-group-append">
                        <span  class="input-group-text"><i class="fa fa-home"></i></button>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
           {{--  --}}

           {{--  --}}
           <div class="row">
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Celular</label>
                <div class="input-group mb-3">
                  <input  type="number" id="Clx_Cel" name="Clx_Cel" value="{{ $Clx->Clx_Cel}}" class="form-control">
                  <div class="input-group-append">
                    <span  class="input-group-text"><i class="fa fa-phone"></i></button>
                  </div>
                </div>
              </div>
            </div> 
          </div>
          <div class="modal-footer justify-content-between"> 
            <button type="submit" id="addCliente" class="btn btn-primary">Editar Cliente</button>
           </div>
            </form>
          </div>
        </div>
        
   </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div> 

@endsection

@section('js')
    <script>
         

        $("#formCliente").validate({
            ignore: ":hidden",
            rules: {
              Clx_Ruc: {
                number: true
              }, 
              Clx_Direc: {
                 number: false 
              }, 
              Clx_Cel: {
                  number: true
              },
              Clx_Dni: {
                  number: true
              } 
            } 
         });


      
    </script>
    
@endsection
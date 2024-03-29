@extends('layouts.admin')

@section('name')
    Deuda 
@endsection
@section('content') 

{{-- @if ($dex->Clx_RazonSocial != "" )
<i class="fa-solid fa-user-circle"></i> {{ limite_texto($Igx->Clx_RazonSocial,50) }}
@else
<i class="fa-solid fa-person-booth"></i> {{ limite_texto($Igx->Clx_Nombre." | ".$dex->Clx_Apellido,50) }}   
@endif --}}
 
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">editar un material</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="formIngreso" method="POST" action="{{ route("Ingresos.update",$Igx->Igx_Id) }}">
            @csrf
            @method("PATCH")
            <div class="card-body">
              <div class="form-group">
                    <label for="Igx_Descripcion">Descripcion <code>*obligatorio</code></label>
                    <input type="text" value="{{ $Igx->Igx_Descripcion }}" name="Igx_Descripcion" class="form-control form-control-border" id="Igx_Descripcion"  >
              </div>
               
              <div class="form-group">
                
                    <label for="Tmxs">CLiente <code>*obligatorio</code>  
                      <button type="button" class="m-1 btn btn-xs bg-info text-info float-right" title="Collapse" data-toggle="modal" data-target=".modal-cliente">
                        <i class="fas fa-plus text-white"> </i> <span>Agregar Cliente</span> 
                      </button>  </label>
                   
                    <select name="Clx_IdC" value="{{ $Igx->Clx_Id }}" class="form-control select" id="cbxCliente"> 
                       @if ($Igx->Clx_RazonSocial != "" )
                            <option value="{{ $Igx->Clx_Id }}" selected>{{ $Igx->Clx_RazonSocial }}</option> 
                       @else
                       <option value="{{ $Igx->Clx_Id }}" selected>{{ $Igx->Clx_Nombre." | ".$Igx->Clx_Apellido }}</option>  
                        @endif  
                    </select> 
                    <input type="hidden" name="Clx_Id" id="Clx_Id" value="0">
                    <div class="info-box col-12  bg-info" id="showCliente" style="display: none;">
                        <span class="info-box-icon"><i class="far fa-user"></i></span>
                      
                        <div class="info-box-content">
                          <h4 class="info-box-text" id="showClienteText" >cliente</h4> 
                        </div>
                        <button type="button" class="p-1 btn bg-info text-info" id="deleteCliente" >
                          <i class="fas fa-trash text-white"> </i>   
                        </button> 
                      <!-- /.info-box-content -->
                    </div>
              </div>
  
               
  
  
  
              <div id="medidas">
              <div class="row">
                <div class="col-sm-3">
                  <!-- text input -->
                  <div class="form-group mb-6 group-symbol">
                    <label for="Igx_Ancho">Ancho del Diseño </label>
                    <input type="number"  value="{{ $Igx->Igx_Ancho }}" name="Igx_Ancho" class="form-control form-control-border" id="Igx_Ancho"  > 
                    <span class="input-symbol">metros</span> 
                  </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-6 group-symbol">
                        <label for="Igx_Longitud">Alto del Diseño </label>
                        <input type="number" value="{{ $Igx->Igx_Largo }}" name="Igx_Longitud" class="form-control form-control-border" id="Igx_Longitud"  > 
                        <span class="input-symbol">metros</span> 
                      </div>
                </div>
                
                <div class="col-sm-6">
                  <div class="form-group mb-6 group-symbol">
                      <label for="Igx_LimiteL">Restante al imprimir largo</label>
                      <input type="number" value="{{ $Igx->Igx_LimiteD }}" name="Igx_LimiteL" class="form-control form-control-border" id="Igx_LimiteL"  > 
                      <span class="input-symbol">metros</span> 
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group mb-6 group-symbol" style="display: none;">
                      <label for="Igx_LimiteA">Restante al imprimir ancho </label>
                      <input type="number" value="{{ $Igx->Igx_LimiteC  }}" name="Igx_LimiteA" class="form-control form-control-border" id="Igx_LimiteA"  > 
                      <span class="input-symbol">metros</span> 
                  </div>
                </div>
              </div> 
             
           
                
                {{-- <div class="col-12">
                    
                  <div class="row justify-content-center"> 
                        <div class="col-6"><button type="button" id="btnRolloSearch" class="btn col-12 btn-info">Buscar un rollo por codigo <i class="fa fa-search"></i></button></div>
                  </div> 
  
                 </div> 
                </div> --}}
  
               <hr>
  
               <div class="row" style="display: none" id="panelRollo">
                <div class="col-sm-12"> 
                  <div class="row justify-content-center">
                   <button type="button" id="btnClosePanel" class="btn btn-info m-1" > Cerrar para consultar otros rollos</button> 
                  </div>
                </div>
                <div class="col-sm-6"> 
                  <input type="hidden" id="Igx_Orientacion" value="V" name="Igx_Orientacion">
                  <input type="hidden" id="Rox_Id" value="{{ $Igx->Rox_Cod  }}" name="Rox_Id">
                  <div id="showDesignVertical" style="display: none;">
                   @include('modules.ingresos.showDesignVertical')
                  </div>
                  <div id="showDesignHorizontal" style="display: none;">
                   @include('modules.ingresos.showDesignHorizontal')
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-6">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Numero rollo</b> 
                              <p class="float-right text-danger" id="nrollo">101</p>  
                            </li>
                             
                          </ul>
                      </div>
                      <div class="col-6">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b> ancho sobrante </b> 
                                <p class="float-right text-danger" id="srollo">No se registro</p>
   
                            </li> 
                          </ul>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-12" >
                       
                        <div class="progress-group">
                          Rollo actual
                          <span class="float-right" id="ra"><b>largo de inicio </b>/ largo actual - %</span>
                          <div class="progress progress-sm" id="rap">
                            <div class="progress-bar bg-success" style="width:60%"></div>
                          </div>
                        </div>
                         
                      </div> 
                  </div>
  
                  <div class="row">
                    <div class="col-12" >
                       
                        <div class="progress-group">
                          Rollo despues de imprimir
                          <span class="float-right" id="rad"><b>largo de inicio </b>/ largo actual - %</span>
                          <div class="progress progress-sm" id="rapd">
                            <div class="progress-bar bg-success" style="width:60%"></div>
                          </div>
                        </div>
                         
                      </div> 
                  </div>
  
                </div>
                 
              </div> 
              
  
                <div class="row">
                  <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group mb-6 group-symbol">
                      <label >Monto Total <span id="deuda" class="badge badge-danger" style="display: none;">Se realizara una deuda a este cliente</span> </label>
                      <input type="number" id="MontoTotal" value="{{ $Igx->Igx_Monto  }}" name="Igx_Monto" class="form-control form-control-border" >  
                    </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group mb-6 group-symbol">
                          <label for="Amortizacion">Amortizacion </label>
                          <input type="number" value="{{ $Igx->Igx_Monto  }}" name="Amortizacion" class="form-control form-control-border" id="Amortizacion"  > 
                          
                        </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group mb-6 ">
                       <label >Metodo de pago </label>
                       <select name="Mpx_Id" id="" class="form-control form-control-border"> 
                        @foreach ($Mpxs as $Mpx) 
                                @if ($Mpx->Mpx_Id == $Igx->Mpx_Id)
                                <option selected  value="{{ $Mpx->Mpx_Id }}">{{ $Mpx->Mpx_Nombre }}</option>
                                @else
                                <option value="{{ $Mpx->Mpx_Id }}">{{ $Mpx->Mpx_Nombre }}</option>
                                @endif 
                        @endforeach 
                       </select>
                        
                      </div>
                   </div>

                   <div class="col-sm-3">
                    <div class="form-group mb-6 ">
                       <label >Fecha </label>
                       <input type="date" value="{{ $Igx->Igx_Fecha  }}" name="Igx_Fecha" class="form-control form-control-border"   > 
                        
                      </div>
                   </div>
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
  
   {{-- modal cliente --}}
   
   <div class="modal fade modal-cliente" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ingreso rollo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          <livewire:cliente-add />
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
        <button type="button" id="addCliente" class="btn btn-primary">Crear Cliente</button>
    </div>
   </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div> 
  @endsection
  
  
  
  @section("script")
  
  @endsection 
  
  @section("js")
      <script>
      
      $("#Rg").change(function (e) { 
        $("#Igx_Ancho").val(0); 
        $("#Igx_Longitud").val(0);
        $("#Igx_LimiteA").val(0);
        $("#Igx_LimiteL").val(0);   
        $("#medidas").fadeOut()
        $("#IsGastado").fadeIn()
      });
  
      $("#Rno").change(function (e) { 
       
        $("#medidas").fadeIn()
        $("#IsGastado").fadeOut()
      });
  
  
  
      $("#MontoTotal").keyup(function (e) {  
          $("#Amortizacion").val(e.target.value)
      });
      
      $("#Amortizacion").keyup(function (e) { 
  
         console.log(e.target.value)
         if( $("#Amortizacion").val() > $("#MontoTotal").val() ){
           $("#deuda").fadeOut();
         }else{
           $("#deuda").fadeIn();
         }
         if( $("#Amortizacion").val() > $("#MontoTotal").val() ){
          // $("#Amortizacion").val($("#MontoTotal").val())
          // $("#deuda").fadeOut();
         }
      });
  
      $(function () {  
          $( "#formIngreso" ).validate({
              rules: {
                  Clx_IdC: {
                      required: true,
                      number:true
                  },
                  Igx_Descripcion: {
                      required: true 
                  },
                  Igx_Monto: {
                      required: true,
                      number:true 
                  },
                  Amortizacion: {
                      required: true,
                      number:true
                  } 
              } ,
              submitHandler: function(form) {
                console.log(form)
                var Rox_Id = $("#Rox_Id").val()
                if(Rox_Id==""){
                  sweetAlert("Para continuar con el registro elegir un rollo","warning",3000)
                  return false;
                }else{
                  return true;
                }
              }
          });       
          
      });
  
      $.ajaxSetup({
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });  
      $("#cbxCliente").change(function (e) { 
        console.log(e.target.value)
        $("#cbxCliente").val(e.target.value)
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
          
      $("#cod").select2({
                  placeholder: 'Busca rollo gastado',
                  language: "es",
                  ajax: {
                      type:"post",
                      url:"{{ route('Rollo.cbx') }}",
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
  
      
      $("#cod").change(function (e) {  
          $("#Rox_Id").val(e.target.value)
          console.log("--"+e.target.value)
      });
  
      </script>
      @stack('scripts')
      @stack('scriptConsultarRollo') 
  @endsection
  
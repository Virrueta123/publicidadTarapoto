
          <div class="card-body" wire:ignore>
            <form action="#" method="POST" id="formCliente">
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Numero de ruc</label>
                    <div class="input-group mb-3">
                      <input id="inputRuc" type="number" name="Clx_Ruc" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" >
                      <div class="input-group-append">
                        <button type="button" id="btnRuc" class="btn btn-primary input-group-text"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Numero de Dni</label>
                    <div class="input-group mb-3">
                      <input id="inputDni" type="number" name="Clx_Dni" class="form-control" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                      <div class="input-group-append">
                        <button type="button" id="btnDni" class="btn btn-primary input-group-text"><i class="fa fa-search"></i></button>
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
                      <input  type="text" id="Clx_RazonSocial" name="Clx_RazonSocial"  class="form-control">
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
                      <input  type="text" id="Clx_Nombre" name="Clx_Nombre"  class="form-control">
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
                      <input  type="text" id="Clx_Apellido" name="Clx_Apellido"  class="form-control">
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
                      <input  type="text" id="Clx_Direc" name="Clx_Direc"  class="form-control">
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
                  <input  type="number" id="Clx_Cel" name="Clx_Cel"  class="form-control">
                  <div class="input-group-append">
                    <span  class="input-group-text"><i class="fa fa-phone"></i></button>
                  </div>
                </div>
              </div>
            </div> 
          </div>
           
            </form>
          </div>

          
        
 
  @push('scripts')
    <script>
      document.addEventListener('livewire:load', function() {
        // button consultar ruc
        $("#btnRuc").click(function (e) { 
            var valueRuc = $("#inputRuc").val(); 
            var valueDni = $("#inputDni").val(); 
            if(valueRuc==""){
              $("#inputRuc")
              .closest(".form-control")
		          .addClass("is-invalid") 
              sweetAlert("Ingrese valores en el campo RUC","warning")
            }else{
              $("#inputRuc")
              .closest(".form-control")
		          .removeClass("is-invalid")
		          .addClass("is-valid")
              if( valueRuc.length == 11 ){
                $(".modal-cliente").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos de SUNAT" }); 
                @this.consultaRuc(valueRuc).then(function(result){
                  
                  if(result.error){ 
                    sweetAlert(result.error,"warning")
                  }else{
                    $("#inputRuc").val(result.numeroDocumento)
                    $("#Clx_Direc").val(result.direccion)
                    $("#Clx_RazonSocial").val(result.nombre)
                    $("#inputDni").val(valueDni)
                    $(".modal-cliente").unblock()
                  } 
                  console.log(result)
                }).catch((err) => {
                  console.log(err)
                });
              }else{
                sweetAlert("el campo RUC tiene que tener 11 digitos","warning")
              } 
            }
            
        });

         // button consultar Dni
         $("#btnDni").click(function (e) { 
            var valueDni = $("#inputDni").val(); 
            var valueRuc = $("#inputRuc").val(); 
            if(valueDni==""){
              $("#inputDni")
              .closest(".form-control")
		          .addClass("is-invalid") 
              sweetAlert("Ingrese valores en el campo DNI","warning")
            }else{
              $("#inputDni")
              .closest(".form-control")
		          .removeClass("is-invalid")
		          .addClass("is-valid")
              if( valueDni.length == 8 ){
                $(".modal-cliente").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos" }); 
                @this.consultaDni(valueDni).then(function(result){
                  Data = JSON.parse(result) 
                  console.log(Data.tipo)
                  if(Data.tipo == "success"){ 
                    console.log(Data)
                     $("#Clx_Nombre").val(Data.mensaje.nombres)
                     $("#Clx_Apellido").val(Data.mensaje.apellidoPaterno+" "+ Data.mensaje.apellidoMaterno)
                     $("#inputDni").val(Data.mensaje.dni)
                     $("#inputRuc").val(valueRuc)
                     $(".modal-cliente").unblock()
                  }else{
                    sweetAlert(Data.mensaje,"warning") 
                    $(".modal-cliente").unblock()
                  } 
                }).catch((err) => {
                  sweetAlert("error no se puede realizar la operacion,intentelo una vez más","error")
                });
              }else{
                sweetAlert("el campo Dni tiene que tener 8 digitos","warning")
              } 
            }
            
        });

        $("#deleteCliente").click(function (e) { 
            $("#cbxCliente").fadeIn();
            $(".select2 ").fadeIn();
            $("#showCliente").fadeOut(); 
        });
        $("#addCliente").click(function (e) { 
          $("#formCliente").submit()
        });

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
            },
            submitHandler: function(form) {  
              Clx_Ruc = $("[name='Clx_Ruc']").val()
              Clx_RazonSocial = $("[name='Clx_RazonSocial']").val()
              Clx_Direc = $("[name='Clx_Direc']").val()
              Clx_Nombre = $("[name='Clx_Nombre']").val()
              Clx_Apellido = $("[name='Clx_Apellido']").val()
              Clx_Cel = $("[name='Clx_Cel']").val()
              Clx_Dni = $("[name='Clx_Dni']").val()
              $("#addCliente").fadeOut()

          
              var isruc = 0;
              var isn = 0;

              if( Clx_RazonSocial == "" && Clx_Ruc == ""){ 
                isruc++;  
              } 

              if( Clx_Nombre == "" && Clx_Apellido == ""){ 
                isn++;  
              } 
       
              if( isruc == 1 && isn==1 ){  
                  sweetAlert("Complete los datos del ruc o ( Nombres y apellidos) para registrar un cliente","error")
                  $("#addCliente").fadeIn()
              }
              else{ 
                 $(".modal-cliente").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos" }); 
                  $("#addCliente").fadeIn()
                  @this.addCliente(
                    isruc,
                    Clx_Ruc,  
                    Clx_RazonSocial,
                    Clx_Direc,
                    Clx_Nombre,
                    Clx_Apellido,
                    Clx_Cel,
                    Clx_Dni
                  ).then((result) => {
                    $("#addCliente").fadeIn()
                     Data = JSON.parse(result) 
                     console.log(Data)
                     if(Data.tipo=="success"){ 
                       $("[name='Clx_Ruc']").val("")
                       $("[name='Clx_RazonSocial']").val("")
                       $("[name='Clx_Direc']").val("")
                       $("[name='Clx_Nombre']").val("")
                       $("[name='Clx_Apellido']").val("")
                       $("[name='Clx_Cel']").val("")
                       $("[name='Clx_Dni']").val("")

                       $("#cbxCliente").fadeOut();
                       $(".select2 ").fadeOut();
                       $("#showCliente").fadeIn();
                       $("#codCliente").val(Data.mensaje.cod)
                       $("#showClienteText").html(Data.mensaje.alias)
                      
                       $("#cbxCliente").val(Data.mensaje.cod);
                       $("#Clx_Id").val(Data.mensaje.cod);
                       $(".modal-cliente").modal('hide'); 
                     }else{
                       sweetAlert(Data.mensaje,"error")
                     }
                     $(".modal-cliente").unblock()
                     $("#addCliente").fadeIn()

                  }).catch((err) => {
                    console.log(err)  
                    sweetAlert("error no se puede realizar la operacion,intentelo una vez más","error")
                  });
               }

            }    
         });


      });


    </script>
  @endpush

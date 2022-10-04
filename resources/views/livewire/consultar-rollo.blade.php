   
    <div class="card" wire:ignore id="Roxs" style="display:none;">
        <div class="card-header border-transparent">
          <h3 class="card-title">Rollo</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div> 
        <div class="card-body p-0" style="display: block;">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
              <tr class="text-center">
                <th>Codigo Rollo</th>
                <th>Tamaño</th>
                <th>Lado</th>
                <th><i class="fa fa-wrench"></i></th>
              </tr>
              </thead>
              <tbody class="text-center">
               
              </tbody>
            </table>
          </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix" style="display: block;">
          --
        </div> 
      </div>
 
@push('scriptConsultarRollo')
<script> 

    $("#btnConsultarRollo").click(function (e) {
        
        var ancho = $("#Igx_Ancho"); 
        var alto = $("#Igx_Longitud");
        var limiteA = $("#Igx_LimiteA");
        var limiteL = $("#Igx_LimiteL");
        var Tmxs = $("#Tmxs");
        
        var rollos = "";

        var validate = '<ul class="bg-danger p-1">';
        var validateC = false;
        if( ancho.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo ancho </li>';    
        }
        if( alto.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo alto </li>';
        }
        if( limiteA.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo restante al imprimir ancho rollo </li>';
        }
        if( limiteL.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo restante al imprimir largo rollo </li>';
        }
        if( Tmxs.val() == "" ){
          validateC = true;
          validate = validate + '<li> elige un tipo de material </li>';
        }
        validate = validate + '</ul>';
        console.log(Tmxs.val())
        if(validateC){
          Swal.fire(
            'Para mostrarte los rollos complete bien los datos',
            validate,
            'warning'
          ) 
        }else{
           $("#body").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos" });
           @this.consultar(ancho.val(),alto.val(),limiteA.val(),limiteL.val(),Tmxs.val()).then((result) => { 
               
               if(result != ""){
                   
                  var html =`<table class="table m-0">
                                  <thead>
                                  <tr class="text-center text-primary">
                                    <th>Codigo Rollo</th>
                                    <th>Tamaño</th>
                                    <th>Lado</th>
                                    <th><i class="fa fa-wrench"></i></th>
                                  </tr>
                                  </thead>
                                  <tbody class="text-center text-white">
                                    ${result}
                                  </tbody>
                              </table>`;
                    Swal.fire({
                        title: '<strong>Rollos <u>Recomendables para este diseño</u></strong>',
                        icon: 'info',
                        html:html,
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                          '<i class="fa fa-thumbs-up"></i> Great!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText:
                          '<i class="fa fa-thumbs-down"></i>',
                        cancelButtonAriaLabel: 'Thumbs down'
                    })
               }else{
                $("#Roxs").fadeOut();
                sweetAlert("no se encontro ningun rollo recomendado para este diseño","warning",5000)
               } 
              //  $("#body").unblock()
           }).catch((err) => {
              sweetAlert("error no se puede realizar la operacion,intentelo una vez más","error")
           });
           $("#body").unblock()
        }
    });
    
    function elegirRollo(cod,ancho,largo,anchor,largor,total,orientacion,resto,descuentoRollo,ra,rl){
    $("#body").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos" }); 
    Swal.close()
     $("#panelRollo").fadeIn();
     $("#medidas").fadeOut();
     $("#showDesignVertical").fadeOut();
     $("#showDesignHorizontal").fadeOut();

     $("#nrollo").html(cod)
     $("#srollo").html(resto+" metros")

     if(orientacion==0){
      $("#showDesignHorizontal").fadeOut(); 
       $("#showDesignVertical").fadeIn();
       $("#va").html(ancho)
       $("#vl").html(largo)
       $("#vra").html(ra+" metros")
       $("#vrl").html(rl+" metros")

       var porcentaje = Math.round(( total / largor ) * 100);
       console.log(total)
       $("#ra").html("<b>largo de inicio "+largor+" </b>/ largo actual "+total+" - "+porcentaje+"%")
       $("#rap").html("<div class='progress-bar bg-success' style='width:"+Math.round(porcentaje)+"%'></div>")

       var porcentajed = Math.round(( (total-(largo+rl)) / largor ) * 100);

       var total = new Decimal(total)
       var largo = new Decimal(largo)
       var rl = new Decimal(rl)
       var operacion =  total.minus(largo).minus(rl).toNumber()

       console.log(operacion )  
       $("#rad").html("<b>largo de inicio "+largor+" </b>/ largo actual "+operacion+" - "+porcentajed+"%")
       $("#rapd").html("<div class='progress-bar bg-success' style='width:"+porcentajed+"%'></div>")
       $("#body").unblock();

       $("#Igx_Orientacion").val("V")

     }else{
      $("#showDesignVertical").fadeOut();
       $("#showDesignHorizontal").fadeIn(); 

       $("#ha").html(ancho)
       $("#hl").html(largo)
       $("#hra").html(ra+" metros")
       $("#hrl").html(rl+" metros")

       var porcentaje = Math.round(( total / largor ) * 100);
       console.log(total)
       $("#ra").html("<b>largo de inicio "+largor+" </b>/ largo actual "+total+" - "+porcentaje+"%")
       $("#rap").html("<div class='progress-bar bg-success' style='width:"+Math.round(porcentaje)+"%'></div>")

       var porcentajed = Math.round(( (total-(largo+rl)) / largor ) * 100);
       
       
       var total = new Decimal(total)
       var largo = new Decimal(largo)
       var rl = new Decimal(rl)
       
       var operacion =  total.minus(largo).minus(rl).toNumber()

       console.log(operacion )  
       $("#rad").html("<b>largo de inicio "+largor+" </b>/ largo actual "+operacion+" - "+porcentajed+"%")
       $("#rapd").html("<div class='progress-bar bg-success' style='width:"+porcentajed+"%'></div>")
       $("#body").unblock();
       $("#Igx_Orientacion").val("H")
     }  
       $("#Rox_Id").val(cod)
    }

    $("#btnClosePanel").click(function (e) { 
      
      $("#panelRollo").fadeOut();
      $("#medidas").fadeIn();
      
    });
   
   document.getElementById("btnRolloSearch").onclick=async ()=>{ 

        var ancho = $("#Igx_Ancho"); 
        var alto = $("#Igx_Longitud");
        var limiteA = $("#Igx_LimiteA");
        var limiteL = $("#Igx_LimiteL"); 

        var validate = '<ul class="bg-danger p-1">';
        var validateC = false;
        if( ancho.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo ancho </li>';    
        }
        if( alto.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo alto </li>';
        }
        if( limiteA.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo restante al imprimir ancho rollo </li>';
        }
        if( limiteL.val() == "" ){
          validateC = true;
          validate = validate + '<li> rellena el campo restante al imprimir largo rollo </li>';
        } 
        validate = validate + '</ul>';
       
        if(validateC){
          Swal.fire(
            'Para mostrarte los rollos complete bien los datos',
            validate,
            'warning'
          ) 
        }else{
      const { value: formValues } = await Swal.fire({
        title: 'Digita el codigo del rollo',
        html:
          '<input id="swal-input1" class="swal2-input text-center">' ,
        focusConfirm: false,
         
        preConfirm: () => {

          if (document.getElementById('swal-input1').value == '') {
             swal.showValidationMessage("llene los datos correctamente"); // Show error when validation fails.
             
          } else {
            return {
              "cod":document.getElementById('swal-input1').value
            }
          }
          
        }
      })

      if (formValues) { 
        console.log(formValues) 
        @this.getRox(formValues.cod,ancho.val(),alto.val(),limiteA.val(),limiteL.val(),0)
        .then((result) => {
          console.log(result)
           if(!result){
             Swal.fire("Ningun rollo tiene este codigo")  
           }else{ 
            var reponse = JSON.parse(result)
             if(reponse.tipo == "error"){
               Swal.fire(reponse.mensaje)  
             }else{
               var rx = reponse.mensaje 
               console.log(reponse.mensaje) 
               elegirRollo(rx.cod,rx.ancho,rx.largo,rx.rancho,rx.rlongitud,rx.total,rx.orientacion,rx.resto,rx.descuento,rx.sobranteA,rx.sobranteL)
             } 
           } 
        }) 
      }

    }
        //  Swal.fire({
        //   title: 'Ingrese el codigo del rollo',
        //   input: 'number',
        //   inputAttributes: {
        //     autocapitalize: 'off'
        //   },
        //   showCancelButton: true,
        //   confirmButtonText: 'Buscar',
        //   showLoaderOnConfirm: true,
        //   preConfirm: (login) => {
        //      return @this.getRox(login)
        //       .then(response => {
        //          console.log(response)
        //          return JSON.parse(response)
        //       })
        //       .catch(error => {
        //         Swal.showValidationMessage(
        //           `error intentelo de nuevo`
        //         )
        //       })
        //   },
        //   allowOutsideClick: () => !Swal.isLoading()
        //   }).then((result) => {
        //     if(result.value == undefined){
        //       sweetAlert("Ningun rollo tiene este cod","warning",3000)
        //     }else{
        //       elegirRollo(result.value.Rox_Cod,result.value.Rox_Ancho,result.value.Rox_LongitudC,result.value.Rox_Longitud)
        //     } 
        //     console.log(result)
        //   })
    };
</script> 
@endpush
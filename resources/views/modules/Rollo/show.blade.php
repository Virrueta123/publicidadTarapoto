@extends('layouts.admin')

@section('name')
    Rollo
@endsection
@section('content') 


<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row  ">
      <div class="col-12 ">
        <h4 class="text-primary">
          <i class="fa-solid fa-scroll"></i> Rollo {{$show->Rox_Cod}} 
        </h4>
          <button class="btn btn-tool bg-info text-info float-right" title="Collapse" data-toggle="modal" data-target="#modal-ingreso">
            <i class="fas fa-plus text-white"> </i> <span>Agregar Ingresos</span> 
          </button>  
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Nombre del material
        <address>
          <strong>{{$show->Mx_Nombre}} </strong> 
        </address>
      </div>  
      <div class="col-sm-4 invoice-col">
        Tipo de material
        <address>
          <strong>{{$show->Tmx_Nombre}} </strong> 
        </address>
      </div>  
    </div>


    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Ancho
        <address>
          <strong>{{ moneyFormat($show->Rox_Ancho) }} metros</strong><br> 
        </address>
      </div>
      
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Longitud Inicial
        <address>
          <strong>{{ moneyFormat($show->Rox_Longitud) }} metros</strong><br>
         
        </address>
      </div>
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Longitud Usado
        <address>
          <strong>{{ moneyFormat($usado->descuentoRollo) }} metros usados</strong><br>
          
        </address>
      </div>
      <!-- /.col -->
       
    </div>
     
  
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Todo los ingresos del Rollo</h3>

          <div class="card-tools">
            {{-- <a href="{{ route("Cliente.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
              <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
            </a>  --}}
          </div>
        </div>
        <div class="card-body p-1"> 
              <table id="ingresoRollos" class="table table-bordered table-striped">
                  <thead>
                      <tr> 
                          <th>Nombres</th> 
                          <th>Fecha</th> 
                          <th>Monto</th>
                          <th>M-Pago</th> 
                          <th><i class="fa fa-wrench"></i></th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
          
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-info">
          ----
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>
  </div>

 
@endsection

@section("js")
<script>
  $(function () {

    var table = $('#ingresoRollos').DataTable({
      "order": [[ 1, "DESC" ]],
      language: { 
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
      }, 
      ajax:{ 
        "url":"{{ route("Rollo.igxs") }}",
          "data": {
            "Rox_Cod": "{{ $show->Rox_Cod }}",
        }
      },
      columns: [
          {data: 'Igx_Descripcion', name: 'Descripcion'},  
          {data: 'Igx_Fecha', name: 'Fecha'},
          {data: 'monto', name: 'Monto'},
          {data: 'Mpx_Nombre', name: 'Monto'},
          {
              data: 'action', 
              name: 'action' 
          },
      ],
      dom: 'Bfrtip',
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }) 
  });
    
</script>
  
@endsection
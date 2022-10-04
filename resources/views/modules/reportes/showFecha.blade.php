@extends('layouts.admin')

@section('name')
    Vista Cliente
@endsection
@section('content') 
 
 
  <div class="row">
    <div class="col-6">
      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Ingresos Egresos</h3>

          <div class="card-tools">
            {{-- <a href="{{ route("Cliente.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
              <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
            </a>  --}}
          </div>
        </div>
        <div class="card-body"> 
              <table id="ingresos" class="table table-bordered table-striped">
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

    <div class="col-6">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title">Egresos</h3>
  
            <div class="card-tools">
              {{-- <a href="{{ route("Cliente.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
                <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
              </a>  --}}
            </div>
          </div>
          <div class="card-body"> 
                <table id="egresos" class="table table-bordered table-striped">
                    <thead>
                        <tr> 
                            <th>Descripcion</th> 
                            <th>monto</th> 
                            <th>M-pago</th> 
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

    var table = $('#ingresos').DataTable({
      "order": [[ 1, "DESC" ]],
      language: { 
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
      }, 
      ajax:{ 
        "url":"{{ route("Reportes.ingresos") }}",
          "data": {
            "fecha": "{{ $fecha }}",
        }
      },
      columns: [
          {data: 'clientes', name: 'Descripcion'},  
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


    var table = $('#egresos').DataTable({
      "order": [[ 1, "DESC" ]],
      language: { 
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
      }, 
      ajax:{ 
        "url":"{{ route("Reportes.egresos") }}",
          "data": {
            "fecha": "{{ $fecha }}",
        }
      },
      columns: [
          {data: 'Egx_Desc', name: 'Descripcion'},  
          {data: 'Egx_Monto', name: 'Fecha'},
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
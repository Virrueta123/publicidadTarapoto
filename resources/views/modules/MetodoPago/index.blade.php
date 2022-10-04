@extends('layouts.admin')

@section('name')
    Metodos de pago
@endsection
@section('content') 
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title">Tabla de todo los metodos de pago</h3>

            <div class="card-tools">
              <a href="{{ route("MetodoPago.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
                <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
              </a> 
            </div>
          </div>
          <div class="card-body"> 
                <table id="tblMetodoPago" class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>   
                            <th>Nombre</th> 
                            <th><i class="fa fa-wrench"></i></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
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

@section("script")
 
@endsection 

@section("js")
    <script>
        $(function () {
    
    var table = $('#tblMetodoPago').DataTable({
        language: { 
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
        }, 
        ajax: "{{ route("MetodoPago.data") }}",
        columns: [ 
            {data: 'Mpx_Nombre', name: 'Mpx_Nombre'},  
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
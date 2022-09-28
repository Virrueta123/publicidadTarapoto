@extends('layouts.admin')

@section('name')
    Clientes
@endsection
@section('content') 
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title">Clientes</h3>

            <div class="card-tools">
              <a href="{{ route("Material.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
                <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
              </a> 
            </div>
          </div>
          <div class="card-body"> 
                <table id="clientes" class="table table-bordered table-striped">
                    <thead>
                        <tr> 
                            <th>Nombres</th> 
                            <th>Apellidos</th>
                            <th>Razon</th>
                            <th>Ruc</th>
                            <th>Cel</th>
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

@section("script")
 
@endsection 

@section("js")
    <script>
        $(function () {
    
    var table = $('#clientes').DataTable({
        language: { 
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
        }, 
        ajax: "{{ route("Cliente.datas") }}",
        columns: [
            {data: 'Clx_Nombre', name: 'Nombres'}, 
            {data: 'Clx_Apellido', name: 'Apellidos'}, 
            {data: 'Clx_RazonSocial', name: 'Nombres'}, 
            {data: 'Clx_Ruc', name: 'Apellidos'}, 
            {data: 'Clx_Cel', name: 'Nombres'}, 
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
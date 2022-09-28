@extends('layouts.admin')

@section('name')
    Tipo de material
@endsection
@section('content')
 

<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title">Todo los datos</h3>

            <div class="card-tools">
              <a href="#" class="btn btn-tool bg-white text-info" title="Collapse">
                <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
              </a> 
            </div>
          </div>
          <div class="card-body">
             
                <table id="TipoMaterial"  class="table table-bordered table-striped">
                    <thead>
                        <tr> 
                            <th>Name</th> 
                            <th>Operaciones</th>
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
  </div>

@endsection

@section("script")
 
@endsection 

@section("js")
    <script>
        $(function () {
    
    var table = $('#TipoMaterial').DataTable({
        language: { 
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        
        }, 
        ajax: "{{ route("TipoMaterial.data") }}",
        columns: [
            {data: 'Tmx_Nombre', name: 'Nombre'}, 
            {
                data: 'action', 
                name: 'action' 
            },
        ],
        dom: 'Bfrtip',
        "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
          
    </script>
@endsection


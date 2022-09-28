@extends('layouts.admin')

@section('name')
    Tipo de egresos
@endsection
@section('content') 
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title">Tabla de Tipo de egresos</h3>

            <div class="card-tools">
              <a href="{{ route("TipoEgresos.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
                <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
              </a> 
            </div>
          </div>
          <div class="card-body"> 
                <table id="tblTipoEgresos" class="table table-bordered table-striped">
                    <thead>
                        <tr>  
                            <th>Alias</th>
                            <th>Descripcion</th> 
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
    
    var table = $('#tblTipoEgresos').DataTable({
        language: { 
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
        }, 
        ajax: "{{ route("TipoEgresos.data") }}",
        columns: [ 
            {data: 'Tex_Alias', name: 'Tex_Alias'},  
            {data: 'Tex_Desc', name: 'Tex_Desc'},
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
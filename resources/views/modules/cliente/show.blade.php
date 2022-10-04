@extends('layouts.admin')

@section('name')
    Vista Cliente
@endsection
@section('content') 

<div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center">
        <i class="fa fa-user text-info fa-4x img-circle" ></i>
      </div>
      @if ($Clx->Clx_RazonSocial!="")
        <h3 class="profile-username text-center text-info">{{ $Clx->Clx_RazonSocial }}</h3>
      @endif 
      <p class="profile-username text-center">{{ $Clx->Clx_Nombre }} | {{ $Clx->Clx_Apellido }}</p>
       
      <div class="row">
        <div class="col-6">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Ruc</b>
                  @if ($Clx->Clx_Ruc!="")
                    <p class="float-right text-success">{{ $Clx->Clx_Ruc }}</p>
                  @else
                    <p class="float-right text-danger">No se registro</p>
                  @endif
                  <a class="float-right"></a>
                </li>
                <li class="list-group-item">
                    <b>Celular</b>
                    @if ($Clx->Clx_Cel!="")
                      <p class="float-right text-success">{{ $Clx->Clx_Cel }}</p>
                    @else
                      <p class="float-right text-danger">No se registro</p>
                    @endif
                    <a class="float-right"></a>
                  </li>
              </ul>
          </div>
          <div class="col-6">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Numero Dni</b>
                  @if ($Clx->Clx_Dni !="")
                    <p class="float-right text-success">{{ $Clx->Clx_Dni }}</p>
                  @else
                    <p class="float-right text-danger">No se registro</p>
                  @endif
                  <a class="float-right"></a>
                </li>
                  <li class="list-group-item">
                  <b>Direccion</b>
                  @if ($Clx->Clx_Direc !="")
                    <p class="float-right text-success">{{ $Clx->Clx_Direc }}</p>
                  @else
                    <p class="float-right text-danger">No se registro</p>
                  @endif
                  <a class="float-right"></a>
                </li>
              </ul>
          </div>
      </div> 
    </div>
    <!-- /.card-body -->
  </div>
 
  <div class="row">
    <div class="col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Todos los trabajos de este cliente</h3>

          <div class="card-tools">
            {{-- <a href="{{ route("Cliente.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
              <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
            </a>  --}}
          </div>
        </div>
        <div class="card-body"> 
              <table id="ingresoCliente" class="table table-bordered table-striped">
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

    var table = $('#ingresoCliente').DataTable({
      "order": [[ 1, "DESC" ]],
      language: { 
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" 
      }, 
      ajax:{ 
        "url":"{{ route("Cliente.igxs") }}",
          "data": {
            "Clx_Id": "{{ $Clx->Clx_Id }}",
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
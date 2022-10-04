@extends('layouts.admin')

@section('name')
    Crear un Cliente
@endsection
@section('history')
    <li class="breadcrumb-item active"><a href="{{ route("Cliente.index") }}"></a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection
@section('content')  
<div class="modal-cliente" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear cliente</h4>
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
  @section('js')
    @stack('scripts')
  @endsection
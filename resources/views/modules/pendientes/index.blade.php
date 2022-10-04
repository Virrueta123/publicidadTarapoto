@extends('layouts.admin')

@section('name')
    Trabajos Pendientes
@endsection
@section('history') 
    <li class="breadcrumb-item active">Calendario</li>
@endsection
@section('content') 
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="card-title">pedientes</h3>

            <div class="card-tools">
              <a href="{{ route("Pendientes.create") }}" class="btn btn-tool bg-white text-info" title="Collapse">
                <i class="fas fa-plus text-success"> </i> <span>Agregar </span> 
              </a> 
            </div>
          </div>
          <div class="card-body"> 
            <livewire:pendientes />
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
  @stack('calendar')
@endsection 

 
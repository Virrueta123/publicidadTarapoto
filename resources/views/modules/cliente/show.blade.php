@extends('layouts.admin')

@section('name')
    Vista Cliente
@endsection
@section('content') 

<div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
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
                  @if ($Clx->Clx_Direccion !="")
                    <p class="float-right text-success">{{ $Clx->Clx_Direccion }}</p>
                  @else
                    <p class="float-right text-danger">No se registro</p>
                  @endif
                  <a class="float-right"></a>
                </li>
              </ul>
          </div>
      </div>
      

      <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
    </div>
    <!-- /.card-body -->
  </div>
 

@endsection
 

@section("js")
    
  
@endsection
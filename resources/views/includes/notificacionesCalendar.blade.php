<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-calendar"></i>
      <span class="badge badge-info navbar-badge">{{ $notificacionPendientesCount }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    
    @foreach ($pendientes as $pxn)
   
      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class="media"> 
          <i class="far fa-calendar fa-2x p-1 text-primary"></i>
          <div class="media-body">
            @if ($pxn->Clx_RazonSocial != "" )
              <h3 class="dropdown-item-title"> {{limite_texto($pxn->Clx_RazonSocial,20)}} </h3>
            @else
              <h3 class="dropdown-item-title"> {{$pxn->Clx_Nombre}} | {{$pxn->Clx_Apellido}}</h3>  
            @endif 
            <p class="text-sm">{{ $pxn->Pex_Desc }}</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hoy dia</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div> 
      
    @endforeach

    @foreach ($pendientesDay as $pxnh)
   
      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class="media"> 
          <i class="far fa-calendar fa-2x p-1 text-primary"></i>
          <div class="media-body">
            <h3 class="dropdown-item-title">
              @if ($pxnh->Clx_RazonSocial != "" )
                <h3 class="dropdown-item-title"> {{ limite_texto($pxnh->Clx_RazonSocial,20) }} </h3>
              @else
                <h3 class="dropdown-item-title"> {{$pxnh->Clx_Nombre}} | {{$pxnh->Clx_Apellido}}</h3>  
              @endif 
            </h3>
            <p class="text-sm">{{ $pxnh->Pex_Desc }}</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> falta un dia | {{$pxnh->Pex_Fecha}}</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div> 
      
    @endforeach   
     {{-- <a href="#" class="dropdown-item dropdown-footer">Todos los mensajes</a> --}}
    </div>
  </li>
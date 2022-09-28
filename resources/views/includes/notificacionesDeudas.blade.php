<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-person-booth"></i>
      <span class="badge badge-info navbar-badge">{{ count($deudas) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    
    @foreach ($deudas as $dexn)
   
      <a href="#" class="dropdown-item">
        <!-- Message Start -->
        <div class="media"> 
          <i class="far fa-calendar fa-2x p-1 text-primary"></i>
          <div class="media-body">
            @if ($dexn->Clx_RazonSocial != "" )
              <h3 class="dropdown-item-title"> {{ limite_texto($dexn->Clx_RazonSocial,20) }} </h3>
            @else
              <h3 class="dropdown-item-title"> {{ limite_texto($dexn->Clx_Nombre." | ".$dexn->Clx_Apellido) }}</h3>  
            @endif 
            <p class="text-sm">deuda de {{ $dexn->Dex_Deuda }} soles</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hoy dia</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div> 
      
    @endforeach

      
     {{-- <a href="#" class="dropdown-item dropdown-footer">Todos los mensajes</a> --}}
    </div>
  </li>
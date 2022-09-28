<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
            <a href="{{ route("Pendientes.index") }}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Trabajos Pendientes
                <span class="badge badge-info right">2</span>
              </p>
            </a>
      </li>      
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-paint-roller"></i>
          <p>
            Gigantografias
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="./index.html" class="nav-link active">
              <i class="fas fa-project-diagram nav-icon"></i>
              <p>Lotes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route("Material.index") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Materiales</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route("TipoMaterial.index") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tipo Material</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index3.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Control de materiales</p>
            </a>
          </li>
        </ul>
      </li>
      {{-- <li class="nav-item">
        <a href="pages/widgets.html" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Widgets
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li> --}}
      
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>
            Reportes
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/charts/chartjs.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>ChartJS</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/flot.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Flot</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/inline.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Inline</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/uplot.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>uPlot</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-money-bill"></i>
         
          <p>
            Ingresos
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route("Ingresos.create") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Crear</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/flot.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>ingresos del mes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/inline.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Inline</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/charts/uplot.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>uPlot</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link"> 
          <i class="nav-icon fa-arrow-trend-down"></i>
          <p>
            Egresos 
            <i class="right fas fa-angle-left"></i>
            
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route("Egresos.create") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Crear</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route("Egresos.index") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Todo los ingresos</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{ route("TipoEgresos.index") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tipo de egresos</p>
            </a>
          </li> 
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-users"></i> 
          <p>
            Clientes
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route("Cliente.index") }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Todos los clientes</p>
            </a>
          </li> 
        </ul>
      </li>
      
      <li class="nav-item">
        <a href="#" class="nav-link" >
           
          <form action="{{ route("logout") }}" method="POST">
            @csrf
           <button type="submit" class="btn btn-dark btn-xs "><i class="nav-icon fas fa-door-closed" ></i> Cerrar Session</button>
        </form>
        </a>
     </li> 
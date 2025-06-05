<div class="main-navbar  bg-white"  id="menu_principal">
    <div class="container p-0">
      <!-- Main Navbar -->
      <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <a class="navbar-brand" href="#/" style="line-height: 25px;">
          <div class="d-table m-auto">
            <img id="main-logo" class="d-inline-block align-top mr-1 ml-3" style="max-width: 18em;margin-top: -11px" src="{{ asset('/assets/img/logo_proinco.png') }}" alt="logo cedenar">
            <span class="d-none d-md-inline ml-1 " >
              <b style='line-height: 63px !important;'>SISTEMA PARA LA GESTIÓN ACADEMICA CENTRO EDUCATIVO CORAZÓN DE MARÍA - FUNDACIÓN PROINCO</b>
            </span>
          </div>
        </a>
        <ul class="navbar-nav  flex-row  ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <img class="user-avatar rounded-circle mr-2" src="{{ asset('/assets/img/usuario.svg') }}"   onerror="this.src='{{ asset('/assets/img/usuario.svg') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-small">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="{{ url('/logout') }}" >
                <i class="material-icons text-danger">&#xE879;</i> Cerrar Sesión </a>
            </div>
          </li>
        </ul>
        <nav class="nav">
          <a href="#" class="nav-link nav-link-icon toggle-sidebar  d-inline d-lg-none text-center " data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
            <i class="material-icons">&#xE5D2;</i>
          </a>
        </nav>
      </nav>
    </div> <!-- / .container -->
  </div> 
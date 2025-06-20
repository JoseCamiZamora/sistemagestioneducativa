


@extends('layouts.app')



@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULOS DEL USUARIO</span>
        <h4 class="page-title">Bienvenido : {{ $usuario_actual->nombres }} </h4>
      </div>
    </div>
    <div class="row">

 @if($usuario_actual->rol == 1)
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/estudiantes/listado_estudiantes') }}" style='width: 100%'>
            
                 <img src="{{ asset('/assets/img/usuarios1.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Estudiantes</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Información de los estudiantes</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/docentes/listado_docentes') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/usuarios.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Planta Docentes</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Información de Docentes</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/configuracion/index_configuracion') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/settings.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Configuración</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración del sistema</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/evaluacion/listado_anios_evaluacion') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/evaluaciones.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Modulo Evaluaciones</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Evaluaciones del Estudiante</span>
                </a>
             
            </div>
          </div>
        </div>
      </div> 
      
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/informes/index_reportes') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/informes.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Modulo Reportes</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Modulo de Reportes del sistema</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/estadisticas/index_estadisticas') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/estadistica.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Modulo Estadisticas</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Modulo de Reportes de estadistica</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('usuarios') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/acceso.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Accesos al sistema   </h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Usuarios del sistema</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      
    @endif

    @if($usuario_actual->rol == 2)
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/evaluacion/listado_anios_evaluacion') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/evaluaciones.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Modulo Evaluaciones</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Evaluaciones del Estudiante</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4">
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
           <div class="d-flex px-3 text-center">
           
                <a href="{{ url('/estadisticas/index_estadisticas') }}" style='width: 100%'>
            
                <img src="{{ asset('/assets/img/estadistica.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
              
                <h4 style='margin-bottom: 1px;' >Modulo Estadisticas</h4>
                <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Modulo de Reportes de estadistica</span>
                </a>
             
            </div>
          </div>
        </div>
      </div>
     @endif
      <div class="col-md-12 ">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Actividad Reciente <span class="nav-link-icon__wrapper">
                      <i class="material-icons"></i>
                      <span id="cantidad_notificaciones" class="badge badge-pill badge-danger"  style="display: inline;padding: .1rem .25rem !important">0</span>
                    </span></h6>
                    <div class="block-handle"></div>
                  </div>
                
                 <div class="card-body p-0" id="bloque_actividad_reciente" >  
                    

                 </div>
                   
      </div>
  </div>
</div>




@endsection


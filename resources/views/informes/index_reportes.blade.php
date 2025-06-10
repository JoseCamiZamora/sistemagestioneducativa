


@extends('layouts.app')



@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULOS DE CONFIGURACION DEL SISTEMA</span>
        <h4 class="page-title">Bienvenido : {{ $usuario_actual->nombres }} </h4>
      </div>
      <div  class=" ml-auto" style="text-align: right; margin-top: 2px;">
          Atrás
          <a href="{{ url('home') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
      </div>
    </div>
    <div class="row">

 @if($usuario_actual->rol == 1)
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_clasificacion') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/materia.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Reportes Matricula</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Informes de Matricula</span>
              </a>
            
          </div>
        </div>
      </div>
    </div> 
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/informes/form_generar_reporte_notas') }}" style='width: 100%'>
          
              <img src="{{ asset('/assets/img/cursos.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;' >Reporte de Notas</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Generación de reporte de notas</span>
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


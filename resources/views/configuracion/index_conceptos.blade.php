


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
    
    
    
    @if($docenteCurso->id_curso != 1)
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_conceptos') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/satisfaccion.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Evaluación</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de conceptos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_dimensiones') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/cognitivo.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Dimensiones</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de dimen</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_conceptos_trans') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/conceptos.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Conceptos</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de conceptos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_concepto_comportamiento') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/decision.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Comportamiento</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de conceptos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    @endif
    @if($usuario_actual->rol == 2)
    @if($docenteCurso->id_curso != 1)
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_conceptos') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/satisfaccion.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Evaluación</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de conceptos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_dimensiones') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/cognitivo.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Dimensiones</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de dimen</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_conceptos_trans') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/conceptos.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Conceptos</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de conceptos</span>
              </a>
            
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="col-12 col-md-6 col-lg-3 mb-4">
      <div class="stats-small card card-small">
        <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
          
              <a href="{{ url('/configuracion/listado_concepto_comportamiento') }}" style='width: 100%'>
          
                <img src="{{ asset('/assets/img/decision.png') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
            
              <h4 style='margin-bottom: 1px;'>Comportamiento</h4>
              <span  class="text-primary" style="font-size:0.9em;margin-top:1px;" >Configuración de conceptos</span>
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


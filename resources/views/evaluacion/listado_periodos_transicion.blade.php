@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULO DE EVALUACION DE ESTUDIANTES</span>
        <h4 class="page-title">Nombre docente: {{$docente->nom_completo}} </h4>
      </div>
       <div  class=" ml-auto" style="text-align: right; margin-top: 2px;">
          Atrás
          <a href="{{ url('evaluacion/listado_estudiantes_configurados_t/1/'.$anio.'') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
        </div>
    </div>
    <div class="row">
      
      <div class="col-12 col-md-6 col-lg-3 mb-4" >
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
                <a href="javascript:void(0);"  onclick="evaluarEstudianteTransicion({{$estudiante}},1)" style='width: 100%'>
                  <img src="{{ asset('/assets/img/cursolista.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
                  <h4 style='margin-bottom: 1px;' >Primer Periodo</h4>
                  <span  class="text-primary" style="font-size:1.0em;margin-top:1px;" >Evaluar Dimenciones</span>
                </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4" >
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
               
                  <a href="javascript:void(0);"  onclick="evaluarEstudianteTransicion({{$estudiante}},2)" style='width: 100%'>
                <img src="{{ asset('/assets/img/cursolista.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
                <h4 style='margin-bottom: 1px;' >Segundo Periodo</h4>
                <span  class="text-primary" style="font-size:1.0em;margin-top:1px;" >Evaluar Dimenciones</span>
                </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4" >
        <div class="stats-small card card-small">
          <div class="card-body px-0 pb-0" >
          <div class="d-flex px-3 text-center">
                
                  <a href="javascript:void(0);"  onclick="evaluarEstudianteTransicion({{$estudiante}},3)" style='width: 100%'>
                <img src="{{ asset('/assets/img/cursolista.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
                <h4 style='margin-bottom: 1px;' >Tercer Periodo</h4>
                <span  class="text-primary" style="font-size:1.0em;margin-top:1px;" >Evaluar Dimenciones</span>
                </a>
            </div>
          </div>
        </div>
      </div>
    
    </div>
   
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_evaluacion_dimenciones">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Evaluación de Dimenciones</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_evaluacion_dimenciones" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
@endsection





                    
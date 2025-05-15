@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULO DE EVALUACION DE ESTUDIANTES</span>
        <h4 class="page-title">Nombre docente: {{$usuarioactual->nombres}}</h4>
      </div>
       <div  class=" ml-auto" style="text-align: right; margin-top: 2px;">
          Atrás
          <a href="{{ url('evaluacion/listado_anios_evaluacion') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
        </div>
    </div>
    <div class="row">
      @foreach($clasesDocente as $materia)
        <div class="col-12 col-md-6 col-lg-3 mb-4" >
          <div class="stats-small card card-small">
            <div class="card-body px-0 pb-0" >
            <div class="d-flex px-3 text-center">
                  <a href="{{ url('/evaluacion/listado_cursos_configurados/'.$materia->id.'') }}" style='width: 100%'>
                  <img src="{{ asset('/assets/img/materias.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
                  <h4 style='margin-bottom: 1px;' >{{$materia->nom_materia }}</h4>
                  <span  class="text-primary" style="font-size:1.0em;margin-top:1px;" >Ver cursos evaluar</span>
                  </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
   
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULO DE EVALUACION DE ESTUDIANTES</span>
        <h4 class="page-title">Nombre docente: {{$clasesDocente->nombre_docente}}</h4>
      </div>
       <div  class=" ml-auto" style="text-align: right; margin-top: 2px;">
          Atrás
          <a href="{{ url('evaluacion/listado_materias_configuradas/'.$clasesDocente->id_docente.'/'.$clasesDocente->id_anio.'') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
        </div>
    </div>
    <div class="row">
      @foreach($cursos as $curso)
        <div class="col-12 col-md-6 col-lg-3 mb-4" >
          <div class="stats-small card card-small">
            <div class="card-body px-0 pb-0" >
            <div class="d-flex px-3 text-center">
                  @if($clasesDocente->id_tipo_clase == 1)
                    <a href="{{ url('/evaluacion/listado_estudiantes_configurados_t/'.$curso->id.'/'.$clasesDocente->id.'') }}" style='width: 100%'>
                  @else
                    <a href="{{ url('/evaluacion/listado_estudiantes_configurados/'.$curso->id.'/'.$clasesDocente->id.'') }}" style='width: 100%'>
                  @endif
                  <img src="{{ asset('/assets/img/cursolista.svg') }}" style='max-height: 40px;' onerror="this.onerror=null; this.src='image.png'">
                  <h4 style='margin-bottom: 1px;' >{{$curso->nombre }}</h4>
                  <span  class="text-primary" style="font-size:1.0em;margin-top:1px;" >Ver estudiantes</span>
                  </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
   
</div>
@endsection
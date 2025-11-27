@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header row no-gutters py-4">
      <div class="col-12 col-sm-10 text-center text-sm-left mb-4 mb-sm-0">
        <span class="text-uppercase page-subtitle">MÓDULO DE EVALUACION DE ESTUDIANTES</span>
      </div>
       <div  class=" ml-auto" style="text-align: right; margin-top: 2px;">
          Atrás
          <a href="{{ url('evaluacion/listado_anios_evaluacion') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
        </div>
    </div>
    <div class="row">
	    <div class="col">
         @if($estado == 1)
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/1') }}" class="mb-2 btn btn-sm btn-primary mr-1 "><label style="font-size: 15px;margin-top: -3px"><i class="fa fa-play-circle" aria-hidden="true"></i> PRIMER PERIODO</label></a>
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/2') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><label style="font-size: 15px;margin-top: 8px"><i class="fa fa-play-circle" aria-hidden="true"></i> SEGUNDO PERIODO</label></a>
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/3') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><label style="font-size: 15px;margin-top: 8px"><i class="fa fa-play-circle" aria-hidden="true"></i> TERCER PERIODO</label></a>
         @endif
         @if($estado == 2)
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/1') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><label style="font-size: 15px;margin-top: 8px"><i class="fa fa-play-circle" aria-hidden="true"></i> PRIMER PERIODO</label></a>
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/2') }}" class="mb-2 btn btn-sm btn-primary mr-1 " ><label style="font-size: 15px;margin-top: -3px"><i class="fa fa-play-circle" aria-hidden="true"></i> SEGUNDO PERIODO</label></a>
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/3') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><label style="font-size: 15px;margin-top: 8px"><i class="fa fa-play-circle" aria-hidden="true"></i> TERCER PERIODO</label></a>
         @endif
         @if($estado == 3)
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/1') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><label style="font-size: 15px;margin-top: 8px"><i class="fa fa-play-circle" aria-hidden="true"></i> PRIMER PERIODO</label></a>
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/2') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><label style="font-size: 15px;margin-top: 8px"><i class="fa fa-play-circle" aria-hidden="true"></i> SEGUNDO PERIODO</label></a>
          <a  href="{{ url('evaluacion/generar_observacion_periodo/'.$directorGrupo->id_docente.'/'.$anios->id.'/3') }}" class="mb-2 btn btn-sm btn-primary mr-1 " ><label style="font-size: 15px;margin-top: -3px"><i class="fa fa-play-circle" aria-hidden="true"></i> TERCER PERIODO</label></a>
         @endif        
	    </div>
	    
	  </div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12 mb-2 mx-auto">
        <div class="stats-small card card-small" >
          <div class="form-row col-md-12 mt-4">
            <div class="col-md-4">
              <label for="feLastName">Nombre Del Docente:</label>
              <input  class="form-control "   name="nom_estudiante" value="{{$directorGrupo->nom_docente}}" required style="margin-top: -6px;" disabled>
            </div>
            <div class="col-md-4">
                <label for="feLastName">Periodo Observación</label><spam style="color: red;"> * </spam>
                <select class="form-control" id="periodo" name="periodo" style="margin-top: -6px; height: 33px;padding-top: 4px;" disabled>
                <option value="">Seleccione el periodo</option>
                  @if($estado == 1)
                    <option value="1" selected>PRIMER PERIODO</option>
                  @endif
                  @if($estado == 2)
                    <option value="2" selected>SEGUNDO PERIODO</option>
                  @endif
                  @if($estado == 3)
                    <option value="3" selected>TERCER PERIODO</option>
                  @endif
                </select>
            </div>
            <div class="col-md-4" style="padding-top: 25px;">
              <button  onclick="generarReporteDirectorGruopo({{$anios->id}},{{$directorGrupo->id_curso}})" class="btn btn-accent text-center" >Generar Informe Notas</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
	    <div class="col">
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
            <thead class="bg-light">
              <tr>
                <th colspan="8" class="th-gris text-center" style='font-size:15px'>Listado Estudiantes a generar observación</th>
              </tr>
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 50px;">No.</th>
                <th scope="col" class="th-gris text-left" >Año Lectivo</th>
                <th scope="col" class="th-gris text-left" >Nombre Estudiante</th>
                <th scope="col" class="th-gris text-left" >Curso</th>
                <th scope="col" class="th-gris text-center" >Materias Evaluadas</th>
                <th scope="col" class="th-gris text-center" >Materias Pendientes</th>
                <th scope="col" class="th-gris text-center" >Comportamiento Evaluado</th>
                <th scope="col" class="th-gris text-center " >Observación</th>
                <th scope="col" class="th-gris text-center " >Observación Final</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstEstudiantes as $estudiante)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>{{$estudiante->desc_anio}}</td>
                  <td class='td-titulo text-left'>{{$estudiante->nombre_estudiante}}</td>
                  <td class='td-titulo text-left'>{{$estudiante->nom_curso}}</td>
                  <td class='td-titulo text-center'>
                    <a class="nav-link text-center"  href="javascript:void(0);"  
                    onclick="consultarMateriasEvaluadas({{$estudiante->id}},{{$anios->id}},{{$estado}})" id="subirfile" >
                      {{$estudiante->materias_evaluadas}}
                    </a>
                  </td>
                  <td class='td-titulo text-center'>{{$estudiante->pendientes_evaluar}}</td>
                  <td class='td-titulo text-center'>{{$estudiante->comportamiento_evaluado}}</td>
                  <td>
                  <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);"  onclick="GenerarObservacion({{$estudiante->id}},{{$anios->id}},{{$directorGrupo->id}})" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-list" title="Evaluar estudiante" style=""></i><br>
                      </div>
                    </a>
                  </td>
                  <td>
                  <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);"  onclick="conceptoFinalObservacion({{$estudiante->id}},{{$anios->id}},{{$directorGrupo->id}})" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-book" title="Evaluar estudiante" style=""></i><br>
                      </div>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
               <tfoot>
              <tr>
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $lstEstudiantes->count() }} Estudiantes </span></td>
              </tr>
              </tfoot>
          </table>
	    </div> 
	  </div>
</div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_observacion">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Observacion del Estudiante</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_observacion" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_materias_evaluadas">
  <div class="modal-dialog modal-lg" style="max-width: 40%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Materias Evaluadas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_materias_evaluadas" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_obs_final">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Observacion Final</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_obs_final" style='min-height: 260px;'>
      </div>
    </div>
  </div>

@endsection
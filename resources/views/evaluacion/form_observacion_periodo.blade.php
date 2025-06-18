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
      <div class="col-12 col-md-12 col-lg-12 mb-2 mx-auto">
        <div class="stats-small card card-small" >
          <div class="form-row col-md-12 mt-4">
            <div class="col-md-4">
              <label for="feLastName">Nombre Del Docente:</label>
              <input  class="form-control "   name="nom_estudiante" value="{{$directorGrupo->nom_docente}}" required style="margin-top: -6px;" disabled>
            </div>
            <div class="col-md-4">
                <label for="feLastName">Periodo Observación</label><spam style="color: red;"> * </spam>
                <select class="form-control" id="periodo" name="periodo" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
                <option value="">Seleccione el periodo</option>
                    @foreach($periodos as $periodo)
                      <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
                    @endforeach
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
                <th colspan="6" class="th-gris text-center" style='font-size:15px'>Listado Estudiantes a generar observación</th>
              </tr>
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 50px;">No.</th>
                <th scope="col" class="th-gris text-left" >Año Lectivo</th>
                <th scope="col" class="th-gris text-left" >Nombre Estudiante</th>
                <th scope="col" class="th-gris text-left" >Tipo</th>
                <th scope="col" class="th-gris text-left" >Curso</th>
                <th scope="col" class="th-gris text-center " >Observacion</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstEstudiantes as $estudiante)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>{{$estudiante->desc_anio}}</td>
                  <td class='td-titulo text-left'>{{$estudiante->nombre_estudiante}}</td>
                  <td class='td-titulo text-left'>{{$estudiante->tipo_grado}}</td>
                  <td class='td-titulo text-left'>{{$estudiante->nom_curso}}</td>
                  <td>
                  <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);"  onclick="GenerarObservacion({{$estudiante->id}},{{$anios->id}},{{$directorGrupo->id}})" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-list" title="Evaluar estudiante" style=""></i><br>
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

@endsection
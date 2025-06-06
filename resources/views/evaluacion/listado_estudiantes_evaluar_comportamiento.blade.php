@extends('layouts.app')



@section('content')

<div class="container">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Evaluación - PRIMARIA</span>
	        <h4 class="page-title" >Listado de estudiantes matriculados<span style='font-size: 0.6em;'></span> </h4>
          <br>
	        <h4 class="page-title" >Curso en evaluación: {{$curso->nombre}}<span style='font-size: 0.6em;'></span> </h4>
	       <div  class=" ml-auto" style="text-align: right; margin-top: -35px;">
	        Atrás
	        <a href="{{ url('evaluacion/listado_anios_evaluacion') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->
	  <div class="row">
    <input type="hidden" id="id_clase" name="id_clase" value="{{$curso->id}}">
	    <div class="col">
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
          
            <thead class="bg-light">
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 50px;">No.</th>
                <th scope="col" class="th-gris text-left" >Año Lectivo</th>
                <th scope="col" class="th-gris text-left" >Nombre Estudiante</th>
                <th scope="col" class="th-gris text-center" >Nota Comp. 1</th>
                <th scope="col" class="th-gris text-center" >Nota Comp. 2</th>
                <th scope="col" class="th-gris text-center" >Nota Comp. 3</th>
                <th scope="col" class="th-gris text-center" >Nota Final</th>
                <th scope="col" class="th-gris text-center" >Desenpeño</th>
                <th scope="col" class="th-gris text-center " >Evaluar</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstEstudiantes as $estudiante)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>{{$estudiante->desc_anio}}</td>
                  <td class='td-titulo text-left'>{{$estudiante->nombre_estudiante}}</td>
                  <td class='td-titulo text-center'>{{$estudiante->nota_primer_periodo}}</td>
                  <td class='td-titulo text-center'>{{$estudiante->nota_segundo_periodo}}</td>
                  <td class='td-titulo text-center'>{{$estudiante->nota_tercer_periodo}}</td>
                  <td class='td-titulo text-center' style="color:rgb(3, 3, 3);font-size: 15px !important;font-weight: bold;">{{$estudiante->nota_final}}</td>
                  @if($estudiante->desempenio == 'Bajo')
                    <td class='td-titulo text-center' style="color: red;font-size: 15px !important;font-weight: bold;">{{$estudiante->desempenio}}</td>
                  @endif
                  @if($estudiante->desempenio == 'Básico')
                    <td class='td-titulo text-center' style="color: #ffb300;font-size: 15px !important;font-weight: bold;">{{$estudiante->desempenio}}</td>
                  @endif
                  @if($estudiante->desempenio == 'Alto')
                    <td class='td-titulo text-center' style="color: #88e600;font-size: 15px !important;font-weight: bold;">{{$estudiante->desempenio}}</td>
                  @endif
                  @if($estudiante->desempenio == 'Superior')
                    <td class='td-titulo text-center' style="color: #88e600;font-size: 15px !important;font-weight: bold;">{{$estudiante->desempenio}}</td>
                  @endif
                  <td>
                  <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);"  onclick="evaluarEstudianteComportamiento({{$estudiante->id}})" id="subirfile" >
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
  <!-- End Default Light Table -->
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_evaluacion">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Evaluacion del estudiante</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_evaluacion" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_editar_anio">
  <div class="modal-dialog modal-lg" style="max-width: 60%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Actualziar Información del año configurado</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_editar_anio" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')



@section('content')

<div class="container">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Configuracion </span>
	        <h4 class="page-title" >Listado de materias que se impartirán en la institución<span style='font-size: 0.6em;'></span> </h4>
	       <div  class=" ml-auto" style="text-align: right; margin-top: -35px;">
	        Atrás
	        <a href="{{ url('configuracion/index_configuracion') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->

	  <div class="row">
	    <div class="col">
        <a href="javascript:void(0);" onclick="IN_form_crear_new_materia();" class="mb-2 btn btn-sm btn-outline-primary mr-1" ><i class="fa fa-user-plus margin-icon" aria-hidden="true" ></i>Registrar Nueva Materia</a>
	    </div>
	  </div>
	  <div class="row">
	    <div class="col">
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
            <thead class="bg-light">
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 50px;">No.</th>
                <th scope="col" class="th-gris text-left" >Descripción</th>
                <th scope="col" class="th-gris text-left" >Clasificación</th>
                <th scope="col" class="th-gris text-center " >Editar</th>
                <th scope="col" class="th-gris text-center " >Borrar</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstMaterias as $materia)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>{{ $materia->nombre}}</td>
                  <td class='td-titulo text-left'>{{ $materia->nom_clasificacion}}</td>
                  <td>
                    <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                    onclick="editarMateria({{$materia->id}})" role="button" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-edit" title="Editar Materia" style=""></i><br>
                      </div>
                    </a>
                  </td>
                  <td>
                    <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                    onclick="borrarMateria({{$materia->id}})" role="button" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-trash" title="Borrar Materia" style=""></i><br>
                      </div>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
               <tfoot>
              <tr>
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $lstMaterias->count() }} Materias </span></td>
              </tr>
              </tfoot>
          </table>
          {{ $lstMaterias->links() }}
	    </div> 
	  </div>
</div>
  <!-- End Default Light Table -->
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_materia">
  <div class="modal-dialog modal-lg" style="max-width: 50%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Crear Nueva Materia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_materia" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_editar_materia">
  <div class="modal-dialog modal-lg" style="max-width: 50%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Actualziar Información de la Materia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_editar_materia" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
@endsection
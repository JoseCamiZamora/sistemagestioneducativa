@extends('layouts.app')



@section('content')

<div class="container">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Docentes </span>
	        <h4 class="page-title" >Listado de docentes activos en la escuela<span style='font-size: 0.6em;'></span> </h4>
	       <div  class=" ml-auto" style="text-align: right; margin-top: -35px;">
	        Atrás
	        <a href="{{ url('configuracion/index_configuracion') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->

	  
	  <form  method="post"  action="{{ url('docentes/buscar_docentes') }}" id="f_buscar_docentes"   >
        <input type="hidden" name="_token" id='_token_avatar' value="<?php echo csrf_token(); ?>">    
          <div class="input-group mb-3">
            <input type="text" id='dato_buscadoDBP' name='dato_buscado' required class="form-control" style='background-color: white !important;' placeholder="Buscar docente por identificación o nombres y apellidos aquí...." aria-label="Buscar docente" aria-describedby="basic-addon2">
            <input type="hidden" id='busdbp_pagina' name='busdbp_pagina' value='1'  >
            <input type="hidden" id='busdbp_next' name='busdbp_next' value='0'  >
            <div class="input-group-append">
              <button class="btn btn-white" type="submit">Buscar</button>
              @if(isset($busqueda))
              <a href="{{ url('docentes/listado_docentes') }}" class="btn btn-white  btn-azul"   >
                  <i class="fas fa-undo icon-color_blanco" title="deshacer busqueda"></i>
              </a>
              @endif
            </div>
          </div>
    </form>
  
	  <div class="row">
	    <div class="col">
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
            <thead class="bg-light">
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 25px;">No.</th>
                <th scope="col" class="th-gris text-left" style="width: 160px;">Doc. Identificación</th>
                <th scope="col" class="th-gris text-left" >Nombres</th>
                <th scope="col" class="th-gris text-left" >Apellidos</th>
                <th scope="col" class="th-gris text-left" >Direccion</th>
                <th scope="col" class="th-gris text-left" >Telefono</th>
                <th scope="col" class="th-gris text-left" >Correo</th>
                <th scope="col" class="th-gris text-center " >Configurar Clases</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstDocentes as $docente)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>
                    @if($docente->id_tipo_documento == 1)
                      RC. {{ $docente->nro_documento}}
                    @endif
                    @if($docente->id_tipo_documento == 2)
                      TI. {{ $docente->nro_documento}}
                    @endif
                    @if($docente->id_tipo_documento == 3)
                      CC. {{ $docente->nro_documento}}
                    @endif
                    @if($docente->id_tipo_documento == 4)
                      PPT. {{ $docente->nro_documento}}
                    @endif
                    @if($docente->id_tipo_documento == 5)
                      TE. {{ $docente->nro_documento}}
                    @endif
                    @if($docente->id_tipo_documento == 5)
                      CE. {{ $docente->nro_documento}}
                    @endif
                  </td>
                  <td class='td-titulo text-left'>{{ $docente->nombres}}</td>
                  <td class='td-titulo text-left'>{{ $docente->apellidos}}</td>
                  <td class='td-titulo text-left'  >{{ $docente->direccion }}</td>
                  <td class='td-titulo text-left'  >{{ $docente->telefono }}</td>
                  <td class='td-titulo text-left'  >{{ $docente->correo }}</td>
                  <td>
                    <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                    onclick="clasesDocente({{$docente->id}})" role="button" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-list" title="Configurar Clases" style=""></i><br>
                      </div>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
               <tfoot>
              <tr>
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $lstDocentes->count() }} docentes </span></td>
              </tr>
              </tfoot>
          </table>
          {{ $lstDocentes->links() }}
	    </div> 
	  </div>
</div>
  <!-- End Default Light Table -->
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_docente">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Crear Nuevo Docente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_docente" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_editar_docentes">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Actualziar Información del Docente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_editar_docentes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_clases_docentes">
  <div class="modal-dialog modal-lg" style="max-width: 60%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Configurar las clases que impartirá el docente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_clases_docentes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
@endsection
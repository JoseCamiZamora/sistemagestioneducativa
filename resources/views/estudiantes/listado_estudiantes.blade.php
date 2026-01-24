@extends('layouts.app')



@section('content')

<div class="main-content-container container-fluid px-4 pb-4">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Estudiantes </span>
	        <h4 class="page-title" >Listado de estudiantes activos en la escuela<span style='font-size: 0.6em;'></span> </h4>
	       <div  class=" ml-auto" style="text-align: right; margin-top: -35px;">
	        Atrás
	        <a href="{{ url('home') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->

	  <div class="row">
	    <div class="col">
        @if($estado == 'A')
          <a  href="{{ url('/estudiantes/listado_estudiantes') }}" class="mb-2 btn btn-sm btn-primary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Estudiantes Activos</a>
          <a  href="{{ url('/estudiantes/listado_estudiantes_i') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Estudiantes Inactivos</a>
          <a  href="{{ url('/estudiantes/listado_estudiantes_e') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Egresados</a>
	      @endif
        @if($estado == 'I')
          <a  href="{{ url('/estudiantes/listado_estudiantes') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Estudiantes Activos</a>
          <a  href="{{ url('/estudiantes/listado_estudiantes_i') }}" class="mb-2 btn btn-sm btn-primary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Estudiantes Inactivos</a>
          <a  href="{{ url('/estudiantes/listado_estudiantes_e') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Egresados</a>
        @endif
        @if($estado == 'E')
          <a  href="{{ url('/estudiantes/listado_estudiantes') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Estudiantes Activos</a>
          <a  href="{{ url('/estudiantes/listado_estudiantes_i') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Estudiantes Inactivos</a>
          <a  href="{{ url('/estudiantes/listado_estudiantes_e') }}" class="mb-2 btn btn-sm btn-primary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Egresados</a>
        @endif
        <a href="javascript:void(0);" onclick="IN_form_crear_new_estudiante();" class="mb-2 btn btn-sm btn btn-success mr-1" ><i class="fa fa-user-plus margin-icon" aria-hidden="true" ></i>Registro Nuevo Estudiante</a>
	                       
	    </div>
	    
	  </div>
	  <form  method="post"  action="{{ url('estudiantes/buscar_estudiantes') }}" id="f_buscar_estudiante"   >
            <input type="hidden" name="_token" id='_token_avatar' value="<?php echo csrf_token(); ?>">    
              <div class="input-group mb-3">
                <input type="text" id='dato_buscadoDBP' name='dato_buscado' required class="form-control" style='background-color: white !important;' placeholder="Buscar estudiante por identificación o nombres y apellidos aquí...." aria-label="Buscar estudiante" aria-describedby="basic-addon2">
                <input type="hidden" id='busdbp_pagina' name='busdbp_pagina' value='1'  >
                <input type="hidden" id='busdbp_next' name='busdbp_next' value='0'  >
                <input type="hidden" id='estado' name='estado' value='{{$estado}}'  >
                <div class="input-group-append">
                  <button class="btn btn-white" type="submit">Buscar</button>
                  @if(isset($busqueda))
                  <a href="{{ url('estudiantes/listado_estudiantes') }}" class="btn btn-white  btn-azul"   >
                      <i class="fas fa-undo icon-color_blanco" title="deshacer busqueda"></i>
                  </a>
                  @endif
                </div>
              </div>
          </form>
    <div class="row " style="margin-bottom: 20px;">
      @if($estado == 'A')
        <div class="col-md-2">
          <select class="form-control" id="select_filtro_val_anio" >
            @if($filtro == 'I')
              <option value="0" selected >Seleccione Año...</option>
            @else
              <option value="{{$anioFind->id}}" selected >{{$anioFind->anio_inicio}}-{{$anioFind->anio_fin}}</option>
            @endif
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <select class="form-control" id="select_filtro_val_grado" onchange="FC_cambiar_filtro_grado(this.value);" >
            @if($filtro == 'I')  
              <option value="0" selected >Seleccione Curso...</option>
            @else
              <option value="{{$cursoFind->id}}" >{{$cursoFind->nombre}}</option>
            @endif
            @foreach($grados as $curso)
              <option value="{{$curso->id}}" >{{$curso->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
           <a  href="{{ url('/estudiantes/listado_estudiantes') }}" class="mb-2 btn btn-sm btn-primary mr-1 " style="height: 35px;" ><span style="margin-top: 7px;">Ver Todos Los Estudiantes</span></a>
        </div>

      @endif
    </div>
         
  
	  <div class="row">
	    <div class="col">
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
            <thead class="bg-light">
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 25px;">No.</th>
                <th scope="col" class="th-gris text-left" >Doc. Identificación</th>
                <th scope="col" class="th-gris text-left" >Nombres</th>
                <th scope="col" class="th-gris text-left" >Apellidos</th>
                <th scope="col" class="th-gris text-left" >Fecha Nacimiento</th>
                <th scope="col" class="th-gris text-left">Genero</th>
                <th scope="col" class="th-gris text-left">Edad</th>
                <th scope="col" class="th-gris text-left">RH</th>
                <th scope="col" class="th-gris text-left" >Direccion</th>
                <th scope="col" class="th-gris text-left" >Telefono</th>
                <th scope="col" class="th-gris text-center " >Info</th>
                <th scope="col" class="th-gris text-center " >Editar</th>
                @if($estado == 'A')
                  <th scope="col" class="th-gris text-center " >Inactivar</th>
                @else
                  <th scope="col" class="th-gris text-center " >Activar</th>
                @endif
              </tr>
            </thead>
            <tbody>

             @foreach($lstEstudiantes as $estudiante)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>
                    @if($estudiante->id_tipo_documento == 1)
                      RC. {{ $estudiante->identificacion}}
                    @endif
                    @if($estudiante->id_tipo_documento == 2)
                      TI. {{ $estudiante->identificacion}}
                    @endif
                    @if($estudiante->id_tipo_documento == 3)
                      CC. {{ $estudiante->identificacion}}
                    @endif
                    @if($estudiante->id_tipo_documento == 4)
                      PPT. {{ $estudiante->identificacion}}
                    @endif
                    @if($estudiante->id_tipo_documento == 5)
                      TE. {{ $estudiante->identificacion}}
                    @endif
                    @if($estudiante->id_tipo_documento == 5)
                      CE. {{ $estudiante->identificacion}}
                    @endif
                  </td>
                  <td class='td-titulo text-left'>{{ $estudiante->primer_nombre}} {{$estudiante->segundo_nombre}}</td>
                  <td class='td-titulo text-left'>{{ $estudiante->primer_apellido}} {{$estudiante->segundo_apellido}}</td>
                  <td class='td-titulo text-left'  >{{ $estudiante->fecha_nacimiento }}</td>
                  <td class='td-titulo text-left'  >{{ $estudiante->genero }}</td>
                  <td class='td-titulo text-left'  >{{ $estudiante->edad }}</td>
                  <td class='td-titulo text-left'  >{{ $estudiante->tipo_rh }}</td>
                  <td class='td-titulo text-left'  >{{ $estudiante->direccion }}</td>
                  <td class='td-titulo text-left'  >{{ $estudiante->telefono }}</td>
                  <td>
                   
                    <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                    onclick="verInfoEstidiante({{$estudiante->id}})" role="button" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-eye" title="Ver ficha tecnica del estudiante" style=""></i><br>
                      </div>
                    </a>
                  </td>
                 
                  <td>
                    @if($estado == 'A')
                      <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                      onclick="editarEstudiante({{$estudiante->id}},'{{$estudiante->estado}}')" role="button" id="subirfile" >
                        <div class="nav-link-icon__wrapper">
                          <i class="fa fa-edit" title="Editar Estudiante" style=""></i><br>
                        </div>
                      </a>
                     @endif
                  </td>
                  <td>
                    @if($estado == 'A')
                      <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                      onclick="inactivarEstudiante({{$estudiante->id}})" role="button" id="subirfile" >
                        <div class="nav-link-icon__wrapper">
                          <i class="fa fa-list" title="Inactivar Estudiante" style=""></i><br>
                        </div>
                      </a>
                    @else
                      <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                      onclick="activarEstudiante({{$estudiante->id}})" role="button" id="subirfile" >
                        <div class="nav-link-icon__wrapper">
                          <i class="fa fa-list" title="Activar Estudiante" style=""></i><br>
                        </div>
                      </a>
                    @endif
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
          @if($filtro == 'I')
            {{ $lstEstudiantes->links() }}
          @endif
	    </div> 
	  </div>
</div>
  <!-- End Default Light Table -->
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_estudiantes">
  <div class="modal-dialog modal-lg" style="max-width: 80%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Crear Nuevo Estudiante</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_estudiantes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_info_estudiantes">
  <div class="modal-dialog modal-lg" style="max-width: 80%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Ficha Tecnica del Estudiante</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_info_estudiantes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_editar_estudiantes">
  <div class="modal-dialog modal-lg" style="max-width: 80%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Actualziar Información del Estudiante</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_editar_estudiantes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
@endsection
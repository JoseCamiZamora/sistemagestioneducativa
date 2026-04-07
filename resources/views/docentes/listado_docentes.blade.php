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
	        <a href="{{ url('home') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->
   <script>
        @if(session('success'))
        
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Listo!',
                        text: '{{ session("success") }}',
                        timer: 2500,
                        showConfirmButton: false
                    });
                });
            
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Ups... algo salió mal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#e74a3b',
            });
        @endif
    </script>

	  <div class="row">
	    <div class="col" style="text-align: end;">
	      <a href="javascript:void(0);" onclick="IN_form_crear_new_docente();" class="mb-2 btn btn-sm btn-primary mr-1" ><i class="fa fa-user-plus margin-icon" aria-hidden="true" ></i>Registro Nuevo Docente</a>
	    </div>
	    
	  </div>
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
                <th scope="col" class="th-gris text-center " >Editar</th>
                <th scope="col" class="th-gris text-center " >Acción</th>
                
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
                    onclick="editarDocente({{$docente->id}})" role="button" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-edit" title="Editar Docente" style=""></i><br>
                      </div>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('docentes.toggle-status', $docente->id) }}" method="POST" class="form-toggle-status" style="display:inline;">
                        @csrf
                        @if($docente->estado == 'I')
                          {{-- Botón para ACTIVAR --}}
                              <button type="button"  class="btn btn-white btn-sm text-warning btn-status"
                                      title="Activar Docente" data-status="activar">
                                  <i class="fa fa-ban"></i>
                              </button>
                            
                        @else
                          {{-- Botón para INACTIVAR --}}
                            <button type="button" class="btn btn-white btn-sm text-success btn-status" 
                                    title="Inactivar Docente" data-status="inactivar">
                                <i class="fa fa-check-circle"></i>
                            </button>
                            
                        @endif
                    </form>
                  <td>
                 
                </tr>
              @endforeach
            </tbody>
               <tfoot>
              <tr>
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $lstDocentes->count() }} docentes </span></td>
              </tr>
              </tfoot>
          </table>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // 1. Lógica para Inactivar
    $(document).on('click', '.btn-status', function(e) {
        e.preventDefault();
        
        var formulario = $(this).closest('.form-toggle-status');
        var accion = $(this).data('status'); // 'activar' o 'inactivar'
        
        let titulo = accion === 'activar' ? '¿Deseas activar este docente?' : '¿Deseas inactivar este docente?';
        let texto = accion === 'activar' 
            ? "El docente volverá a aparecer en las listas de asignación activa." 
            : "El registro no se borrará para proteger el historial, pero no aparecerá en listas activas.";
        let icon = accion === 'activar' ? 'question' : 'warning';
        let confirmColor = accion === 'activar' ? '#28a745' : '#f6ad55';

        Swal.fire({
            title: titulo,
            text: texto,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                formulario.submit();
            }
        });
    });
</script>
@endsection
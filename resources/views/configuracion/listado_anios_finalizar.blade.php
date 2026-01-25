@extends('layouts.app')



@section('content')

<div class="container">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Configuracion </span>
	        <h4 class="page-title" >Listado de años lectivos de la institución<span style='font-size: 0.6em;'></span> </h4>
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
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
            <thead class="bg-light">
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 50px;">No.</th>
                <th scope="col" class="th-gris text-left" >Año en vigencia</th>
                <th scope="col" class="th-gris text-left" >Estado</th>
                <th scope="col" class="th-gris text-left" >Finalizado</th>
                <th scope="col" class="th-gris text-left" >Cantidad Periodos</th>
                <th scope="col" class="th-gris text-center " >Finalizar Año Escolar</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstAnios as $anio)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>{{$anio->anio_inicio}} - {{$anio->anio_fin}}</td>
                  <td class='td-titulo text-left'>
                    @if($anio->finalizado == 'NO')
                      Año Vigente
                    @else
                      Año Finalizado
                    @endif
                  </td>
                  <td class='td-titulo text-left'>{{ $anio->finalizado}}</td>
                  <td class='td-titulo text-left'>{{ $anio->cant_periodos}}</td>
                  <td>
                    @if($anio->finalizado == 'NO')
                      <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                        onclick="finalizarAnioEscolar({{$anio->id}})" role="button" id="subirfile" >
                        <div class="nav-link-icon__wrapper">
                          <i class="fa fa-flag-checkered" title="Finalizar Año Escolar" style=""></i><br>
                        </div>
                      </a>
                    @endif
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
               <tfoot>
              <tr>
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $lstAnios->count() }} Años configurados </span></td>
              </tr>
              </tfoot>
          </table>
          {{ $lstAnios->links() }}
	    </div> 
	  </div>
</div>
  <!-- End Default Light Table -->
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_anio">
  <div class="modal-dialog modal-lg" style="max-width: 60%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Crear Nuevo Año</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_anio" style='min-height: 260px;'>
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
@extends('layouts.app')



@section('content')


<div class="main-content-container container-fluid px-4 pb-4">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Configuracion </span>
	        <h4 class="page-title" >Listado de conceptos para evaluación<span style='font-size: 0.6em;'></span> </h4>
	       <div  class=" ml-auto" style="text-align: right; margin-top: -35px;">
	        Atrás
	        <a href="{{ url('configuracion/index_conceptos') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->
    @php
      use Illuminate\Support\Str;
    @endphp
	  <div class="row">
	    <div class="col">
        <a href="javascript:void(0);" onclick="IN_form_crear_new_concepto_trans();" class="mb-2 btn btn-sm btn-outline-primary mr-1" >
          <i class="fa fa-user-plus margin-icon" aria-hidden="true" ></i>Registrar Nuevo Concepto</a>
	    </div>
	  </div>
	  <div class="row">
	    <div class="col">
	    	<table  class='table table-generic table-strech table-font-normal table-hover' >
            <thead class="bg-light">
              <tr>
                <th scope="col" class="th-gris text-center" style="width: 50px;">No.</th>
                <th scope="col" class="th-gris text-left" >Año concepto</th>
                <th scope="col" class="th-gris text-left" >Grado</th>
                <th scope="col" class="th-gris text-left" >Periodo</th>
                <th scope="col" class="th-gris text-left " >Desempeño</th>
                <th scope="col" class="th-gris text-left " >Concepto</th>
                <th scope="col" class="th-gris text-center " >Editar</th>
                <th scope="col" class="th-gris text-center " >Borrar</th>
              </tr>
            </thead>
            <tbody>

             @foreach($lstConceptos as $concepto)
              <tr>
                <td class='text-center'>{{ $loop->index + 1 }}</td>
                <td class='td-titulo text-left'>{{ $concepto->nom_anio }}</td>
                <td class='td-titulo text-left'>{{ $concepto->nom_grado }}</td>
                <td class='td-titulo text-left'>{{ $concepto->nom_periodo }}</td>
                <td class='td-titulo text-left'>{{ $concepto->desempenio }}</td>

                <td class='td-titulo text-left' style="max-width: 550px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  {{ \Illuminate\Support\Str::limit($concepto->descripcion, 140) }}
                 <a href="javascript:void(0);" onclick="mostrarTextoCompleto({{ json_encode($concepto->descripcion) }})">Ver más</a>
                </td>

                <td>
                  <a class="nav-link nav-link-icon text-center" href="javascript:void(0);" onclick="editarconceptoTrans({{ $concepto->id }})">
                    <div class="nav-link-icon__wrapper">
                      <i class="fa fa-edit" title="Editar concepto"></i><br>
                    </div>
                  </a>
                </td>
                <td>
                  <a class="nav-link nav-link-icon text-center" href="javascript:void(0);" onclick="borrarconceptoTrans({{ $concepto->id }})">
                    <div class="nav-link-icon__wrapper">
                      <i class="fa fa-trash" title="Borrar concepto"></i><br>
                    </div>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
               <tfoot>
              <tr>
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $lstConceptos->count() }} Conceptos </span></td>
              </tr>
              </tfoot>
          </table>
          {{ $lstConceptos->links() }}
	    </div> 
	  </div>
</div>
  <!-- End Default Light Table -->
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_nuevo_concepto_trans">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Crear Nuevo Concepto</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">x</button>
      </div>
      <div class="modal-body" id="contenido_modal_nuevo_concepto_trans" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_editar_concepto_trans">
  <div class="modal-dialog modal-lg" style="max-width: 70%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Actualziar Concepto</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">x</button>
      </div>
      <div class="modal-body" id="contenido_modal_editar_concepto_trans" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalTextoConcepto">
  <div class="modal-dialog modal-lg" style="max-width: 40%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Texto concepto completo</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">X</button>
      </div>
      <div class="modal-body" id="contenido_modal_concepto" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
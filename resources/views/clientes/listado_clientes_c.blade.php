@extends('layouts.app')
@section('content')

<div class="main-content-container container-fluid px-4 pb-4">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Clientes </span>
	        <h4 class="page-title" >Listado clientes de compra de productos  <span style='font-size: 0.6em;'></span> </h4>
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
        <a  href="{{ url('clientes/listado_clientes/U') }}" class="mb-2 btn btn-sm btn-sacundary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Clientes para venta</a>
	      <a  href="{{ url('clientes/listado_clientes_c') }}" class="mb-2 btn btn-sm btn-primary mr-1 " ><i class="fa fa-users margin-icon" aria-hidden="true" ></i>Clientes para compra</a>
	      <a href="javascript:void(0);" onclick="IN_form_crear_cliente();" class="mb-2 btn btn-sm btn-outline-primary mr-1" ><i class="fa fa-user-plus margin-icon" aria-hidden="true" ></i>Crear nuevo cliente</a>
	    </div>
	    
	  </div>
	  <form  method="post"  action="{{ url('clientes/buscar_cliente_c') }}" id="f_buscar_cliente_c"   >
        <input type="hidden" name="_token" id='_token_avatar' value="<?php echo csrf_token(); ?>">    
          <div class="input-group mb-3">
            <input type="text" id='dato_buscadoDBP' name='dato_buscado' required class="form-control" style='background-color: white !important;' placeholder="Buscar clientes por identificación o nombres y apellidos aquí...." aria-label="Buscar insumo" aria-describedby="basic-addon2">
            <input type="hidden" id='busdbp_pagina' name='busdbp_pagina' value='1'  >
            <input type="hidden" id='busdbp_next' name='busdbp_next' value='0'  >
            <div class="input-group-append">
              <button class="btn btn-white" type="submit">Buscar</button>
              @if(isset($busqueda))
              <a href="{{ url('clientes/listado_clientes_c') }}" class="btn btn-white  btn-azul"   >
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
                <th scope="col" class="th-gris text-left" >Nro. Cedula</th>
                <th scope="col" class="th-gris text-left">Nombres y Apellidos</th>
                <th scope="col" class="th-gris text-center" >Telefono</th>
                <th scope="col" class="th-gris text-left" >Correo</th>
                <th scope="col" class="th-gris text-left " >Dirección</th>
                <th scope="col" class="th-gris text-left" >Ciudad</th>
                <th scope="col" class="th-gris text-center " >Editar</th>
              </tr>
            </thead>
            <tbody>

             @foreach($clientes as $cliente)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                 <td class='td-titulo text-left'>{{ $cliente->identificacion}}</td>
                  <td class='td-titulo text-left'  >{{ $cliente->nombre_cliente }}</td>
                  <td class='td-titulo text-center'  >{{ $cliente->telefono }}</td>
                  <td class='td-titulo text-left'  >{{ $cliente->email }}</td>
                  <td class='td-titulo text-left'  >{{ $cliente->direccion }}</td>
                  <td class='td-titulo text-left'  >{{ $cliente->ciudad }}</td>
                  <td>
                    <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);" 
                    onclick="editarcliente({{$cliente->id}})" role="button" id="subirfile" >
                      <div class="nav-link-icon__wrapper">
                        <i class="fa fa-edit" title="Editar Insumo" style=""></i><br>
                      </div>
                    </a>
                  </td>
                </tr>

              @endforeach
            </tbody>
               <tfoot>
              <tr>
                 
                   <td colspan='4'><span style='font-size:0.9em'><b>Total:</b> {{ $clientes->count() }} Productos</span></td>
                 
              </tr>
              </tfoot>
          </table>
          {{ $clientes->links() }}
	     
	    
	    </div> 

	  </div>

</div>
  <!-- End Default Light Table -->
</div>

<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_editar_cliente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Editar Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_editar_modal_clientes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modal_clientes">
  <div class="modal-dialog modal-lg" style="max-width: 65%;">
    <div class="modal-content">
      <div class="modal-header" id="datohtml">
        <h4 class="modal-title" id="titul_modal_usuarios">Crear nuevo cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="contenido_modal_clientes" style='min-height: 260px;'>
      </div>
    </div>
  </div>
</div>
@endsection
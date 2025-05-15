<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row ">
                        <div class="col-md-6">
                            <img src="http://via.placeholder.com/400x90?text=logo">
                        </div>
                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4 p-1 mr-5">Factura código:  {{ $facturaCompra->codigo_factura  ?? 0 }}</p>
                           
                        </div>
                    </div>

                    <hr class="my-0">

                    <div class="row pb-5 p-5">

                        <div class="col-md-4">
                          <p class="font-weight-bold mb-4">Factura código:  {{ $facturaCompra->codigo_factura  ?? 0 }}</p>
                             <p class="mb-1"><span class="text-muted">Fecha Expedición: </span>  {{ $facturaCompra->fecha_expedicion_fac ?? 0 }}</p>
                            <p class="mb-1"><span class="text-muted">Fecha Ingreso: </span>{{ $facturaCompra->fecha_ingreso ?? 0 }}</p>
                            <p class="mb-1"><span class="text-muted">Sede / planta: </span>{{ $facturaCompra->sede_planta ?? 0 }}</p>
                           
                        </div>

                        <div class="col-md-4">
                            <p class="font-weight-bold mb-4">Información Proveedor</p>
                            <p class="mb-1">Proveedor: {{ $facturaCompra->nombre_proveedor ?? 0 }}</p>
                            <p class="mb-1">NIT : {{ $facturaCompra->nit_proveedor ?? 0 }}</p>
                           
                        </div>

                        <div class="col-md-4 text-right">
                            <p class="font-weight-bold mb-4">Información Cliente</p>
                            <p class="mb-1"><span class="text-muted">Nombre: </span>  {{ $facturaCompra->nombre_cliente ?? 0 }}</p>
                            <p class="mb-1"><span class="text-muted">Identificación: </span>{{ $facturaCompra->identificacion_cliente ?? 0 }}</p>
                            <p class="mb-1"><span class="text-muted">Dirección: </span>{{ $facturaCompra->direccion_cliente ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="row p-5">

                    	<div class="col-md-12">
                            <p class="font-weight-bold mb-4">Información Insumos / Productos</p>
                        
                           
                        </div>

                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">No.</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Código</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Descripción</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Cantidad</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unidad</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">kilos</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">V. Unitario</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">V. Bruto</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Iva</th>
                                         <th class="border-0 text-uppercase small font-weight-bold">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>


						        	@foreach($insumosSEL as $insSEL)
						        	<?php  $rowcount=$loop->index+1; ?>
                                    <tr>
                                        <td>{{ $rowcount }}</td>
                                        <td>{{  $insSEL->codigo ?? 0 }}</td>
                                        <td>{{  $insSEL->insumo ?? "" }}</td>
                                        <td>{{  $insSEL->cantidad ?? 0 }}</td>
                                        <td>{{  $insSEL->unidad ?? "" }}</td>
                                        <td>{{  $insSEL->kilos ?? 0 }}</td>
                                        <td>{{  number_format( $insSEL->valor_unitario , 2,',' , '.')  ?? 0 }}</td>
                                        <td>{{  number_format( $insSEL->valor_bruto  , 2,',' , '.')  ?? 0 }}</td>
                                        <td>{{ number_format( $insSEL->iva , 2,',' , '.' ) ?? 0 }}</td>
                                         <td>{{  number_format( $insSEL->valor_total , 2,',' , '.' ) ?? 0 }}</td>
                                    </tr>
                                   

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse text-white p-4" style="background-color: #c0c8d3 !important;">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-weight-bold">Gran Total</div>
                            <div class="h4 font-weight-bold">${{  number_format( $facturaCompra->total , 2,',' , '.' )  ?? 0 }}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-weight-bold">Iva</div>
                            <div class="h4 font-weight-bold">${{ number_format(  $facturaCompra->total_iva , 2,',' , '.' )  ?? 0 }}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2 font-weight-bold">Subtotal</div>
                            <div class="h4 font-weight-bold">${{ number_format(  $facturaCompra->total_vbruto , 2,',' , '.' ) ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-light mt-5 mb-5 text-center small">sistema facturación {{ date('Y-m-d')}}</div>

</div>
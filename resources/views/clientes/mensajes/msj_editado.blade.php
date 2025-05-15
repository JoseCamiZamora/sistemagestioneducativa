<div class='aprobado' style="margin-top:70px; text-align: center">
  <span class="label label-success">Cliente Actualizado<i class="fa fa-check"></i></span><br/>

<label style='color:#177F6B'>
              <?php  echo $msj; ?> 
</label> 
</div>
 <div class="margin" style="margin-top:50px; text-align:center;margin-bottom: 50px;">
  	<div class="btn-group" >
  		@if($estado == 'C')
    	<a href="{{ url('clientes/listado_clientes_c') }}" class="btn btn-xs btn-primary waves-effect waves-light"    value=" "  > Listado clientes </a>
    	@else
    	<a href="{{ url('clientes/listado_clientes/U') }}" class="btn btn-xs btn-primary waves-effect waves-light"    value=" "  > Listado clientes </a>
    	@endif
 	</div>
 </div> 
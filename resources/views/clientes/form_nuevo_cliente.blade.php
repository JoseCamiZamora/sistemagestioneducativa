<form  method="post"  action="nuevo_cliente" id="f_nuevo_cliente"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id" name="id" value="">
   <input type="hidden" id="estado" name="estado" value=""> 
    <div class="form-row">
    
      <div class="col-md-3">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento" name="tipoDocumento" style="margin-top: -6px; height: 33px;padding-top: 4px;" onchange="esEmpresa(this.value);" required>
            <option value="" selected >Seleccione...</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-3">
        <label for="feLastName">Numero identificación</label>
        <input type="text" maxlength="12" class="form-control" id="identificacion" name="identificacion"  
        value="" required >
      </div>
      <div class="form-group col-md-1">
        <label for="feLastName">Dv</label>
        <input type="text" maxlength="1" class="form-control" id="dv" name="dv"  
        value="" disabled >
      </div>
      <div class="form-group col-md-5">
        <label for="feLastName">Nombres y apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombre_cliente" name="nombre_cliente" 
        value="" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono" name="telefono" value="" >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Correo electrónico</label>
        <input type="text" maxlength="125" class="form-control" id="email" name="email" value=""  required>
      </div>
     <div class="form-group col-md-6">
        <label for="feLastName">Dirección</label>
        <input type="text" maxlength="125" class="form-control" id="direccion" name="direccion" 
        value=""  >
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-4">
          <label for="feLastName">Departamento</label>
          <select class="form-control" id="departamento" name="departamento"  onchange="cargar_ciudades(this.value);" required>
            <option value="" selected >Seleccione...</option>
              @foreach($lstDepartamentos as $tipo)
                <option value="{{$tipo->cod_departamento}}">{{$tipo->departamento}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-4" >
         <label for="feLastName">Ciudad</label>
          <select class="form-control" id="ciudad" name="ciudad" required>
            <option value="0" selected >Seleccione...</option>
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Sector</label>
          <select class="form-control" id="sector" name="sector" required>
            <option value="0" selected >Seleccione...</option>
            <option value="U" >Urbano</option>
            <option value="R" >Rural</option>
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Tipo cliente</label>
          <select class="form-control" id="tipo" name="tipo" required>
            <option value="0" selected >Seleccione...</option>
            <option value="V">VENTA</option>
            <option value="C">COMPRA</option>
          </select>
      </div>
    </div>
      <br>
    <button type="submit" class="btn btn-accent" >Guardar datos</button>
</form>
<script>
     var VARCIUDADES = @json($lstTotalCodPostal);
</script>



                    
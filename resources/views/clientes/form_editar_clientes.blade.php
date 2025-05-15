<form  method="post"  action="editar_cliente" id="f_editar_cliente"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id" name="id" value="{{$cliente->id}}">
   <input type="hidden" id="estado" name="estado" value="{{$cliente->estado}}"> 
    <div class="form-row">
       <div class="col-md-3">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento" name="tipoDocumento" style="margin-top: -6px; height: 33px;padding-top: 4px;" onchange="esEmpresa(this.value);">
            <option value="{{$tipo_Docuemnto->codigo}}" selected >{{$tipo_Docuemnto->descripcion}}</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-3">
        <label for="feLastName">Numero Identificación</label>
        <input type="text" maxlength="12" class="form-control" id="identificacion" name="identificacion"value="{{$cliente->identificacion}}" required >
      </div>
       <div class="form-group col-md-1">
        <label for="feLastName">Dv</label>
         @if($cliente->cliente == '')
          <input type="text" maxlength="1" class="form-control" id="dv" name="dv" value="{{$cliente->dv}}" disabled >
         @else
          <input type="text" maxlength="1" class="form-control" id="dv" name="dv" value="{{$cliente->dv}}" >
         @endif
      </div>
      <div class="form-group col-md-5">
        <label for="feLastName">Nombres y apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombre_cliente" name="nombre_cliente" value="{{$cliente->nombre_cliente}}" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono" name="telefono" value="{{$cliente->telefono}}" >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Correo electronico</label>
        <input type="text" maxlength="125" class="form-control" id="email" name="email" value="{{$cliente->email}}"  required>
      </div>
      <div class="form-group col-md-6">
        <label for="feLastName">Dirección</label>
        <input type="text" maxlength="125" class="form-control" id="direccion" name="direccion" 
        value="{{$cliente->direccion}}" >
      </div>
      <div class="col-md-4">
        <label for="feLastName">Departamento</label>
          <select class="form-control" id="departamento" name="departamento"  onchange="cargar_ciudades(this.value);" required>
              @foreach($lstDepartamentos as $tipo)
                @if($cliente->cod_departamento == $tipo->cod_departamento)
                  <option value="{{$tipo->cod_departamento}}" selected>{{$tipo->departamento}}</option>
                @else
                  <option value="{{$tipo->cod_departamento}}">{{$tipo->departamento}}</option>
                @endif
              @endforeach
          </select>
      </div>
      <div class="col-md-4" >
         <label for="feLastName">Ciudad</label>
          <select class="form-control" id="ciudad" name="ciudad" required>
            @foreach($lstciudades as $citi)
              @if($cliente->ciudad == $citi->municipio)
                <option value="{{$citi->municipio}}" selected>{{$citi->municipio}}</option>
              @else
                <option value="{{$citi->municipio}}">{{$citi->municipio}}</option>
              @endif
            @endforeach
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Sector</label>
          <select class="form-control" id="sector" name="sector" required>
            @if($cliente->sector == 'U')
              <option value="U" selected>URBANO</option>
              <option value="R" >RURAL</option>
              <option value="0" >Seleccione...</option>
            @else
              <option value="U" >URBANO</option>
              <option value="R" selected>RURAL</option>
              <option value="0" >Seleccione...</option>
            @endif
          </select>
      </div>
      <div class="col-md-2">
         <label for="feLastName">Tipo cliente</label>
          <select class="form-control" id="tipo" name="tipo" required >
            @if($cliente->tipo == "C")
              <option value="C" selected>COMPRA</option>
            @esle
              <option value="V" selected>VENTA</option>
            @endif
          </select>
      </div>
    </div>
    <br>
    <button type="submit" class="btn btn-accent" >Actualizar datos</button>
</form>
<script>
     var VARCIUDADES = @json($lstTotalCodPostal);
</script>
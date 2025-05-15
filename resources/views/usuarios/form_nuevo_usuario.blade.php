

<form  method="post"  action="nuevo_usuario" id="f_crear_usuario"   >
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="feLastName">Nombres</label>
      <input type="text" maxlength="100" class="form-control" id="nombres" name="nombres"  value="">
    </div>
    <div class="form-group col-md-3">
      <label for="feLastName">Nro. Identificación</label>
      <input type="text" maxlength="10" class="form-control" id="identificacion" name="identificacion" value="" >
    </div>
      <div class="form-group col-md-3">
      <label for="feLastName">Teléfono</label>
      <input type="text" maxlength="10" class="form-control" id="telefono" name="telefono" value="" >
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="feInputCity">Rol del Usuario</label>
      <select class="form-control" name="rol" >
        <option value="">Seleccione...</option>
        <option value="1">Administrador del sistema</option>
        <option value="2">Docente</option>
        <option value="3">Estudiante</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="feLastName">email</label>
      <input type="email" maxlength="255" class="form-control" id="email" name="email"  value="" required>
    </div>
      <div class="form-group col-md-6">
      <label for="feFirstName">password*</label>
      <input type="password" maxlength="100" class="form-control" id="password" name="password"  value="" required>
    </div>
  </div>

    @if ($errors->count() > 0)
  <div class="alert alert-danger">
    
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  <br>
  <div class="form-group col-md-12 text-center">
    <button type="submit" class="btn btn-accent text-center"  >Guardar Datos</button>
  </div>
</form>


                    
<style>
    .datepicker {
        border-radius: 0rem !important;
        direction: ltr;
    }

    .datepicker {
        font-size: .85rem;
        padding: 0px !important;
        border-radius: 0rem !important;
        direction: ltr;
        border: 1px solid #9b9ba8;
        width: 139.2px;
    }

    .ui-timepicker-standard {

        z-index: 9999 !important;
    }

    .seleccionada {
        background-color: yellow; /* Cambia el color de fondo */
        font-weight: bold; /* Hace el texto en negrita */
    }

    .sugerencias {
        position: absolute; /* ✅ Hace que la lista se superponga */
        background: white;
        border: 1px solid #ccc;
        list-style: none;
        padding: 5px;
        width: 200px;
        max-height: 150px;
        overflow-y: auto;
        z-index: 1000; /* ✅ Asegura que la lista esté por encima de otros elementos */
        box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
        display: none; /* ✅ Se oculta inicialmente */
    }   
</style>
<form  method="post"  action="nuevo_estudiante" id="f_nuevo_estudiante"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id" name="id" value="">
   <input type="hidden" id="estado" name="estado" value=""> 
   <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS BASICOS DEL ESTUDIANTE</label>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipoDocumento" name="tipoDocumento" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
            <option value="" selected >Seleccione...</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-3">
        <label for="feLastName">Nro. Identificación</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="identificacion" name="identificacion"  
        value="" required >
      </div>
      <div class="form-group col-md-3">
        <label for="feLastName">Lugar de Expedición</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="lugar_expedicion" name="lugar_expedicion"  
        value="" required >
      </div>
      <div class="form-group col-md-2" >
        <label for="feLastName">Fecha Nacimiento</label><spam style="color: red;"> * </spam>
        <input  class="form-control datepicker"   name="fecha_nacimiento" required 
         style="height: 32px">
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Lugar de Nacimiento</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="lugar_nacimeinto" name="lugar_nacimeinto"  
        value="" required >
      </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="form-group col-md-2">
        <label for="feLastName">Primer Nombre</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="primer_nombre" name="primer_nombre" 
        value="" required>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Segundo Nombre</label>
        <input type="text" maxlength="125" class="form-control" id="segundo_nombre" name="segundo_nombre" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Primer Apellido</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="primer_apellido" name="primer_apellido" 
        value="" required>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Segundo Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="segundo_apellido" name="segundo_apellido" 
        value="" >
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Genero</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="genero" name="genero" style="margin-top: -6px; height: 33px;padding-top: 4px;"  required>
            <option value="" selected >Seleccione...</option>
            <option value="MASCULINO" >MASCULINO</option>
            <option value="FEMENINO" >FEMENINO</option>
            <option value="NO BINARIO" >NO BINARIO</option>
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Tipo De Sangre(RH)</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="rh" name="rh" style="margin-top: -6px; height: 33px;padding-top: 4px;"  required>
            <option value="" selected >Seleccione...</option>
            <option value="A+" >A+</option>
            <option value="A-" >A-</option>
            <option value="B+" >B+</option>
            <option value="B-" >B-</option>
            <option value="AB+" >AB+</option>
            <option value="AB-" >AB-</option>
            <option value="O+" >O+</option>
            <option value="O-" >O-</option>
          </select>
      </div>
    </div>
    <br>
    <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS DE UBICACION Y CONTACTO</label>
    </div>
    <div class="form-row col-md-12 mt-2">
      <div class="form-group col-md-2">
        <label for="feLastName">Nacionalidad</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nacionalidad" name="nacionalidad" 
        value="" required >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Dirección Recidencia</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="direccion" name="direccion" 
        value=""  required>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Barrio</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="barrio" name="barrio" 
        value=""  required>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Comuna</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="comuna" name="comuna" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
            <option value="0" selected >Seleccione...</option>
            <option value="Comuna 1" >Comuna 1</option>
            <option value="Comuna 2" >Comuna 2</option>
            <option value="Comuna 3" >Comuna 3</option>
            <option value="Comuna 4" >Comuna 4</option>
            <option value="Comuna 5" >Comuna 5</option>
            <option value="Comuna 6" >Comuna 6</option>
            <option value="Comuna 7" >Comuna 7</option>
            <option value="Comuna 8" >Comuna 8</option>
            <option value="Comuna 9" >Comuna 9</option>
            <option value="Comuna 10" >Comuna 10</option>
            <option value="Comuna 11" >Comuna 11</option>
            <option value="Comuna 12" >Comuna 12</option>
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Corregimiento</label>
        <input type="text" maxlength="125" class="form-control" id="corregimiento" name="corregimiento" 
        value=""  >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Vereda</label>
        <input type="text" maxlength="125" class="form-control" id="vereda" name="vereda" 
        value=""  >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="telefono" name="telefono" value="" required >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Correo electrónico</label>
        <input type="text" maxlength="125" class="form-control" id="email" name="email" value="" >
      </div>
    </div>
    <br>
    <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS BASICOS PADRE/MADRE O ACUDIENTE</label>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2" >
         <label for="feLastName">Parentesco</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="parentesco1" name="parentesco1" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
            <option value="" selected >Seleccione...</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipoDocumento1" name="tipoDocumento1" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
            <option value="" selected >Seleccione...</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion1" name="nro_identificacion1" 
        value="" required>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y apellidos</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nombres1" name="nombres1" 
        value="" required>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion1" name="ocupacion1" 
        value="" required>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="telefono1" name="telefono1" value="" >
      </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2" >
         <label for="feLastName">Parentesco</label>
          <select class="form-control" id="parentesco2" name="parentesco2" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento2" name="tipoDocumento2" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion2" name="nro_identificacion2" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombres2" name="nombres2" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion2" name="ocupacion2" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono2" name="telefono2" value="" >
      </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2" >
         <label for="feLastName">Parentesco</label>
          <select class="form-control" id="parentesco3" name="parentesco3" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
            <option value="Padre" >Padre</option>
            <option value="Madre" >Madre</option>
            <option value="Acudiente" >Acudiente</option>
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label>
          <select class="form-control" id="tipoDocumento3" name="tipoDocumento3" style="margin-top: -6px; height: 33px;padding-top: 4px;" >
            <option value="" selected >Seleccione...</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->codigo}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label>
        <input type="text" maxlength="125" class="form-control" id="nro_identificacion3" name="nro_identificacion3" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombres y Apellidos</label>
        <input type="text" maxlength="125" class="form-control" id="nombres3" name="nombres3" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Ocupación</label>
        <input type="text" maxlength="125" class="form-control" id="ocupacion3" name="ocupacion3" 
        value="" >
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label>
        <input type="text" maxlength="12" class="form-control" id="telefono3" name="telefono3" value="" >
      </div>
    </div>
    <br>
    <div class="form-row" style="background-color: #66d1ea">
      <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS ADICIONALES</label>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-3" >
          <label for="feLastName">Cuenta Con Alguna Discapacidad</label><spam style="color: red;"> * </spam>
            <select class="form-control" id="discapaciadad" style="margin-top: -6px; height: 33px;padding-top: 4px;"name="discapaciadad" >
              <option value="" selected >Seleccione...</option>
              <option value="SI" >SI</option>
              <option value="NO" >NO</option>
            </select>
        </div>
        <div class="form-group col-md-9">
          <label for="feLastName">Describa la Discapacidad</label>
          <input type="text" maxlength="125" class="form-control" id="desc_discapacidad" name="desc_discapacidad" 
          value="" >
        </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-2 " >
         <label for="feLastName">Tipo Seguridad Social</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="seguridad_social" name="seguridad_social" style="margin-top: -6px; height: 33px;padding-top: 4px;"  required>
            <option value="" selected >Seleccione...</option>
            <option value="Subcidiado" >Subcidiado</option>
            <option value="Contributivo" >Contributivo</option>
            <option value="No_tiene" >No Tiene</option>
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nombre EPS</label>
        <input type="text" maxlength="125" class="form-control" id="eps" name="eps" value=""  >
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Sisben</label>
          <select class="form-control" id="sisben" style="margin-top: -6px; height: 33px;padding-top: 4px;"name="sisben" >
            <option value="" selected >Seleccione...</option>
            <option value="Grupo A" >Grupo A</option>
            <option value="Grupo B" >Grupo B</option>
            <option value="Grupo C" >Grupo C</option>
            <option value="Grupo D" >Grupo D</option>
            <option value="No Aplica" >No Aplica</option>
          </select>
      </div>
      <div class="col-md-2" >
         <label for="feLastName">Estrato</label>
          <select class="form-control"  style="margin-top: -6px; height: 33px;padding-top: 4px;" id="estrato" name="estrato" >
            <option value="" selected >Seleccione...</option>
            <option value="Nivel 1" >Nivel 1</option>
            <option value="Nivel 2" >Nivel 2</option>
            <option value="Nivel 3" >Nivel 3</option>
            <option value="Nivel 4" >Nivel 4</option>
            <option value="Nivel 5" >Nivel 5</option>
            <option value="No Aplica" >No Aplica</option>
          </select>
      </div>
      <div class="col-md-4" >
        <label for="feLastName">Vacunas Recibidas</label>
        <div style="display: flex; gap: 20px; align-items: center;">
          <label><input type="checkbox" name="vacunas[]" value="DPT"> DPT</label>
          <label><input type="checkbox" name="vacunas[]" value="T.VIRAL"> T.VIRAL</label>
          <label><input type="checkbox" name="vacunas[]" value="POL"> POL</label>
          <label><input type="checkbox" name="vacunas[]" value="SAR"> SAR</label>
          <label><input type="checkbox" name="vacunas[]" value="BCB"> BCB</label>
          <label><input type="checkbox" name="vacunas[]" value="HIB"> HIB</label>
          <label><input type="checkbox" name="vacunas[]" value="H.V."> H.V.</label>
        </div>
      </div>
     </div>
     
    <div class="form-row col-md-12 mt-3">
      <div class="col-md-6 " >
         <label for="feLastName">Poblacion Victima de Conflicto</label>
          <select class="form-control" id="victima_conflicto" name="victima_conflicto" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
            <option value="" selected >Seleccione...</option>
            <option value="SI" >SI</option>
            <option value="NO" >NO</option>
          </select>
      </div>
      <div class="col-md-6 " >
         <label for="feLastName">Población Desmovilizada de Conlicto Armado</label>
          <select class="form-control" id="pob_des_conflicto" name="pob_des_conflicto" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
            <option value="" selected >Seleccione...</option>
            <option value="SI" >SI</option>
            <option value="NO" >NO</option>
          </select>
      </div>
    </div>
    <div class="form-row col-md-12 mt-3">
      <div class="form-group col-md-12">
        <label for="feLastName">Observaciones Adicionales</label>
        <textarea id="observaciones" name="observaciones" rows="3" cols="33" maxlength="200" style="width: 100%;" ></textarea>
      </div>
    </div>
    <br>
    <div class="form-row col-md-12 mt-3  text-center">
      <button type="submit" class="btn btn-accent text-center" >Guardar Información Matricula</button>
    </div>
</form>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>
<script>
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  $('.datepicker').datepicker({
      startDate: ''
  });
  if ($.fn.dropdown) {
        $('.dropdown-mul-1').dropdown({
            readOnly: false,
            limitCount: 40,
            multipleMode: 'label',
            choice: function() {
            }
        });

    }
</script>





                    
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
<form  method="post"  action="editar_docente" id="f_editar_docente"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id_docente" name="id_docente" value="{{$docente->id}}">
   <input type="hidden" id="estado" name="estado" value="A"> 
  
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-2">
          <label for="feLastName">Tipo documento</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipoDocumento" name="tipoDocumento" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="{{$docente->id_tipo_documento}}">{{$docente->tipo_documento}}</option>
              @foreach($tiposDocumentos as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group col-md-2">
        <label for="feLastName">Nro. Identificación</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="identificacion" name="identificacion"  
        value="{{$docente->nro_documento}}" required >
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Nombres</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="nombres" name="nombres" 
        value="{{$docente->nombres}}" required>
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Apellidos</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="apellidos" name="apellidos" 
        value="{{$docente->apellidos}}" required>
      </div>
    </div>
    <div class="form-row col-md-12 mt-2">
      <div class="form-group col-md-2">
        <label for="feLastName">Telefono</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="12" class="form-control" id="telefono" name="telefono" value="{{$docente->telefono}}" required >
      </div>
      <div class="form-group col-md-6">
        <label for="feLastName">Dirección Recidencia</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="direccion" name="direccion" 
        value="{{$docente->direccion}}"  required>
      </div>
      <div class="form-group col-md-4">
        <label for="feLastName">Correo electrónico</label><spam style="color: red;"> * </spam>
        <input type="text" maxlength="125" class="form-control" id="email" name="email" value="{{$docente->correo}}" required>
      </div>
    </div>
    </div>
    <br>
   
    <div class="form-row col-md-12 mt-2  text-center">
      <button type="submit" class="btn btn-accent text-center" >Actualziar Información Docente</button>
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
<script>
  
</script>





                    
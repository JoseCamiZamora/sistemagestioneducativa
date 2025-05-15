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
    .espaciado-checkbox {
      margin-right: 3.0rem; /* Ajusta según tu gusto */
      margin-bottom: 0.5rem;
    }
</style>

<form  method="post" action="adicionar_nueva_periodo" id="f_adicionar_nuevo_periodo">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
  <input type="hidden" id="id_periodo" name="id_periodo" value="">
  <div class="form-row col-md-12">
    <div class="form-group col-md-12">
      <label for="feLastName">Nombre Periodo</label><spam style="color: red;"> * </spam>
      <input type="text" style="text-transform: uppercase;" maxlength="100" class="form-control" id="periodo" name="periodo"  
      value="" required >
    </div>
  </div>
    <div class="col-md-12" style="margin-top: 10px;te">
      <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:block">Agregar nuevo periodo</button>
    </div>
</form>
<script>
    
</script>





                    
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

<form  method="post" action="editar_materia" id="f_editar_materia">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
  <input type="hidden" id="id_materia" name="id_materia" value="{{$materia->id}}">
  <div class="form-row col-md-12">
    <div class="form-group col-md-6">
      <label for="feLastName">Nombre Materia</label><spam style="color: red;"> * </spam>
      <input type="text" style="text-transform: uppercase;" maxlength="50" class="form-control" id="materia" name="materia"  
      value="{{$materia->nombre}}" required >
    </div>
    <div class="col-md-4">
          <label for="feLastName">Tipo curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipo" name="tipo" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
              <option value="{{$materia->tipo_curso}}">{{$materia->nom_clasificacion}}</option>
              @foreach($lstClasificaciones as $clas)
                <option value="{{$clas->id}}">{{$clas->nombre}}</option>
              @endforeach
          </select>
    </div>
    <div class="form-group col-md-2">
      <label for="feLastName">Intensidad Horas</label><spam style="color: red;"> * </spam>
      <input type="number" maxlength="2" class="form-control" id="instensidad_horas" name="instensidad_horas"
      value="{{$materia->intensidad_horas}}" required >
    </div>
  </div>
    <div class="col-md-12" style="margin-top: 10px;te">
      <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:block">Actualziar la materia</button>
    </div>
</form>
<script>
    
</script>





                    
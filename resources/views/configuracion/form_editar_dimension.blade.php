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

<form  method="post" action="editar_dimension" id="f_editar_dimension">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <input type="hidden" id="id_docente" name="id_docente" value="{{$docente->id_docente}}">
  <input type="hidden" id="id_dimension" name="id_dimension" value="{{$dimension->id}}">
  <div class="col-md-4">
        <label for="feLastName">Nombre Del Docente:</label>
        <input  class="form-control "   name="nom_estudiante" value="{{$docente->nom_completo}}" required style="margin-top: -6px;" disabled>
      </div>
   <div class="form-row col-md-12 mt-2">
      
      <div class="col-md-4">
          <label for="feLastName">Materia</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="materia" name="materia" required>
             <option value="{{$dimension->id_materia}}">{{$dimension->nom_materia}}</option>
              @foreach($materias as $materia)
                @if($materia->id != $dimension->id_materia)
                  <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                @endif
              @endforeach
          </select>
      </div>
       <div class="col-md-4">
          <label for="feLastName">Peridos</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo" required>
             <option value="{{$dimension->id_periodo}}" selected >{{$dimension->nom_periodo}}</option>
              @foreach($periodos as $periodo)
                @if($periodo->id != $dimension->id_periodo)
                  <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
                @endif
              @endforeach
          </select>
      </div>
      <div class="col-md-4">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso"  required disabled>
            <option value="1" selected>TRANSICION</option>
          </select>
      </div>
    </div>
    <div class="form-row col-md-12 mt-2">
        <textarea id="dimension" name="dimension" rows="6" maxlength="2000" style="width: 100%;font-size: 15px;">{{$dimension->descripcion}}</textarea>
    </div>
    <br>
    <div class="col-md-12" style="margin-top: 10px;te">
      <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:block">Actualizar Dimension</button>
    </div>
</form>
<script>
    
</script>





                    
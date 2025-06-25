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

<form  method="post" action="nuevo_concepto" id="f_nuevo_concepto">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <input type="hidden" id="id_docente" name="id_docente" value="{{$docente->id}}">
   <div class="form-row col-md-12 mt-2">
      <div class="col-md-3">
          <label for="feLastName">Año Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio" name="anio"  required onchange="infoMateriasConcepto(this.value,{{$docente->id}})">
            <option value="" selected >Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Materia</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="materia" name="materia" required disabled onchange="infoCursosConcepto(this.value,{{$docente->id}})">
            <option value="" selected >Seleccione...</option>
              @foreach($materias as $materia)
                <option value="{{$materia->id}}">{{$materia->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso"  required disabled>
            <option value="" selected >Seleccione...</option>
              @foreach($cursos as $grado)
                <option value="{{$grado->id}}">{{$grado->nombre}}</option>
              @endforeach
          </select>
      </div>
      
      <div class="col-md-3">
          <label for="feLastName">Periodo</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($periodos as $periodo)
                <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-2">
          <label for="feLastName">Desempeño</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="desempenio" name="desempenio"  required>
            <option value="" selected >Seleccione...</option>
            <option value="Superior">Superior</option>
            <option value="Alto">Alto</option>
            <option value="Básico">Básico</option>
            <option value="Bajo">Bajo</option>
          </select>
      </div>
    </div>
    <div class="form-row col-md-12 mt-2">
        <textarea id="conceptos" name="conceptos" rows="6" maxlength="2000" style="width: 100%;font-size: 15px;"></textarea>
    </div>
    <br>
    <div class="col-md-12" style="margin-top: 10px;te">
      <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:block">Guardar Concepto</button>
    </div>
</form>
<script>
    
</script>





                    
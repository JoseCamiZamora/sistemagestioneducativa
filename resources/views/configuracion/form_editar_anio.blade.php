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

<form  method="post" action="adicionar_editar_anio" id="f_adicionar_editar_anio" >
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
  <input type="hidden" id="id_anio" name="id_anio" value="{{$anio->id}}">
  <div class="form-row col-md-12 mt-2">
    <div class="col-md-3">
        <label for="feLastName">Año Inicio</label><spam style="color: red;"> * </spam>
        <select class="form-control" id="anio_inicio" name="anio_inicio"  style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="{{$anio->anio_inicio}}" selected>{{$anio->anio_fin}}</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="feLastName">Año Final</label><spam style="color: red;"> * </spam>
        <select class="form-control" id="anio_final" name="anio_final"  style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
        <option value="{{$anio->anio_inicio}}" selected>{{$anio->anio_fin}}</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
        </select>
    </div>
    <div class="col-md-10" style="margin-top: 10px;">
      <h5>Selecciona los periodos configurados en el sistema</h5>
      <div class="d-flex flex-wrap gap-2 gap-md-3">
          @foreach($periodos as $periodo)
            <div class="form-check espaciado-checkbox">
              <input 
                class="form-check-input periodo-checkbox" 
                type="checkbox" 
                value="{{ $periodo->id }}" 
                id="periodo{{ $periodo->id }}" 
                name="periodos[]"
                {{ in_array($periodo->id, $periodosSeleccionados ?? []) ? 'checked' : '' }}
              >
              <label class="form-check-label" for="periodo{{ $periodo->id }}">
                {{ $periodo->nombre }}
              </label>
            </div>
          @endforeach
        </div>
    </div>
    <hr>
    <div class="col-md-10" style="margin-top: 10px;">
      <h5>Selecciona las actividades a evaluar</h5>
      <div class="d-flex flex-wrap gap-2 gap-md-3">
        @foreach($tiposEvaluacion as $actividad)
            <div class="form-check espaciado-checkbox">
              <input 
                class="form-check-input actividad-checkbox" 
                type="checkbox" 
                value="{{ $actividad->id }}" 
                id="actividad{{ $actividad->id }}" 
                name="actividad[]"
                {{ in_array($actividad->id, $materiasSeleccionados ?? []) ? 'checked' : '' }}
              >
              <label class="form-check-label" for="actividad{{ $actividad->id }}">
                {{ $actividad->descripcion }}
              </label>
            </div>
          @endforeach
        </div>
    </div>
    <hr>
    <div class="col-md-10" style="margin-top: 10px;">
      <h5>Selecciona los Cursos</h5>
      <div class="d-flex flex-wrap gap-2 gap-md-3">
        @foreach($grados as $curso)
            <div class="form-check espaciado-checkbox">
              <input 
                class="form-check-input curso-checkbox" 
                type="checkbox" 
                value="{{ $curso->id }}" 
                id="curso{{ $curso->id }}" 
                name="cursos[]"
                {{ in_array($curso->id, $gradosSeleccionados ?? []) ? 'checked' : '' }}
              >
              <label class="form-check-label" for="curso{{ $curso->id }}">
                {{ $curso->nombre }}
              </label>
            </div>
          @endforeach
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 10px;">
      <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:block">Actualizar Año</button>
    </div>
  </div>
</form>
<script>
    
</script>





                    
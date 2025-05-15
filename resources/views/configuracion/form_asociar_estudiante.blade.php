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

<form  method="post" action="adicionar_curso_estudiante" id="f_adicionar_curso_estudiante">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
<input type="hidden" id="id_estudiante" name="id_estudiante" value="{{$estudiante->id}}">
    <div class="form-row col-md-12 mt-2">
      <div class="form-group col-md-12">
        <label for="feLastName">Nombre Del Estudiante:</label>  
        <h4>{{$estudiante->primer_nombre}} {{$estudiante->segundo_nombre}} {{$estudiante->primer_apellido}} {{$estudiante->segundo_apellido}} </h4> 
      </div>
      <div class="col-md-3">
          <label for="feLastName">Año Escolar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio_escolar" name="anio_escolar"  style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="">Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Tipo Grado</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipo_grado" name="tipo_grado" onchange="infoGrados(this.value)" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
              <option value="">Seleccione...</option>
              @foreach($lstClasificaciones as $clas)
                <option value="{{$clas->id}}">{{$clas->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso Escolar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso" style="margin-top: -6px; height: 33px;padding-top: 4px;" required disabled>
          <option value="">Seleccione...</option>
              @foreach($grados as $curso)
                <option value="{{$curso->id}}">{{$curso->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
        <button type="submit" class="btn btn-success" id="btn_actualizar" style="margin-top: 25px;">Matricular Curso</button>
      </div>
    </div>
    <br>
    <div class="modal-footer">
      <div class="modal-body" style="margin-top: -35px;">
        <h4 style="text-align: center;">Historial de cursos matriculados</h4>
        <!-- Tabla -->
        <div class="table-responsive">
          <table class="table table-bordered" id="miTabla">
            <thead>
              <tr>
                <th>Nro.</th>
                <th>Año</th>
                <th>Tipo Grado</th>
                <th>Curso</th>
                <th style="text-align: center;">Borrar</th>
              </tr>
            </thead>
            <tbody id="tablaMaterias">
              @foreach($historialGrados as $curso)
                <tr>
                  <td class='text-center' >{{ $loop->index+1 }}</td>
                  <td class='td-titulo text-left'>{{ $curso->desc_anio}}</td>
                  <td class='td-titulo text-left'>{{ $curso->tipo_grado}}</td>
                  <td class='td-titulo text-left'>{{ $curso->nom_curso}}</td>
                  @if($curso->finalizado == 'NO')
                  <td style="text-align: center;"><button type="button" class="btn btn-danger btn-sm " onclick="eliminarAsociacion({{$curso->id}})">🗑️</button></td>
                  @endif
                  @if($curso->finalizado == 'SI')
                  <td style="text-align: center;"></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</form>
<script>
  var HISTORIALCURSOS = @json($historialGrados);
  var CURSOS = @json($grados);
</script>





                    
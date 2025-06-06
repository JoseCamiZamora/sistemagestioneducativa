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

<form  method="post" action="adicionar_clases_docente" id="f_adicionar_clases_docente">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
<input type="hidden" id="id_docente" name="id_docente" value="{{$docente->id}}">
    <div class="form-row col-md-12 mt-2">
      <div class="form-group col-md-12">
        <label for="feLastName">Nombre Del Docente:</label>  
        <h4>{{$docente->nom_completo}}</h4> 
      </div>
      <div class="col-md-3">
          <label for="feLastName">Año Escolar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio_escolar" name="anio_escolar" onchange="infoClasesConfig({{$docente->id}},this.value)" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="">Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Tipo Clasificación</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="tipo_grado" name="tipo_grado" onchange="infoMaterias(this.value)" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="">Seleccione...</option>
              @foreach($lstClasificaciones as $clas)
                <option value="{{$clas->id}}">{{$clas->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-6">
          <label for="feLastName">Materias</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="materia" name="materia" style="margin-top: -6px; height: 33px;padding-top: 4px;" required disabled>
              <option value="">Seleccione...</option>
              @foreach($materias as $mat)
                <option value="{{$mat->id}}">{{$mat->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-10" style="margin-top: 10px;">
        <label class="form-label">Selecciona los Cursos</label><spam style="color: red;"> * </spam>
        <div class="d-flex flex-wrap gap-2 gap-md-3">
          @foreach($grados as $curso)
            <div class="form-check espaciado-checkbox" data-tipo="{{ strtoupper($curso->nombre) == 'TRANSICION' ? 'transicion' : 'primaria' }}">
              <input class="form-check-input curso-checkbox" type="checkbox" value="{{$curso->id}}" id="curso{{$curso->id}}">
              <label class="form-check-label" for="curso{{$curso->id}}">
                {{$curso->nombre}}
              </label>
            </div>
          @endforeach
          </div>
      </div>
      <div class="col-md-2" style="margin-top: 32px;">
        <button type="button" class="btn btn-primary w-100" id="btnAdd"><i class="fa fa-plus" title="Adicionar la clase" style="margin-top: 10px;margin-left: 8px;">&nbsp;&nbsp;</i>Adicionar</button>
      </div>
    </div>

    <div class="modal-footer">
      <div class="modal-body" style="margin-top: -30px;">
        <h4 style="text-align: center;">Listado de las materias regitradas por curso</h4>
      <!-- Tabla -->
      <div class="table-responsive">
        <table class="table table-bordered" id="miTabla">
          <thead>
            <tr>
              <th>Año</th>
              <th>Materia</th>
              <th>Curso</th>
              <th style="text-align: center;">Eliminar</th>
            </tr>
          </thead>
          <tbody id="tablaMaterias">
            <!-- Filas dinámicas -->
          </tbody>
        </table>
      </div>
    </div>
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:none">Actualizar Clases</button>
      </div>
    </div>
</form>
<script>
  document.getElementById('btnAdd').addEventListener('click', () => {
    
    const tabla2 = document.getElementById('tablaMaterias');
    const filas2 = tabla2.querySelectorAll('tr');
    const totalFilas = filas2.length;
    asignacionIndex = totalFilas;

    const anio = document.getElementById('anio_escolar').value;
    const materia = document.getElementById('materia').value;
    const materiaTexto = document.getElementById('materia').selectedOptions[0].text;
    const anioTexto = document.getElementById('anio_escolar').selectedOptions[0].text;

    const cursos = Array.from(document.querySelectorAll('.curso-checkbox:checked')).map(cb => cb.value);
    const cursosTexto = Array.from(document.querySelectorAll('.curso-checkbox:checked')).map(cb => {
      return document.querySelector(`label[for="${cb.id}"]`).innerText;
    });

    if (!anio || !materia || cursos.length === 0) {
      swal({
        title: "Advertencia",
        text: "Debe completar todos los campos y seleccionar al menos una Materia y un curso",
        type: "warning"
      },function (isConfirm) {  $(".preloader").hide();  });

      return;
    }

    const tabla = document.getElementById('tablaMaterias');

    // Validar duplicado
    const filas = tabla.querySelectorAll('tr');
    for (let fila of filas) {
      const celdas = fila.querySelectorAll('td');
      const materiaExistente = celdas[1]?.innerText.trim();

      if ( materiaExistente === materiaTexto) {
        swal({
          title: "Advertencia",
          text: "Esta materia ya fue asignada para este año escolar",
          type: "warning"
        },function (isConfirm) {  $(".preloader").hide();  });
          return;
      }
    }
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${anioTexto}<input type="hidden" name="asignaciones[${asignacionIndex}][anio]" value="${anio}"></td>
      <td>${materiaTexto}<input type="hidden" name="asignaciones[${asignacionIndex}][materia]" value="${materia}"></td>
      <td>${cursosTexto.join(', ')}${cursos.map(c => `<input type="hidden" name="asignaciones[${asignacionIndex}][cursos][]" value="${c}">`).join('')}</td>
      <td style="text-align: center;"><button type="button" class="btn btn-danger btn-sm btnEliminar">🗑️</button></td>
    `;

    tabla.appendChild(row);
    asignacionIndex++;
    document.getElementById("btn_actualizar").style.display = "block";
  });
  tablaMaterias.addEventListener('click', function(e) {
    if (e.target.classList.contains('btnEliminar')) {
      e.target.closest('tr').remove();
    }
  });
  var MATERIAS = @json($materias);
  var CLASES = @json($clases);
  var CLASIFICACIONES =  @json($lstClasificaciones);
  var GRADOS =  @json($grados);
    
</script>





                    
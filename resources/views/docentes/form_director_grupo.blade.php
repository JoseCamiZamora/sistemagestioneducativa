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

<form  method="post" action="adicionar_director_grupo" id="f_adicionar_director_grupo">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" id="id_docente" name="id_docente" value="{{$docente->id}}">
    <div class="form-row col-md-12 mt-2">
      <div class="form-group col-md-12">
        <label for="feLastName">Nombre del Docente:</label>
        <h4>{{$docente->nom_completo}}</h4>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Año Escolar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio_escolar" name="anio_escolar" onchange="infoDirGrupo({{$docente->id}},this.value)" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="">Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso" style="margin-top: -6px; height: 33px;padding-top: 4px;" required>
          <option value="">Seleccione...</option>
               @foreach($grados as $curso)
                <option value="{{$curso->id}}">{{$curso->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-2" style="margin-top: 23px;">
        <button type="button" class="btn btn-primary w-100" id="btnAdd"><i class="fa fa-plus" title="Adicionar el curso" style="margin-top: 10px;margin-left: 8px;">&nbsp;&nbsp;</i>Adicionar Curso </button>
      </div>
    </div>
 <br>
    <div class="modal-footer">
      <div class="modal-body" style="margin-top: -30px;">
        <h4 style="text-align: center;">Historial de director de grupo</h4>
      <!-- Tabla -->
      <div class="table-responsive">
        <table class="table table-bordered" id="miTabla">
          <thead>
            <tr>
              <th>Año</th>
              <th>Curso</th>
              <th style="text-align: center;">Eliminar</th>
            </tr>
          </thead>
          <tbody id="tablaDirectorGrupo">
            <!-- Filas dinámicas -->
          </tbody>
        </table>
      </div>
    </div>
    </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btn_actualizar" style="display:none">Actualizar Director Grupo</button>
      </div>
    </div>
</form>
<script>
  document.getElementById('btnAdd').addEventListener('click', () => {
    console.log('aqui vamos');
    
    const tabla2 = document.getElementById('tablaDirectorGrupo');
    const filas2 = tabla2.querySelectorAll('tr');
    const totalFilas = filas2.length;
    asignacionIndex = totalFilas;

    const anio = document.getElementById('anio_escolar').value;
    const curso = document.getElementById('curso').value;
    const cursoTexto = document.getElementById('curso').selectedOptions[0].text;
    const anioTexto = document.getElementById('anio_escolar').selectedOptions[0].text;

    if (!anio || !curso ) {
      swal({
        title: "Advertencia",
        text: "Debe completar todos los campos y seleccionar al menos un curso",
        type: "warning"
      },function (isConfirm) {  $(".preloader").hide();  });

      return;
    }

    const tabla = document.getElementById('tablaDirectorGrupo');

    // Validar duplicado
    const filas = tabla.querySelectorAll('tr');
    for (let fila of filas) {
      const celdas = fila.querySelectorAll('td');
      const cursoExistente = celdas[1]?.innerText.trim();

      if (anioTexto === anioTexto ) {
        swal({
          title: "Advertencia",
          text: "No puedes adicionar mas de un curso al docente como director",
          type: "warning"
        },function (isConfirm) {  $(".preloader").hide();  });
          return;
      }
    }
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${anioTexto}<input type="hidden" name="asignaciones[${asignacionIndex}][anio]" value="${anio}"></td>
      <td>${cursoTexto}<input type="hidden" name="asignaciones[${asignacionIndex}][curso]" value="${curso}"></td>
      <td style="text-align: center;"><button type="button" class="btn btn-danger btn-sm btnEliminar">🗑️</button></td>
    `;

    tabla.appendChild(row);
    asignacionIndex++;
    document.getElementById("btn_actualizar").style.display = "block";
  });
  tablaDirectorGrupo.addEventListener('click', function(e) {
    if (e.target.classList.contains('btnEliminar')) {
      e.target.closest('tr').remove();
      document.getElementById("btn_actualizar").style.display = "none";
    }
  });

  var GRADOS =  @json($grados);
    
</script>





                    
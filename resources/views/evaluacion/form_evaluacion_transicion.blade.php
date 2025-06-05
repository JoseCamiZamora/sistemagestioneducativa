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
<form  method="post"  action="adicionar_evaluacion_transicion" id="f_adicionar_evaluacion_transicion"  onsubmit="return prepararEvaluaciones()" >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
   <input type="hidden" id="id_estudiante_curso" name="id_estudiante_curso" value="{{$estudiante->id}}">
   <input type="hidden" id="id_clase" name="id_clase" value="">
   <input type="hidden" id="estado" name="estado" value="A">

   <table border  class='table table-generic table-strech table-font-normal table-hover'>
        <thead class="bg-light">
          <TR>
            <TD ALIGN=center ROWSPAN=4 COLSPAN=1 style="width: 120px"> <img id="main-logo" class="d-inline-block align-top mr-1 ml-3" style="max-width:6em;margin-top: 0px" src="{{ asset('/assets/img/proinco1.png') }}" alt="logo cedenar"></TD>
            <TD style="text-align: center; " ROWSPAN=2 COLSPAN=1>FUNDACION PROINCO </TD>
            <TD style="text-align: center">CÓDIGO </TD>
          </TR>
          <TR>
            <TD style="text-align: center">EF-FO-11</TD>
          </TR>
          <TR>
            <TD style="text-align: center">EDUCACION FORMAL – CENTRO EDUCATIVO CORAZON DE MARIA </TD>
            <TD style="text-align: center">VERSION 2</TD>
          </TR>
          <TR>
             <TD style="text-align: center">FORMATO DE EVIDENCIAS DE CALIFICACIONES</TD>
             <TD style="text-align: center"> 23/01/2025</TD>
          </TR>
        </thead>
    </table>
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-4">
        <label for="feLastName">Nombre Del Estudiante:</label> 
        <input  class="form-control "   name="nom_estudiante" value="{{$estudiante->nombre_estudiante}}" required style="margin-top: -6px;" disabled>
      </div>
      <div class="col-md-4">
          <label for="feLastName">Perido a Evaluar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo" style="margin-top: -6px; height: 33px;padding-top: 4px;" onchange="validarNotasInscritasTransicion(this.value)" required>
          <option value="">Seleccione el periodo a evaluar</option>
              @foreach($periodos as $periodo)
                <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-4">
      <label for="feLastName">Fecha Evaluacion</label>  
      <input  class="form-control "   name="fecha_expedicion_fac" value="{{ date('Y-m-d') }}" required style="margin-top: -6px;" disabled>
      </div>
    </div>
    <br>
    <table border class='table table-generic table-strech table-hover'>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN COGNITIVA</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosCognitiva">
        @foreach($filtradosCognitiva as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEvaluacionCognitiva" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN COMUNICATIVA</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosComunicativa">
        @foreach($filtradosComunicativa as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEvaluacionComunicativa" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN ETICA</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosEtica">
        @foreach($filtradosEtica as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEvaluacionEtica" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN ESTETICA</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosEstetica">
        @foreach($filtradosEsteica as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEstetica" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN SOCIOAFECTIVA</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosSocioafectiva">
        @foreach($filtradosSocioafectiva as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEvaluacionSocioafectiva" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN CORPORAL</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosCorporal">
        @foreach($filtradosCorporal as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEvaluacionCorporal" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
      <thead>
        <tr>
          <th colspan="3" class="text-center">EVALUACIÓN DIMENCIÓN ESPIRITUAL</th>
        </tr>
        <tr>
          <th style="font-size: 14px;">Ítem Evaluar</th>
          <th style="font-size: 14px;">Evaluación</th>
        </tr>
      </thead>
      <tbody id="tablaDatosEspiritual">
        @foreach($filtradosEspiritual as $item)
          <tr>
            <td contenteditable="true" class="limitado editable" data-id="{{ $item->id }}" style="font-size: 14px;">{{$item->descripcion}}</td>
            <td>
              <select id="selectEvaluacionEspiritual" class="form-control evaluacion-select" data-id="{{ $item->id }}" data-dimencion="{{$item->nom_materia}}" 
               data-id_dimencion="{{$item->id_materia}}" >
                <option value="">Evaluar al estudiante...</option>
                <option value="2">😀 Logro Alcanzado</option>
                <option value="1">😐 Logro En Proceso</option>
              </select>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <!-- Campo oculto para guardar el array como JSON -->
    
    <input type="hidden" name="evaluaciones" id="evaluaciones">
    
    <div class="form-row col-md-12 mt-2  text-center">
      <button type="submit" class="btn btn-accent text-center" >Guardar Información Evaluación</button>
    </div>
    <div class="row" style="margin-top:-10px;">
</div>
  
</form>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>
<script>
  function prepararEvaluaciones() {
    let datos = [];

    document.querySelectorAll('.evaluacion-select').forEach(select => {
      const id = select.dataset.id;
      const valor = select.value;
      const nom_dimencion = select.dataset.dimencion;
      const id_dimencion = select.dataset.id_dimencion;

      datos.push({
        id_criterio: id,
        dimencion:nom_dimencion,
        id_dimencion:id_dimencion,
        evaluacion: valor
      });
    });

    // Pasar array como string JSON al campo oculto
    document.getElementById('evaluaciones').value = JSON.stringify(datos);
    return true; // permite que el formulario se envíe
  }

  // Mapea los valores con sus descripciones
  const descripciones = {
    2: "😀 Logro Alcanzado",
    1: "😐 Logro En Proceso",
    "": "" // Para evitar errores con selects vacíos
  };

  function actualizarNotaFinal() {
    const selects = document.querySelectorAll('.evaluacion-select');
    let total = 0;
    let count = 0;

    selects.forEach(select => {
      const val = parseFloat(select.value);
      if (!isNaN(val)) {
        total += val;
        count++;
      }
    });

    const promedio = count > 0 ? total / count : 0;
    let resultado = "";

    // Mostrar el emoji según el promedio
    if (promedio >= 1.5) {
      resultado = "😀 Logro Alcanzado";
    } else if (promedio > 0) {
      resultado = "😐 Logro En Proceso";
    } else {
      resultado = "";
    }

    document.getElementById("resultadoFinal").innerText = resultado;
  }

  // Escucha cambios en todos los selects
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.evaluacion-select').forEach(select => {
      select.addEventListener('change', actualizarNotaFinal);
    });
  });
    
</script>





                    
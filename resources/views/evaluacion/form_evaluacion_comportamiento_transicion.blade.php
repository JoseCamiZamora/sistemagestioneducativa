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
<form  method="post"  action="adicionar_evaluacion_comportamiento_transicion" id="f_adicionar_evaluacion_comportamiento_transicion"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id_estudiante_curso" name="id_estudiante_curso" value="{{$estudiante->id}}">
   <input type="hidden" id="id_clase" name="id_clase" value="">
   <input type="hidden" id="estado" name="estado" value="A">

   <table border  class='table table-generic table-strech table-font-normal table-hover' >
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
          <label for="feLastName">Periodo a Evaluar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo" style="margin-top: -6px; height: 33px;padding-top: 4px;" onchange="validarNotasInscritasComportamientoTransicion(this.value)" required>
          <option value="">Seleccione el periodo a evaluar</option>
              @foreach($periodos as $periodo)
                <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-4">
      <label for="feLastName">Fecha Evaluación</label>
      <input  class="form-control "   name="fecha_expedicion_fac" value="{{ date('Y-m-d') }}" required style="margin-top: -6px;" disabled>
      </div>
    </div>
    <br>
    <div class="form-row col-md-12 mt-2">
      
     
      <div class="col-md-3">
        <label for="feLastName">Desempeño En Comportamiento</label>
         <select id="desempenio_compo" name="desempenio_compo" class="form-control evaluacion-select" onchange="adicionarConceptoTrans(this.value)">
          <option value="">Seleccione...</option>
          <option value="3">😀 Alto</option>
          <option value="2">😐 Medio</option>
          <option value="1">☹️ Bajo</option>
        </select>
      </div>
      <br>
      <div class="col-md-12" style="margin-top: 10px;">
        <label for="feLastName">Concepto del Comportamiento</label>
        <textarea id="conceptos_comportamiento" name="conceptos_comportamiento" rows="3" cols="33" maxlength="2000" style="width: 100%;" ></textarea>
    </div>
    
    </div>
    <div class="form-row col-md-12 mt-2  text-center">
      <button type="submit" class="btn btn-accent text-center" >Guardar Información Evaluación</button>
    </div>
    <div class="row" style="margin-top:-10px;">
</div>
</form>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>
<script>
  document.querySelectorAll('td.limitado').forEach(cell => {
    cell.addEventListener('input', function () {
      if (this.innerText.length > 3) {
        this.innerText = this.innerText.slice(0, 2);
        window.getSelection().collapse(this.firstChild, this.innerText.length);
      }
    });
  });

  document.querySelectorAll('.editable').forEach(cell => {
  cell.addEventListener('blur', function () {
    const fila = this.parentElement;
    const celdas = fila.querySelectorAll('.editable');
    
    let total = 0;
    celdas.forEach(celda => {
      let valor = parseFloat(celda.innerText) || 0;

      if (valor > 5) {
        toastr.warning('La nota no puede ser mayor a 5', '¡Advertencia!');
        celda.innerText = '5';
        valor = 5;
      }

      if (isNaN(valor)) {
        toastr.warning('Debe ingresar un número válido', '¡Advertencia!');
        celda.innerText = '0';
        valor = 0;
      }

      let porcentaje = parseFloat(celda.dataset.porcentaje) || 0;
      total += (valor * porcentaje) / 100;
    });

    // ✅ Redondear a un decimal correctamente
    let redondeada = Math.round(total * 10) / 10;

    const notaFinal = fila.querySelector('.nota-final');
    notaFinal.innerText = redondeada;

    // Opcional: actualizar desempeño
    const desempeno = fila.querySelector('.desempeno');
    if (redondeada >= 4.6) {
      desempeno.innerText = 'Superior';
    } else if (redondeada >= 4.0) {
      desempeno.innerText = 'Alto';
    } else if (redondeada >= 3.0) {
      desempeno.innerText = 'Básico';
    } else {
      desempeno.innerText = 'Bajo';
    }
  });
});
var CONCEPTOS_COMPORTAMIENTO = @json($conceptosComportamiento);
function adicionarConceptoTrans(desempenio) {

  const idPeriodo = parseInt($('#periodo').val(), 10);
  if (!idPeriodo) {
    toastr.warning('Por favor seleccione un periodo antes de generar el concepto.', 'Atención');
    return; // Detener ejecución si no hay selección
  }
  var arrayConceptos=CONCEPTOS_COMPORTAMIENTO?CONCEPTOS_COMPORTAMIENTO:[];
  var desempenioText = '';
  if(desempenio == 3){
    desempenioText = "Alto";
  }else if(desempenio == 2){
    desempenioText = "Medio";
  }else{
    desempenioText = "Bajo";
  }
  console.log(idPeriodo);
  const resultado = arrayConceptos.filter(item =>
    parseFloat(item.id_periodo) === parseFloat(idPeriodo) &&
    item.desempenio === desempenioText
  );
  let resultadoConcepto = "";
  if(resultado.length > 0){
    resultadoConcepto = resultado[0].descripcion;
  }else{
    toastr.warning('No existe un concepto configurado para el periodo y desempeño seleccionado.', 'Atención');
  }

  let concepto = "";

  switch (desempenioText) {
    case "Alto":
      concepto = resultadoConcepto;
      break;
    case "Medio":
      concepto = resultadoConcepto;
      break;
    case "Bajo":
      concepto = resultadoConcepto;
      break;
    default:
      concepto = "";
  }

  document.getElementById("conceptos_comportamiento").value = concepto;
}
    
</script>





                    
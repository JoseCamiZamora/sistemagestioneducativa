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
<form  method="post"  action="adicionar_concepto_transicion" id="f_adicionar_concepto_transicion"   >
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
          <label for="feLastName">Periodo Evaluado</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo" style="margin-top: -6px; height: 33px;padding-top: 4px;" onchange="validarNotasMateriasTransicion(this.value)" required>
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
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
    <thead>
      <tr>
        @foreach($lstMaterias as $materia)
        <th style="font-size: 12px; text-align: center;" >{{$materia->nombre}}</th>
        @endforeach
        <th style="text-align: center;">Nota Final</th>
        <th >Desempeño</th>
        <th style="text-align: center;">Concepto</th>
      </tr>
    </thead>
    <tbody id="tablaDatos">
      <tr>
        @foreach($lstMaterias as $tipo)
        <td  class="limitado" data-id="{{ $tipo->id }}"  style="text-align: center;">
        </td>
        @endforeach
        <td class="nota-final" style="text-align: center;">
        </td>
        <td class="desempeno" style="color:rgb(3, 3, 3);font-size: 15px !important;font-weight: bold;"></td>
        <td >
          <a class="nav-link nav-link-icon text-center"  href="javascript:void(0);"  onclick="adicionarConceptoTransicion()" id="subirfile" >
            <div class="nav-link-icon__wrapper">
              <i class="fa fa-plus" title="Generar Concepto Evaluacion" style=""></i><br>
            </div>
          </a>
        </td>
      </tr>
    </tbody>
    <tbody id="tablaDatos2">
      <tr>
        <td colspan="10">
          <textarea id="conceptos" name="conceptos" rows="4" maxlength="2000" style="width: 100%;font-size: 15px;"></textarea>
        </td>
      </tr>
    </tbody>
    </table>
    <div class="form-row col-md-12 mt-2  text-center">
      <button type="submit" class="btn btn-accent text-center" >Guardar Información Evaluación</button>
    </div>
    <div class="row" style="margin-top:-10px;">
</div>
</form>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>
<script>
 
  const rutaFeliz = "{{ asset('assets/img/feliz.svg') }}";
  const rutaNeutro = "{{ asset('assets/img/neutro.svg') }}";

  var CONCEPTOS = @json($lstConceptosEvaluar);
  function adicionarConceptoTransicion() {
    const fila = document.querySelector("#tablaDatos tr");
    const notaFinal = parseFloat(fila.querySelector(".nota-final").innerText);
    const desempeno = fila.querySelector(".desempeno").innerText;

    const idPeriodo = parseInt($('#periodo').val(), 10);
    if (!idPeriodo) {
      toastr.warning('Por favor seleccione un periodo antes de generar el concepto.', 'Atención');
      return; // Detener ejecución si no hay selección
    }
    var arrayConceptos=CONCEPTOS?CONCEPTOS:[];

    const resultado = arrayConceptos.filter(item =>
      item.id_periodo === idPeriodo &&
      item.desempenio === desempeno
    );
    let resultadoConcepto = "";
    if(resultado.length > 0){
      
      if(resultado.length > 0){
        resultadoConcepto = resultado[0].descripcion;
      }

      let concepto = "";
      switch (desempeno) {
        case "Logro Alcanzado":
          concepto = resultadoConcepto;
          break;
        case "Logro En Proceso":
          concepto = resultadoConcepto;
          break;
        default:
          concepto = "";
      }
      document.getElementById("conceptos").value = concepto;
    }else{
      toastr.warning('No existe un concepto configurado para este periodo. Valida la información e intenta nuevamente o ingresa el concepto de forma manual', 'Atención');
    }
    
  }
    
</script>





                    
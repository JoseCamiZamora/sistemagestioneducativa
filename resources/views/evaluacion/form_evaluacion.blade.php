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
<form  method="post"  action="adicionar_evaluacion_estudiante" id="f_adicionar_evaluacion_estudiante"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id_estudiante_curso" name="id_estudiante_curso" value="{{$estudiante->id}}">
   <input type="hidden" id="id_clase" name="id_clase" value="{{$claseDocente->id}}">
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
          <label for="feLastName">Perido a Evaluar</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo" style="margin-top: -6px; height: 33px;padding-top: 4px;" onchange="validarNotasInscritas(this.value)" required>
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
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
    <thead>
      <tr>
        @foreach($tiposEvaluacion as $tipo)
        <th style="font-size: 12px;" >{{$tipo->nombre}}</th>
        @endforeach
        <th>Nota Final</th>
        <th>Desempeño</th>
      </tr>
    </thead>
    <tbody id="tablaDatos">
      <tr>
        @foreach($tiposEvaluacion as $tipo)
        <td contenteditable="true" class="limitado editable" data-id="{{ $tipo->id }}" data-porcentaje="{{ $tipo->porcentaje ?? 20 }}">0</td>
        @endforeach
        <td class="nota-final">0</td>
        <td class="desempeno">Bajo</td>
      </tr>
    </tbody>
    </table>
    <div class="form-row col-md-12 mt-2  text-center">
      <button type="submit" class="btn btn-accent text-center" >Actualziar Información Docente</button>
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
    if (redondeada >= 5) {
      desempeno.innerText = 'Superior';
    } else if (redondeada >= 4.5) {
      desempeno.innerText = 'Alto';
    } else if (redondeada >= 3.9) {
      desempeno.innerText = 'Básico';
    } else {
      desempeno.innerText = 'Bajo';
    }
  });
});
    
</script>





                    
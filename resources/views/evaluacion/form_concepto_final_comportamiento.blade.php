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
<form  method="post"  action="adicionar_concepto_final_comp" id="f_adicionar_concepto_final_comp"   >
   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
   <input type="hidden" id="id_estudiante_curso" name="id_estudiante_curso" value="{{$estudiante->id}}">
   <input type="hidden" id="id_anio" name="id_anio" value="{{$anios->id}}">
   <input type="hidden" id="id_curso" name="id_curso" value="{{$curso->id}}">
   <input type="hidden" id="estado" name="estado" value="A">

   <table border  class='table table-generic table-strech table-font-normal table-hover' >
        <thead class="bg-light">
          <TR>
            <TD ALIGN=center ROWSPAN=4 COLSPAN=1 style="width: 120px"> <img id="main-logo" class="d-inline-block align-top mr-1 ml-3" 
            style="max-width:6em;margin-top: 0px" src="{{ asset('/assets/img/proinco1.png') }}" alt="logo cedenar"></TD>
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
        <label for="feLastName">Curso</label>
        <input  class="form-control " name="nom_estudiante" value="{{$curso->nombre}}" required style="margin-top: -6px;" disabled>
      </div>
      <div class="col-md-4">
        <label for="feLastName">Fecha Evaluación</label>
        <input  class="form-control "   name="fecha_expedicion_fac" value="{{ date('Y-m-d') }}" required style="margin-top: -6px;" disabled>
      </div>
    </div>
    <br>
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
    <thead>
      
    
    <tbody id="tablaDatos2">
      <tr>
        <td colspan="9">
          <textarea id="conceptos" name="conceptos" rows="6" maxlength="2000" style="width: 100%;font-size: 15px;">{{$concepto->descripcion ?? ''}}</textarea>
        </td>
      </tr>
    </tbody>
    </thead>
    </table>

    <div class="form-row col-md-12 mt-2  text-center">
      <button type="submit" class="btn btn-accent text-center" >Guardar Información Concepto Final</button>
    </div>
    <div class="row" style="margin-top:-10px;">
</div>
</form>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>





                    
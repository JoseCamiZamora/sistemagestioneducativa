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
<div class="form-row" style="background-color: #66d1ea">
  <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS BASICOS DEL ESTUDIANTE</label>
</div>
<br>
<div class="row" >
  <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
    <div class="stats-small card card-small" style="text-align: center;padding-top: 10px">
      <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
      <table style="width: 100%">
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Fecha Matricula:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->fecha_matricula}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Identificación Estudiante:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->tipo_documento}} - {{$estudiante->identificacion}} Expedida en: {{$estudiante->lugar_expedicion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Fecha y lugar Nacimiento:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->fecha_nacimiento}} - {{$estudiante->lugar_nacimiento}} Edad: {{$estudiante->edad}} Años" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nombre Estudiante:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->primer_nombre}} {{$estudiante->segundo_nombre}} {{$estudiante->primer_apellido}} {{$estudiante->segundo_apellido}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Genero y RH:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->genero}} - RH: {{$estudiante->tipo_rh}}" disabled>
          </td>
        </tr>
      </table>
    </div>
      <div class="card-body" style="text-align: left;" >
        <div class="form-row" style="margin-top:-30px;">
          <div class="form-group col-md-12" >
            <label >Observaciones Del Estudiante</label>
            <textarea class="form-control" maxlength="1200" id="mensaje" name="mensaje" rows="3" disabled>{{$estudiante->observaciones_adicionales}}</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="form-row" style="background-color: #66d1ea">
  <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS DE UBICACION Y CONTACTO DEL ESTUDIANTE</label>
</div>
<br>
<div class="row" >
  <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
    <div class="stats-small card card-small" style="text-align: center;padding-top: 10px">
      <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
      <table style="width: 100%">
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nacionalidad:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->nacionalidad}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Dirección De Recidencia:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->direccion}}, Barrio: {{$estudiante->barrio}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Comuna:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->comuna}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Corregimiento Y Vereda:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->corregimiento}} - {{$estudiante->vereda}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Telefono O Celular:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->telefono}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Correo Electronico:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->correo_electronico}}" disabled>
          </td>
        </tr>
      </table>
  </div>
</div>
<br>
<div class="form-row" style="background-color: #66d1ea">
  <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS BASICOS PADRE/MADRE O ACUDIENTE</label>
</div>
<br>
@if($responsable1 != "N")
<div class="row" >
  <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
    <div class="stats-small card card-small" style="text-align: center;padding-top: 10px">
      <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
      <table style="width: 100%">
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Parentezco:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable1->tipo}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Identificacion:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable1->nombreDocumento}} - {{$responsable1->identificacion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nombres Y Apellidos:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable1->nombres}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Ocupación:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable1->ocupacion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Telefono O Celular:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable1->telefono}}" disabled>
          </td>
        </tr>
      </table>
  </div>
</div>
@endif
<br>
@if($responsable2 != "N")
<div class="row" >
  <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
    <div class="stats-small card card-small" style="text-align: center;padding-top: 10px">
      <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
      <table style="width: 100%">
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Parentezco:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable2->tipo}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Identificacion:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable2->nombreDocumento}} - {{$responsable2->identificacion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nombres Y Apellidos:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable2->nombres}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Ocupación:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable2->ocupacion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Telefono O Celular:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable2->telefono}}" disabled>
          </td>
        </tr>
      </table>
  </div>
</div>
@endif
<br>
@if($responsable3 != "N")
<div class="row" >
  <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
    <div class="stats-small card card-small" style="text-align: center;padding-top: 10px">
      <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
      <table style="width: 100%">
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Parentezco:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable3->tipo}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Identificacion:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable3->nombreDocumento}} - {{$responsable3->identificacion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nombres Y Apellidos:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable3->nombres}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Ocupación:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable3->ocupacion}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nro Telefono O Celular:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$responsable3->telefono}}" disabled>
          </td>
        </tr>
      </table>
  </div>
</div>
@endif
<br>
<div class="form-row" style="background-color: #66d1ea">
  <label for="feLastName" style="color: black; margin-top: 8px;margin-left: 8px">DATOS ADICIONALES</label>
</div>
<br>
<div class="row" >
  <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
    <div class="stats-small card card-small" style="text-align: center;padding-top: 10px">
      <div class="col-12 col-md-12 col-lg-12 mb-4 mx-auto">
      <table style="width: 100%">
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Discapacidad:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->tiene_discapacidad}}: {{$estudiante->desc_discapacidad}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Tipo Seguridad Social:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->tipos_seguridad_social}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Nombre EPS:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->eps}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Sisben:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->sisben}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Estrato:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->estrato}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
            Vacunas:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
          <div style="display: flex; gap: 20px; align-items: center; margin-top: 8px;">
            @if($vacuna1 =='S')
              <label><input type="checkbox" name="vacunas[]" value="DPT" checked > DPT</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="DPT" > DPT</label>
            @endif
            @if($vacuna2 =='S')
              <label><input type="checkbox" name="vacunas[]" value="T.VIRAL" checked >  T.VIRAL</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="T.VIRAL" > T.VIRAL</label>
            @endif
            @if($vacuna3 =='S')
              <label><input type="checkbox" name="vacunas[]" value="POL" checked > POL</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="POL" > POL</label>
            @endif
            @if($vacuna4 =='S')
              <label><input type="checkbox" name="vacunas[]" value="SAR" checked > SAR</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="SAR" > SAR</label>
            @endif
            @if($vacuna5 =='S')
              <label><input type="checkbox" name="vacunas[]" value="BCB" checked > BCB</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="BCB" > BCB</label>
            @endif
            @if($vacuna6 =='S')
              <label><input type="checkbox" name="vacunas[]" value="HIB" checked > HIB</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="HIB" > HIB</label>
            @endif
            @if($vacuna7 =='S')
              <label><input type="checkbox" name="vacunas[]" value="H.V." checked > H.V.</label>
            @else
              <label><input type="checkbox" name="vacunas[]" value="H.V." > H.V.</label>
            @endif
            </div>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
          Poblacion Victima de Conflicto:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->pob_victima_conflicto}}" disabled>
          </td>
        </tr>
        <tr>
          <td style="width: 20%; background-color: #c9ccce; padding-left: 10px; border-bottom: 1px solid white;">
          Población Desmovilizada de Conlicto Armado:
          </td>
          <td style="width: 80%; background-color: white; padding-left:10px; ">
            <input type="text" class="form-control" id="remitente" name="remitente" value="{{$estudiante->pob_desplazada_conflicto}}" disabled>
          </td>
        </tr>
      </table>
  </div>
</div>
<script src="{{ asset('/assets/plugins/jquery.dropdown.min.js') }}"></script>
<script>
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  $('.datepicker').datepicker({
      startDate: ''
  });
  if ($.fn.dropdown) {
        $('.dropdown-mul-1').dropdown({
            readOnly: false,
            limitCount: 40,
            multipleMode: 'label',
            choice: function() {
            }
        });

    }
</script>





                    
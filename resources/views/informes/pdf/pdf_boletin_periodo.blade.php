<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Boletín Estudiantil</title>
  <style>
  @page {
     margin: 4.5cm 1cm 1.5cm 1cm;
  }
  body {
      font-family: Arial, sans-serif;
    }
    h2 {
      margin-bottom: 5px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    th, td {
      border: 1px solid #000;
      padding: 5px;
      text-align: center;
    }
    .estudiante-box {
      margin-bottom: 40px;
    }

  #header {
    position: fixed;
    top: -4cm;
    left: 0cm;
    width: 100%;
    text-align: center;
    font-size: 12px !important;
  }

  #footer {
    position: fixed;
    bottom: -1cm;
    left: 0cm;
    width: 100%;
    text-align: center;
    font-size: 10px;
  }
  .content {
    font-size: 12px !important;
  }

</style>
</head>
  <body>
  <div id="header" >
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
      <thead class="bg-light">
        <TR>
          <TD ALIGN=center ROWSPAN=4 COLSPAN=1 style="width: 120px"> <img id="main-logo" class="d-inline-block align-top mr-1 ml-3" style="max-width:3.5em;margin-top: 0px" 
            src="{{ asset('/assets/img/proinco1.png') }}" alt="logo proinco"></TD>
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
  </div>
  <div id="footer" >
    <h3 style="color: #649dd0;"><strong>SUS DERECHOS, NUESTROS DEBERES</strong></h3>
  </div>
  <div class="content" >
    @foreach($reporte as $boletin)
    <table border  class='table table-generic table-strech table-font-normal table-hover' style="margin-bottom: 8px;" >
      <thead>
        <tr>
          <th>ESTUDIANTE</th>
          <th>GRADO</th>
          <th>INFORME</th>
          <th>FECHA</th>
          <th>AÑO ESCOLAR</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$boletin['data_estudiante']['nom_estudiante']}}</td>
          <td>{{$grado->nombre}}</td>
          <td>{{$periodoClases->nombre}}</td>
          <td>{{$fechaReporte}}</td>
          <td>{{$anio->anio_inicio}}</td>
        </tr>
      </tbody>
    </table>
    @foreach($boletin['data_materia'] as $materia)
      <table border  class='table table-generic table-strech table-font-normal table-hover' style="margin-bottom: 15px;" >
        <thead>
          <tr>
            <th style="text-align: left;">{{ $materia['nom_materia'] }}</th>
            <th>IHS</th>
            <th>1° TRIM</th>
            <th>2° TRIM</th>
            <th>3° TRIM</th>
            <th>FNJ</th>
            <th>FJ</th>
            <th>PROMEDIO</th>
            <th>DESEMPEÑO</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td style="text-align: left; width: 270px;">Docente: {{$materia['nom_docente']}}</td>
              <td>{{ $materia['intensidad_horas'] }}</td>
              <td>{{ $materia['nota'] }}</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ $materia['nota'] }}</td>
              <td>{{ $materia['desempenio'] }}</td>
            </tr>
        </tbody>
        <tbody >
        <tr>
          <td colspan="9" style="text-align: justify;">{{ $materia['concepto'] }}</td>
        </tr>
        </tbody>
      </table>
    @endforeach
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
      <thead>
        <tr>
          <th style="text-align: left; width: 270px;">{{ $boletin['data_comportamiento']['nom_materia'] }}</th>
          <th>IHS</th>
          <th>1° TRIM</th>
          <th>2° TRIM</th>
          <th>3° TRIM</th>
          <th>FNJ</th>
          <th>FJ</th>
          <th>PROMEDIO</th>
          <th>DESEMPEÑO</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td style="text-align: left;  width: 270px;">Docente: {{$docente->nom_docente}}</td>
            <td></td>
            <td>{{ $boletin['data_comportamiento']['nota'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $boletin['data_comportamiento']['nota'] }}</td>
            <td>{{ $boletin['data_comportamiento']['desempenio'] }}</td>
          </tr>
      </tbody>
      <tbody >
      <tr>
        <td colspan="9" style="text-align: justify;">{{ $boletin['data_comportamiento']['concepto'] }}</td>
      </tr>
      </tbody>
    </table>
    <h3>OBSERVACIONES</h3>
    <div class="observaciones">
      <textarea id="conceptos" name="conceptos" rows="5" maxlength="2000" style="width: 100%;font-size: 15px;"></textarea>
    </div>
    <br><br><br><br>
    <div class="firma">
      
        ___________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________<br>
        LIGIA MURIEL ARTEAGA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$docente->nom_docente}}<br>
        Directora C.E. Corazón de María&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Directora de Grupo
    </div>
    <br><br><br><br><br><br><br><br>
    <div style="page-break-after: always;"></div>
    @endforeach
  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Boletín Estudiantil</title>
  <style>
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
  </style>
</head>
  <body>
  @foreach($reporte as $boletin)
    <table border  class='table table-generic table-strech table-font-normal table-hover' style="margin-bottom: 30px;" >
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
      <table border  class='table table-generic table-strech table-font-normal table-hover' >
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
              <td style="text-align: left;">Docente: {{$materia['nom_docente']}}</td>
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
          <th style="text-align: left;">{{ $boletin['data_comportamiento']['nom_materia'] }}</th>
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
            <td style="text-align: left;">Docente: {{$docente->nom_docente}}</td>
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;{{$docente->nom_docente}}<br>
        Directora C.E. Corazón de María&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Directora de Grupo
    </div>
    <br><br><br><br><br><br><br><br>
  @endforeach
</body>
</html>
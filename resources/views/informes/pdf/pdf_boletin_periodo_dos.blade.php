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
          <TD style="text-align: center">EF-FO-29</TD>
        </TR>
        <TR>
          <TD style="text-align: center">PROCESO DE EDUCACIÓN FORMAL CENTRO EDUCATIVO CORAZON DE MARIA</TD>
          <TD style="text-align: center">VERSION 2</TD>
        </TR>
        <TR>
            <TD style="text-align: center">INFORME ESCOLAR DE VALORACION</TD>
            <TD style="text-align: center">28/05/2024</TD>
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
          <td style="text-align: left; width: 270px;">{{$boletin['data_estudiante']['nom_estudiante'] ?? ''}}</td>
          <td>{{$grado->nombre ?? ''}}</td>
          <td>{{$periodoClases->nombre}}</td>
          <td>{{$fechaReporte ?? ''}}</td>
          <td>{{$anio->anio_inicio ?? ''}}</td>
        </tr>
      </tbody>
    </table>
    @foreach($boletin['data_materia'] as $materia)
      <table border  class='table table-generic table-strech table-font-normal table-hover' style="margin-bottom: 15px;" >
        <thead>
          <tr>
            <th style="text-align: left; width: 270px;">{{ $materia['nom_materia'] ?? '' }}</th>
            <th style="text-align: center; width: 20px;">IHS</th>
            <th style="text-align: center; width: 47px;">1° TRIM</th>
            <th style="text-align: center; width: 47px;">2° TRIM</th>
            <th style="text-align: center; width: 47px;">3° TRIM</th>
            <th style="text-align: center; width: 20px;">FNJ</th>
            <th style="text-align: center; width: 20px;">FJ</th>
            <th style="text-align: center; width: 40px;">PROMEDIO</th>
            <th style="text-align: center; width: 40px;">DESEMPEÑO</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td style="text-align: left; width: 270px;">Docente: {{$materia['nom_docente'] ?? ''}}</td>
              <td>{{ $materia['intensidad_horas'] ?? '' }}</td>
              <td style="text-align: center; width: 30px;">{{ number_format($materia['nota'] ?? '',1) }}</td>
              <td style="text-align: center; width: 30px;">{{ number_format($materia['nota1'] ?? '',1) }}</td>
              <td style="text-align: center; width: 30px;"></td>
              @if($materia['horas_justificadas'] > 0)
                <td style="text-align: center; width: 20px;">{{ $materia['horas_justificadas'] ?? '' }}</td>
              @else
                <td style="text-align: center; width: 20px;"></td>
              @endif
              @if($materia['horas_no_justificadas'] > 0)
                <td style="text-align: center; width: 20px;">{{ $materia['horas_no_justificadas'] ?? '' }}</td>
              @else
                <td style="text-align: center; width: 20px;"></td>
              @endif
              <td style="text-align: center; width: 40px;">{{ number_format($materia['promedio'] ?? '',1) }}</td>
              <td style="text-align: center; width: 40px;">{{ $materia['desempenio'] ?? '' }}</td>
            </tr>
        </tbody>
        <tbody >
        <tr>
          <td colspan="9" style="text-align: justify;">{{ $materia['concepto'] ?? '' }}</td>
        </tr>
        </tbody>
      </table>
    @endforeach
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
      <thead>
        <tr>
          <th style="text-align: left; width: 270px;">{{ $boletin['data_comportamiento']['nom_materia']  ?? '' }}</th>
           <th style="text-align: center; width: 20px;">IHS</th>
            <th style="text-align: center; width: 47px;">1° TRIM</th>
            <th style="text-align: center; width: 47px;">2° TRIM</th>
            <th style="text-align: center; width: 47px;">3° TRIM</th>
            <th style="text-align: center; width: 20px;">FNJ</th>
            <th style="text-align: center; width: 20px;">FJ</th>
            <th style="text-align: center; width: 40px;">PROMEDIO</th>
            <th style="text-align: center; width: 40px;">DESEMPEÑO</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td style="text-align: left;  width: 270px;">Docente: {{$docente->nom_docente}}</td>
            <td></td>
            <td>{{ number_format($boletin['data_comportamiento']['nota1'] ?? '',1) }}</td>
            <td>{{ number_format($boletin['data_comportamiento']['nota2'] ?? '',1) }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ number_format($boletin['data_comportamiento']['promedio'] ?? '',1) }}</td>
            <td>{{ $boletin['data_comportamiento']['desempenio'] ?? '' }}</td>
          </tr>
      </tbody>
      <tbody >
      <tr>
        <td colspan="9" style="text-align: justify;">{{ $boletin['data_comportamiento']['concepto'] ?? '' }}</td>
      </tr>
      </tbody>
    </table>
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
      <thead>
        <tr>
          <th style="text-align: center;">OBSERVACIONES</th>
        </tr>
      </thead>
      <tbody >
      <tr style="height: 80px">
        <td style="text-align: justify; min-height: 30px;">{{ $boletin['data_estudiante']['observacion'] ?? '' }}</td>
      </tr>
      </tbody>
    </table>
    <table style="width: 100%; margin-top: 40px; text-align: center;border: none;">
        <tr>
            <!-- Firma 1 -->
            <td style="width: 40%;border: none;">
                <img src="{{ asset('/assets/img/firmas/FirmaLigiaMuriel.jpg') }}" style="max-height: 60px;"><br>
                <hr style="width: 200px; border: 1px solid black;">
                <strong>LIGIA MURIEL ARTEAGA</strong><br>
                Director(a) C.E. Corazón de María
            </td>

            <!-- Firma 2 -->
            <td style="width: 40%;border: none;">
                @if($grado->nombre == "GRADO 1")
                  <img src="{{ asset('/assets/img/firmas/FirmaCristina.png') }}" style="max-height: 60px;">
                @endif
                @if($grado->nombre == "GRADO 2")
                  <img src="{{ asset('/assets/img/firmas/FirmaAstrid2.png') }}" style="max-height: 60px;">
                @endif
                @if($grado->nombre == "GRADO 3")
                  <img src="{{ asset('/assets/img/firmas/FirmaJaime2.png') }}" style="max-height: 60px;">
                @endif
                @if($grado->nombre == "GRADO 4")
                  <img src="{{ asset('/assets/img/firmas/FirmaCarlos.png') }}" style="max-height: 60px;">
                @endif
                @if($grado->nombre == "GRADO 5")
                  <img src="{{ asset('/assets/img/firmas/FirmaJairo.png') }}" style="max-height: 60px;">
                @endif
                <br>
                <hr style="width: 200px; border: 1px solid black;">
                <strong>{{$docente->nom_docente}}</strong><br>
                Director(a) de Grupo.
            </td>
        </tr>
    </table>
    @if($individual == 'N')
        <div style="page-break-after: always;"></div>
    @endif
    @endforeach
  </div>
</body>
</html>
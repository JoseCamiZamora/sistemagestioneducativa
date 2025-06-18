<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Boletín Estudiantil</title>
  <style>
  @page {
     margin: 4.5cm 1.5cm 1cm 1cm;
  }
  body {
      font-family: Arial, sans-serif;
       justify-content: center;
    }
    h2 {
      margin-bottom: 5px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #000;
      padding: 3px;
      text-align: center;
    }
    .estudiante-box {
      margin-bottom: 40px;
    }
    .tabla-interpre {
      border-collapse: collapse;
      width: 400px; /* Ajusta este valor para hacerla más o menos ancha */
      text-align: center;
      font-size: 14px;
    }

    .tabla-interpre th, .tabla-interpre td {
      border: 1px solid black;
      padding: 8px;
    }

    .tabla-interpre th[colspan="2"] {
      background-color: #f8f8f8;
      font-weight: bold;
    }

  #header {
    position: fixed;
    top: -3cm;
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
    <table class="tabla-interpre table table-generic table-strech table-font-normal table-hover" style="margin: 7 auto;">
      <tr>
        <th colspan="2">INTERPRETACIÓN</th>
      </tr>
      <tr>
        <th>Logro alcanzado</th>
        <th>Logro en proceso</th>
      </tr>
      <tr>
        <td ><img id="main-logo" class="d-inline-block align-top mr-1 ml-3" style="max-height: 30px; " 
                    src="{{ asset('/assets/img/feliz3.png') }}" alt="logo proinco"></td>
        <td ><img src="{{ asset('/assets/img/neutro2.png') }}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'"></td>
      </tr>
    </table>
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
            <th style="text-align: left;">DIMENCION {{ $materia['dimencion'] }}</th>
            <th style="text-align: Center;">Logro</th>
          </tr>
        </thead>
        <tbody>
          @foreach($materia['items'] as $dimencion)
            <tr>
              <td style="text-align: justify; height: 35px !important;">{{ $dimencion['nom_dimencion'] }}</td>
              <td style="width: 30px; height: 35px !important;">
                @if($dimencion['nota'] == 2)
                <img id="main-logo" class="d-inline-block align-top mr-1 ml-3" style="max-height: 30px; " 
                    src="{{ asset('/assets/img/feliz3.png') }}" alt="logo proinco">
                @else
                  <img src="{{ asset('/assets/img/neutro2.png') }}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endforeach
    <table border  class='table table-generic table-strech table-font-normal table-hover' >
      <thead>
        <tr>
          <th>{{ $boletin['data_comportamiento']['nom_materia'] }}</th>
          <th style="text-align: center; width: 50px;">{{ $boletin['data_comportamiento']['desempenio'] }}</th>
        </tr>
      </thead>
      <tbody >
      <tr>
        <td style="text-align: justify;">{{ $boletin['data_comportamiento']['concepto'] }}</td>
        <td style="text-align: center; width: 50px;">
          @if($boletin['data_comportamiento']['desempenio'] == 'Alto')
            <img id="main-logo" class="d-inline-block align-top mr-1 ml-3" style="max-height: 30px; " 
                      src="{{ asset('/assets/img/feliz3.png') }}" alt="logo proinco">
          @endif
          @if($boletin['data_comportamiento']['desempenio'] == 'Medio')
            <img src="{{ asset('/assets/img/neutro2.png') }}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">
          @endif
          @if($boletin['data_comportamiento']['desempenio'] == 'Bajo')
            <img src="{{ asset('/assets/img/triste1.svg') }}" style="max-height: 30px;" onerror="this.onerror=null; this.src='image.png'">
          @endif
        </td>
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
      <tr>
        <td style="text-align: justify;">{{ $boletin['data_estudiante']['desempenio_final'] }}</td>
      </tr>
      </tbody>
    </table>
    <table style="width: 100%; margin-top: 40px; text-align: center;border: none;">
        <tr>
            <!-- Firma 1 -->
            <td style="width: 50%;border: none;">
                <img src="{{ asset('/assets/img/firmas/FirmaLigiaMuriel.jpg') }}" style="max-height: 60px;">
                <hr style="width: 200px; border: 1px solid black;">
                <strong>LIGIA MURIEL ARTEAGA</strong><br>
                Directora C.E. Corazón de María
            </td>

            <!-- Firma 2 -->
            <td style="width: 50%;border: none;">
                <img src="{{ asset('/assets/img/firmas/FirmaSuhani.png') }}" style="max-height: 60px;">
                <hr style="width: 200px; border: 1px solid black;">
                <strong>{{$docente->nom_docente}}</strong><br>
                Directora de Grupo
            </td>
        </tr>
    </table>
    <div style="page-break-after: always;"></div>
    @endforeach
  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Boletín Estudiantil</title>
  <style>
  @page {
     margin: 4.5cm 2cm 1.5cm 2cm;
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
      margin-bottom: 10px;
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
          <TD style="text-align: center">FAI-121</TD>
        </TR>
        <TR>
          <TD style="text-align: center">PROCESO DE EDUCACIÓN FORMAL CENTRO EDUCATIVO CORAZON DE MARIA</TD>
          <TD style="text-align: center">VERSION 001</TD>
        </TR>
        <TR>
            <TD style="text-align: center">CERTIFICADO DE ESTUDIOS</TD>
            <TD style="text-align: center">02/09/2016</TD>
        </TR>
      </thead>
    </table>
  </div>
  <div id="footer" >
    <h3 style="color: #649dd0;"><strong>SUS DERECHOS, NUESTROS DEBERES</strong></h3>
  </div>
  <div class="content" >
    <h3 style="text-align: center;">CENTRO EDUCATIVO CORAZÓN DE MARÍA</h3>
    <p style="text-align: center;"><strong>Aprobada por la Secretaría de Educación Municipal de Pasto<br>
    Mediante resolución No. 3446 de 06 de diciembre de 2022<br>
    Registro DANE 352001002027<br>
    Calle 30 No. 19 – 122 Barrio Santa Matilde </strong></p>
    </br>
    <h3 style="text-align: center;font-weight: normal;" >La Suscrita Directora del Centro Educativo </br>CORAZÓN DE MARÍA </br></br><strong>CERTIFICA: </strong></h3>
  </br>
  @foreach($reporte as $boletin)
    
  <h3 style="font-weight: normal;text-align: justify;">Que el (la) estudiante <strong>{{$boletin['data_estudiante']['nom_estudiante'] ?? ''}}</strong>, 
    identificado (a) con Tarjeta de Identidad No. <strong>{{$boletin['data_estudiante']['identificacion'] ?? ''}}</strong>, cursó y aprobó el grado
    <strong>
      @if($grado->nombre == 'GRADO 1')
        PRIMERO
      @endif
      @if($grado->nombre == 'GRADO 2')
        SEGUNDO
      @endif
      @if($grado->nombre == 'GRADO 3')
        TERCERO
      @endif
      @if($grado->nombre == 'GRADO 4')
        CUARTO
      @endif
      @if($grado->nombre == 'GRADO 5')
        QUINTO
      @endif
    </strong> de primaria en el año lectivo <strong>{{$anio->anio_inicio ?? ''}}</strong>, 
    obteniendo las siguientes valoraciones:</h3>
</br>
    
      <table>
        <thead>
          <tr>
            <th>ÁREA</th>
            <th>HRS</th>
            <th>CALIFIC</th>
            <th>DESEMPEÑO</th>
          </tr>
        </thead>
        <tbody>
          @foreach($boletin['data_materia'] as $materia)
            <tr>
              <td style="text-align: left; ">{{ $materia['nom_materia'] ?? '' }}</td>
              <td>{{ $materia['intensidad_horas'] ?? '' }}</td>
              <td id="nota">{{ number_format($materia['nota'] ?? '',1 )}}</td>
              <td style="text-transform: uppercase;">{{ $materia['desempenio'] ?? '' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
   
    <div class="datos">
       <h3 style="font-weight: normal;text-align: justify;">En constancia se firma a <strong>{{$dia}}</strong> días del mes de <strong>{{$mes}}</strong> del año <strong>{{$anio}}</strong>.</h3>
    </div>
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
        </tr>
    </table>
    @if($individual == 'N')
        <div style="page-break-after: always;"></div>
    @endif
    @endforeach
  </div>
</body>
</html>
<script>
  const estudiante = "edwin andres chicaiza yandi";
  const nota = 3;

  document.getElementById("nombre").textContent = estudiante.toUpperCase();
  document.getElementById("nota").textContent = nota.toFixed(1); // Muestra "3.0"
</script>
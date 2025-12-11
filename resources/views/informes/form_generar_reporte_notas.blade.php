@extends('layouts.app')



@section('content')
<style>
    .reporte-box {
      border: 3px solid teal;
      padding: 20px;
      margin-bottom: 30px;
      border-radius: 8px;
    }

    .reporte-box h3 {
      margin-top: 0;
    }

    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 20px;
    }

    .form-row button {
      padding: 8px 16px;
      background-color: teal;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }

    .form-row button:hover {
      background-color: #007373;
    }
  </style>
<div class="container">
     <!-- Page Header -->
  <div>
	  <div class="page-header row no-gutters py-4">
	    <div class="col">
	      <span class="page-subtitle">Modulo Para Generar Reportes </span>
	        <h4 class="page-title" >Formulario para la selección de item para generar el reporte<span style='font-size: 0.6em;'></span> </h4>
	       <div  class=" ml-auto" style="text-align: right; margin-top: -35px;">
	        Atrás
	        <a href="{{ url('informes/index_reportes') }}" class="mb-2 btn btn-sm  mr-1 btn-redondo-suave text-primary" title="salir a menu" ><i class="fa fa-chevron-left" aria-hidden="true"></i> </a>
	      </div>
	    </div>
	  </div>
  </div>
  <!-- End Default Light Table -->
  <div class="reporte-box">
    <h3>Generar reporte por período</h3>
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-3">
          <label for="feLastName">Año Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio" name="anio"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($grados as $grado)
                <option value="{{$grado->id}}">{{$grado->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Periodo</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($periodos as $periodo)
                <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-2" style="margin-top: 28px;" >
       <button onclick="generarReportePorPeriodo()"><i class="fa fa-download" style=""></i> Generar</button>
      </div>
    </div>
    <br>
    <h3>Generar reporte final por curso </h3>
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-3">
          <label for="feLastName">Año Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio1" name="anio1"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso1" name="curso1"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($grados as $grado)
                <option value="{{$grado->id}}">{{$grado->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Periodo</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo1" name="periodo1"  required>
             <option value="Final" selected>Final</option>
          </select>
      </div>
      <div class="col-md-2" style="margin-top: 28px;" >
       <button onclick="generarReporteFinal()"><i class="fa fa-download" style=""></i> Generar</button>
      </div>
    </div>
  </div>

  <div class="reporte-box" >
    <h3>Generar Reporte de Certificado de Estudios</h3>
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-3">
          <label for="feLastName">Año Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio2" name="anio2"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso2" name="curso2"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($grados as $grado)
                <option value="{{$grado->id}}">{{$grado->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Periodo</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo2" name="periodo2"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($periodos as $periodo)
                <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
              @endforeach
              <option value="F">REPORTE FINAL</option>
          </select>
      </div>
      <div class="col-md-2" style="margin-top: 28px;" >
       <button onclick="generarReporteCertificadoEstudiosPorPeriodo()"><i class="fa fa-download" style=""></i> Generar</button>
      </div>
    </div>
  </div>
  <div class="reporte-box" style="display: none;">
    <h3>Generar Reporte por curso final</h3>
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-3">
          <label for="feLastName">Año Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio" name="anio"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($grados as $grado)
                <option value="{{$grado->id}}">{{$grado->nombre}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Estudiante</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="periodo" name="periodo"  required>
            <option value="" selected >Seleccione...</option>
              @foreach($estidiantes as $estudiante)
                <option value="{{$estudiante->id}}">{{$estudiante->nombre_estudiante}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3" style="margin-top: 28px;" >
       <button onclick="generarReportePorPeriodo()"><i class="fa fa-download" style=""></i> Generar</button>
      </div>
    </div>
  </div>
    
  
  <script>
    function generarReportePorPeriodo() {
      const anio = document.getElementById('anio1').value;
      const periodo = document.getElementById('periodo1').value;
      const curso = document.getElementById('curso1').value;

      console.log("Generar reporte por período:", { anio, periodo, curso });
      // Aquí puedes hacer una redirección o llamada AJAX
    }

    function generarReportePorEstudiante() {
      const anio = document.getElementById('anio2').value;
      const periodo = document.getElementById('periodo2').value;
      const curso = document.getElementById('curso2').value;
      const estudiante = document.getElementById('estudiante').value;

      console.log("Generar reporte por estudiante:", { anio, periodo, curso, estudiante });
      // Aquí puedes hacer una redirección o llamada AJAX
    }
  </script>

</div>

@endsection
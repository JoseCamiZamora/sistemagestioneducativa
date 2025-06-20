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
    <h3>Generar Reporte del Rankig de Estudiantes</h3>
    <div class="form-row col-md-12 mt-2">
      <div class="col-md-3">
          <label for="feLastName">Año Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="anio" name="anio"  required onchange="infoCursos(this.value,{{$docente->id}})">
            <option value="" selected >Seleccione...</option>
              @foreach($anios as $anio)
                <option value="{{$anio->id}}">{{$anio->anio_inicio}}-{{$anio->anio_fin}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-3">
          <label for="feLastName">Curso</label><spam style="color: red;"> * </spam>
          <select class="form-control" id="curso" name="curso"  disabled>
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
       <button onclick="generarReporteRankigEstudiantes()"><i class="fa fa-download" style=""></i> Generar Informe</button>
      </div>
    </div>
  </div>
  
  <script>
    var CURSOS = @json($grados);
    var DIRECTORES = @json($docenteDirector);
    
  </script>

</div>

@endsection
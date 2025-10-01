<?php

namespace App\Exports;

use App\User;
use Carbon\Carbon;
use App\Estudiantes;
use App\Docentes;
use App\TiposDocumentos;
use App\Materias;
use App\Grados;
use App\ConfAnios;
use App\ConfEvaluaciones;
use App\PeriodosClases;
use App\EstudiantesCurso;
use App\TipoCursos;
use App\ConfClasesDocente;
use App\EvaluacionEstudiante;
use App\NotaFinalEstudiante;
use App\EvaluacionTransicion;
use App\ItemEvaluarTransicion;
use App\ConceptosEvaluacion;
use App\ConceptosComportamiento;
use App\ConceptosEvaluacionTransicion;
use App\EvaluacionComportamiento;
use App\ConfDirectorGrupo;
use App\ConceptoFinalTransicion;
use App\NotaFinalTransicion;
use App\ObservacionEstudiante;

use Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class informe1Export implements FromView
{
   protected $anio;
   protected $curso;
   protected $periodo;

   function __construct($anio=null,$curso=null,$periodo=null) {
        $this->anio = $anio;
        $this->curso = $curso;
        $this->periodo = $periodo;
   }

  public function view(): View
  {
    $anio = $this->anio;
    $curso = $this->curso;
    $periodo = $this->periodo;

    $newArray = [];
    $usuarioactual = Auth::user();
    
    $docente = Docentes::find($usuarioactual->id_persona);
    $cursoFinal = Grados::find($curso);
    $periodoFinal = PeriodosClases::find($periodo);

    $estudiantesInactivos = EstudiantesCurso::where("id_anio",$anio)->where("id_curso",$curso)->where("estado",'I')->get();
    dd($estudiantesInactivos);

    $notaFinalEstudiante = NotaFinalEstudiante::where("id_anio",$anio)->where("id_grado",$curso)->get();
    foreach ($notaFinalEstudiante as $item) {
        array_push($newArray, $item); // Siempre agregamos la materia normal

        // Buscar si ya existe el comportamiento para ese estudiante
        $yaTieneComportamiento = collect($newArray)->contains(function($registro) use ($item) {
            return $registro->id_estudiante == $item->id_estudiante &&
                ($registro->desc_materia ?? '') === 'COMPORTAMIENTO';
        });

        if (!$yaTieneComportamiento) {
            $evaluacion = EvaluacionComportamiento::where("id_estudiante", $item->id_estudiante)->where("id_anio",$anio)
                ->where("id_grado", $curso)
                ->first();

            if ($evaluacion != null) {
                $evaluacion->desc_materia = 'COMPORTAMIENTO';
                array_push($newArray, $evaluacion);
            }
        }
    }

    $ordenDeseado = ['MATEMATICAS', 'CASTELLANO', 'INGLES', 'CIENCIAS NATURALES', 'RELIGION - ETICA Y VALORES','SOCIALES','INFORMATICA','EDUCACION FISICA','ARTISTICA','COMPORTAMIENTO'];
    $materiasOrdenadas = collect($newArray)->sortBy(function ($materia) use ($ordenDeseado) {
        return array_search($materia->desc_materia, $ordenDeseado);
    })->values();
   
    if($notaFinalEstudiante != null){
        $notas = collect($materiasOrdenadas);
        if($periodo == 1){
            $agrupado = $notas->groupBy('nom_estudiante')->map(function ($items, $estudiante) {
                $fila = ['ESTUDIANTE' => $estudiante];
                $suma = 0;
                $count = 0;
                    foreach ($items as $item) {
                        $fila[$item['desc_materia']] = $item['nota_periodo_uno'];
                        $suma += $item['nota_periodo_uno'];
                        $count++;
                    }
                $fila['PROMEDIO'] = $count > 0 ? round($suma / $count, 2) : 0;
                return $fila;
            })->values()->toArray();

        }elseif($periodo == 2){

            $agrupado = $notas->groupBy('nom_estudiante')->map(function ($items, $estudiante) {
                $fila = ['ESTUDIANTE' => $estudiante];
                $suma = 0;
                $count = 0;
                    foreach ($items as $item) {
                        $fila[$item['desc_materia']] = $item['nota_periodo_dos'];
                        $suma += $item['nota_periodo_dos'];
                        $count++;
                    }
                $fila['PROMEDIO'] = $count > 0 ? round($suma / $count, 2) : 0;
                return $fila;
            })->values()->toArray();

        }else{
            $agrupado = $notas->groupBy('nom_estudiante')->map(function ($items, $estudiante) {
                $fila = ['ESTUDIANTE' => $estudiante];
                $suma = 0;
                $count = 0;
                    foreach ($items as $item) {
                        $fila[$item['desc_materia']] = $item['nota_periodo_tres'];
                        $suma += $item['nota_periodo_tres'];
                        $count++;
                    }
                $fila['PROMEDIO'] = $count > 0 ? round($suma / $count, 2) : 0;
                return $fila;
            })->values()->toArray();
        }
        usort($agrupado, function ($a, $b) {
            return $b['PROMEDIO'] <=> $a['PROMEDIO'];
        });
        $total = 0;
        $contador = 0;

        foreach ($agrupado as $estudiante) {
            if (isset($estudiante['PROMEDIO']) && is_numeric($estudiante['PROMEDIO'])) {
                $total += $estudiante['PROMEDIO'];
                $contador++;
            }
        }
        $promedioCurso = $contador > 0 ? round($total / $contador, 2) : 0;

    }
    
    return view('excel.informe1Export_template')->with('listadoEstudiantes', $agrupado)
                                    ->with('docente', $docente)->with('cursoFinal', $cursoFinal)
                                    ->with('periodoFinal', $periodoFinal)->with('promedioCurso', $promedioCurso);
   
     
  }



}
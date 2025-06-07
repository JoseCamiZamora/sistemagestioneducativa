<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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



use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use setasign\Fpdi\Fpdi;
use Exception;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class EvaluacionController extends Controller
{

    private $storagePath;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storagePath = '/opt/gestioneducativa/data/storage/app/public';
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */

    public function listado_anios_evaluacion() {
        $usuarioactual = Auth::user();
        $lstAnios = ConfAnios::where("estado", "=", 'A')->paginate(50);
        $docente =  ConfDirectorGrupo::where("id_docente",$usuarioactual->id_persona)->first();
        $esDocenteTransicion = 'N';
        if($docente != null && $docente->id_curso == 1) {
            $esDocenteTransicion = 'S';
        }

        foreach ($lstAnios as $anio) {
            $directorGrupo =  ConfDirectorGrupo::where("id_docente",$usuarioactual->id_persona)->where("id_anio", $anio->id)->first();
            $clasesDocente =  ConfClasesDocente::where("id_docente",$usuarioactual->id_persona)->where("id_anio", $anio->id)->first();
            if($clasesDocente != null && $directorGrupo != null) {
                $anio->clasificacion = $clasesDocente->id_tipo_clase;
                $anio->esDirectorGrupo = 'S';
            }else{
                $anio->esDirectorGrupo = 'N';
                $anio->clasificacion  = 0;
            }
           
        }
        return view("evaluacion.listado_anios_evaluacion")->with("lstAnios", $lstAnios)
        ->with("esDocenteTransicion", $esDocenteTransicion)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_periodos_evaluar($idAnio= null){
       
        $anio = ConfAnios::find($idAnio);
        $periodos = json_decode($anio->json_periodos);
        $usuarioactual = Auth::user();

        return view('evaluacion.listado_periodos_evaluar')->with('anio',$anio)
        ->with("periodos",$periodos)
        ->with("idAnio",$idAnio)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_materias_configuradas($idPersona=null, $idAnio=null){

        $clasesDocente =  ConfClasesDocente::where("id_docente",$idPersona)->where("id_anio", $idAnio)->get();
        $anio = ConfAnios::find($idAnio);
        $usuarioactual = Auth::user();

        return view('evaluacion.listado_materias_evaluar')->with('anio',$anio)
        ->with("clasesDocente",$clasesDocente)
        ->with("idAnio",$idAnio)
        ->with("usuarioactual", $usuarioactual);
        
    }

    public function listado_cursos_configurados($idCurso=null){
        $clasesDocente =  ConfClasesDocente::find($idCurso);
        $cursos = json_decode($clasesDocente->json_cursos);
        return view('evaluacion.listado_cursos_evaluar')->with('clasesDocente',$clasesDocente)
        ->with("cursos",$cursos);

    }

    public function listado_estudiantes_configurados($idCurso=null, $idClase=null){
        $clasesDocente =  ConfClasesDocente::find($idClase);
        $lstEstudiantes = EstudiantesCurso::where("id_curso",$idCurso)->where("id_anio",$clasesDocente->id_anio)->get();
        foreach ($lstEstudiantes as $estudiante) {
            $estudiante->materia = $clasesDocente->nom_materia;
            $estudiante->id_materia = $clasesDocente->id_materia;
            $estudiante->id_docente = $clasesDocente->id_docente;
            $estudiante->nom_docente = $clasesDocente->nombre_docente;
        }

        $curso = Grados::find($idCurso);
        $evaluacionesFinales = NotaFinalEstudiante::all();

        foreach ($lstEstudiantes as $estudiante) {
            $estudianteFiltro = $estudiante->id_estudiante;
            $anioFiltro = $estudiante->id_anio;
            $cursoFiltro = $estudiante->id_curso;
            $materiaFiltro = $estudiante->id_materia;
        
            $filtrados = array_filter($evaluacionesFinales->toArray(), function($item) use ($estudianteFiltro, $anioFiltro, $cursoFiltro, $materiaFiltro) {
                return $item['id_estudiante'] == $estudianteFiltro &&
                       $item['id_anio'] == $anioFiltro &&
                       $item['id_grado'] == $cursoFiltro &&
                       $item['id_materia'] == $materiaFiltro;
            });

            if (empty($filtrados)) {
                $estudiante->nota_primer_periodo = 0;
                $estudiante->nota_segundo_periodo = 0;
                $estudiante->nota_tercer_periodo = 0;
                $estudiante->nota_final = 0;
                $estudiante->desempenio = 'Bajo';
            } else {
                foreach ($filtrados as $filtro) {
                    $estudiante->nota_primer_periodo = $filtro['nota_periodo_uno'];
                    $estudiante->nota_segundo_periodo = $filtro['nota_periodo_dos'];
                    $estudiante->nota_tercer_periodo = $filtro['nota_periodo_tres'];
                    $estudiante->nota_final = $filtro['nota_final'];
                    if ( $estudiante->nota_final >= 5) {
                        $estudiante->desempenio = 'Superior';
                    } elseif ( $estudiante->nota_final >= 4.5) {
                        $estudiante->desempenio = 'Alto';
                    } elseif ( $estudiante->nota_final >= 3.9) {
                        $estudiante->desempenio = 'Básico';
                    } else {
                        $estudiante->desempenio = 'Bajo';
                    }
                }
            }
        }

        return view('evaluacion.listado_estudiantes_evaluar')->with('clasesDocente',$clasesDocente)
        ->with("lstEstudiantes",$lstEstudiantes)
        ->with("curso",$curso);

    }

    
    public function listado_estudiantes_configurados_t($idCurso=null, $idAnio=null){
        
        $usuarioactual = Auth::user();
        $lstEstudiantes = EstudiantesCurso::where("id_curso",$idCurso)->where("id_anio",$idAnio)->get();
        

        $curso = Grados::find($idCurso);
        $evaluacionesFinales = NotaFinalTransicion::all();

        foreach ($lstEstudiantes as $estudiante) {
            $estudianteFiltro = $estudiante->id_estudiante;
            $anioFiltro = $estudiante->id_anio;
            $cursoFiltro = $estudiante->id_curso;
        
            $filtrados = array_filter($evaluacionesFinales->toArray(), function($item) use ($estudianteFiltro, $anioFiltro, $cursoFiltro) {
                return $item['id_estudiante'] == $estudianteFiltro &&
                       $item['id_anio'] == $anioFiltro &&
                       $item['id_grado'] == $cursoFiltro;
            });

            if (empty($filtrados)) {
                $estudiante->nota_primer_periodo = 0;
                $estudiante->nota_segundo_periodo = 0;
                $estudiante->nota_tercer_periodo = 0;
                $estudiante->nota_final = 0;
                $estudiante->desempenio ='En proceso';
            } else {
                foreach ($filtrados as $filtro) {
                    $estudiante->nota_primer_periodo = $filtro['nota_periodo_uno'];
                    $estudiante->nota_segundo_periodo = $filtro['nota_periodo_dos'];
                    $estudiante->nota_tercer_periodo = $filtro['nota_periodo_tres'];
                    $estudiante->nota_final = $filtro['nota_final'];
                    if($estudiante->nota_final > 0){
                        if ( $estudiante->nota_final >= 1.5) {
                            $estudiante->desempenio = 'Logro alcanzado';
                        } elseif ( $estudiante->nota_final > 0) {
                            $estudiante->desempenio = 'En proceso';
                        } else {
                            $estudiante->desempenio = '';
                        }
                    }else{
                        $estudiante->desempenio = 'En proceso';
                    }
                   
                }
            }
        }

        return view('evaluacion.listado_estudiantes_transicion_evaluar')->with("lstEstudiantes",$lstEstudiantes)
        ->with("usuarioactual",$usuarioactual)
        ->with("curso",$curso);

    }

    public function form_evaluacion($idEstudiante=null, $idClase=null){
        
        $estudiante = EstudiantesCurso::find($idEstudiante);
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($idClase);
        if($anios != null){
            $tiposEvaluacion = json_decode($anios->json_evaluaciones);
        }else{
            $tiposEvaluacion = [];
        }
        $lstConceptosEvaluar = ConceptosEvaluacion::where('id_anio', $claseDocente->id_anio)->where('id_materia',$claseDocente->id_materia)
                                                    ->where('id_grado',$estudiante->id_curso)->get();
        $conceptosComportamiento = ConceptosComportamiento::where('id_anio', $claseDocente->id_anio)->where('id_curso',$estudiante->id_curso)->get();
        $periodos = PeriodosClases::all();
        return view('evaluacion.form_evaluacion')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("tiposEvaluacion",$tiposEvaluacion)
        ->with("claseDocente",$claseDocente)
        ->with("lstConceptosEvaluar",$lstConceptosEvaluar)
        ->with("conceptosComportamiento",$conceptosComportamiento)
        ->with("periodos",$periodos);

    }

    public function form_evaluacion_comportamiento($idEstudiante=null, $idClase=null){
        
        $estudiante = EstudiantesCurso::find($idEstudiante);
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($idClase);
    
        $conceptosComportamiento = ConceptosComportamiento::where('id_anio', $anios->id)->where('id_curso',$estudiante->id_curso)->get();
        $periodos = PeriodosClases::all();

        return view('evaluacion.form_evaluacion_comportamiento')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("claseDocente",$claseDocente)
        ->with("conceptosComportamiento",$conceptosComportamiento)
        ->with("periodos",$periodos);

    }

    public function form_evaluacion_comportamiento_transicion($idEstudiante=null, $idClase=null){
        
        $estudiante = EstudiantesCurso::find($idEstudiante);
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($idClase);
    
        $conceptosComportamiento = ConceptosComportamiento::where('id_anio', $estudiante->id_anio)->where('id_curso',$estudiante->id_curso)->get();
        $periodos = PeriodosClases::all();

        return view('evaluacion.form_evaluacion_comportamiento_transicion')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("claseDocente",$claseDocente)
        ->with("conceptosComportamiento",$conceptosComportamiento)
        ->with("periodos",$periodos);

    }

    public function form_evaluacion_transicion($idEstudiante=null){
        
        $estudiante = EstudiantesCurso::find($idEstudiante);
        $anios = ConfAnios::find($estudiante->id_anio);
        $lstMaterias = Materias::where("tipo_curso", 1)->get();
        $itemEvaluar = ItemEvaluarTransicion::all();
       
        $filtradosCognitiva = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 11;
        });
        $filtradosComunicativa = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 12;
        });
        $filtradosEtica = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 13;
        });
        $filtradosEsteica = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 14;
        });
        $filtradosSocioafectiva = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 17;
        });
        $filtradosCorporal = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 15;
        });
        $filtradosEspiritual = $itemEvaluar->filter(function ($item) {
            return $item->id_materia == 16;
        });

        $periodos = PeriodosClases::all();

        return view('evaluacion.form_evaluacion_transicion')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("filtradosCognitiva",$filtradosCognitiva)->with("filtradosComunicativa",$filtradosComunicativa)
        ->with("filtradosEtica",$filtradosEtica)->with("filtradosEsteica",$filtradosEsteica)
        ->with("filtradosSocioafectiva",$filtradosSocioafectiva)->with("filtradosCorporal",$filtradosCorporal)
        ->with("filtradosEspiritual",$filtradosEspiritual)
        ->with("lstMaterias",$lstMaterias)
        ->with("periodos",$periodos);

    }

    public function crear_evaluacion_estudiante(Request $request){
        
        $estudiante = EstudiantesCurso::find($request->input('id_estudiante_curso'));
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($request->input('id_clase'));
        $periodo = PeriodosClases::find($request->input('periodo'));
        $filas = $request->input('filas');
        $notas = json_decode($filas[0]['notas'], true);
        $notaFinal = $filas[0]['nota_final'];
        $desempeno = $filas[0]['desempeno'];
        $notasArray = array();
        $evaluacion = EvaluacionEstudiante::where("id_estudiante",$estudiante->id_estudiante)->where("id_periodo",$periodo->id)
                                            ->where("id_materia",$claseDocente->id_materia)->first();
        if($evaluacion == null){
            $evaluacion = new EvaluacionEstudiante();

            $evaluacion->id_estudiante_curso = $estudiante->id;
            $evaluacion->id_anio = $estudiante->id_anio;
            $evaluacion->des_anio = $estudiante->desc_anio;
            $evaluacion->id_estudiante = $estudiante->id_estudiante;
            $evaluacion->nom_estudiante = $estudiante->nombre_estudiante;
            $evaluacion->id_materia =  $claseDocente->id_materia;
            $evaluacion->nom_materia =  $claseDocente->nom_materia;
            $evaluacion->id_periodo = $periodo->id;
            $evaluacion->nom_perido = $periodo->nombre;

           
            foreach ($notas as $dataNota) {
                $actividad = ConfEvaluaciones::find($dataNota["id"]);
                $newarraynotas = array(
                    "id" => $actividad->id,
                    "nombre" => $actividad->descripcion,
                    "nota" => $dataNota["value"]
                );
                array_push($notasArray, $newarraynotas);
            }
        }else{
            foreach ($notas as $dataNota) {
                $actividad = ConfEvaluaciones::find($dataNota["id"]);
                $newarraynotas = array(
                    "id" => $actividad->id,
                    "nombre" => $actividad->descripcion,
                    "nota" => $dataNota["value"]
                );
                array_push($notasArray, $newarraynotas);
            }
        }

        $evaluacion->sum_nota = round($notaFinal,2);
        $evaluacion->desempenio = $desempeno;
        $evaluacion->json_evaluaciones = json_encode($notasArray);
        $evaluacion->estado = 'A';
        $evaluacion->conceptos = $request->input('conceptos')?$request->input('conceptos'):"";

        $notaFinalEstudiante = NotaFinalEstudiante::where("id_anio",$estudiante->id_anio)->where("id_estudiante",$estudiante->id_estudiante)
                                                    ->where("id_grado",$estudiante->id_curso)
                                                    ->where("id_materia",$claseDocente->id_materia)
                                                    ->where("id_docente",$claseDocente->id_docente)->first();
        if($notaFinalEstudiante == null){
            $notaFinalEstudiante = new NotaFinalEstudiante();
            $notaFinalEstudiante->id_anio =$estudiante->id_anio;
            $notaFinalEstudiante->des_anio = $estudiante->desc_anio;
            $notaFinalEstudiante->id_estudiante = $estudiante->id_estudiante;
            $notaFinalEstudiante->nom_estudiante = $estudiante->nombre_estudiante;
            $notaFinalEstudiante->id_docente = $claseDocente->id_docente;
            $notaFinalEstudiante->nom_docente = $claseDocente->nombre_docente;
            $notaFinalEstudiante->id_grado = $estudiante->id_curso;
            $notaFinalEstudiante->desc_grado = $estudiante->nom_curso;
            $notaFinalEstudiante->id_materia = $claseDocente->id_materia;
            $notaFinalEstudiante->desc_materia = $claseDocente->nom_materia;
            $notaFinalEstudiante->estado = "A";
            if($periodo->id == 1){
                $notaFinalEstudiante->nota_periodo_uno = $notaFinal;
                $notaFinalEstudiante->nota_periodo_dos = 0;
                $notaFinalEstudiante->nota_periodo_tres = 0;
                $notaFinalEstudiante->concepto_per1 = $evaluacion->conceptos;

            }elseif($periodo->id == 2){
                $notaFinalEstudiante->nota_periodo_dos = $notaFinal;
                $notaFinalEstudiante->nota_periodo_uno = 0;
                $notaFinalEstudiante->nota_periodo_tres = 0;
                $notaFinalEstudiante->concepto_per2 = $evaluacion->conceptos;
            }else{
                $notaFinalEstudiante->nota_periodo_tres = $notaFinal;
                $notaFinalEstudiante->nota_periodo_uno = 0;
                $notaFinalEstudiante->nota_periodo_dos = 0;
                $notaFinalEstudiante->concepto_per3 = $evaluacion->conceptos;
            }
            $suma = floatval(isset($notaFinalEstudiante->nota_periodo_uno) ? $notaFinalEstudiante->nota_periodo_uno : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_dos) ? $notaFinalEstudiante->nota_periodo_dos : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_tres) ? $notaFinalEstudiante->nota_periodo_tres : 0);
            
            
            $notaFinal =  $suma / $anios->cant_periodos;
            $notaFinalEstudiante->nota_final =  round($notaFinal,2);
            $notaFinalEstudiante->concepto_final = "";

        }else{
            if($periodo->id == 1){
                $notaFinalEstudiante->nota_periodo_uno = $notaFinal;
                $notaFinalEstudiante->concepto_per1 = $evaluacion->conceptos;
            }elseif($periodo->id == 2){
                $notaFinalEstudiante->nota_periodo_dos = $notaFinal;
                $notaFinalEstudiante->concepto_per2 = $evaluacion->conceptos;
            }else{
                $notaFinalEstudiante->nota_periodo_tres = $notaFinal;
                $notaFinalEstudiante->concepto_per3 = $evaluacion->conceptos;
                
            }
            $suma = floatval(isset($notaFinalEstudiante->nota_periodo_uno) ? $notaFinalEstudiante->nota_periodo_uno : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_dos) ? $notaFinalEstudiante->nota_periodo_dos : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_tres) ? $notaFinalEstudiante->nota_periodo_tres : 0);
            
            $notaFinal =  $suma / $anios->cant_periodos;
            $notaFinalEstudiante->nota_final =  round($notaFinal,2);
            $notaFinalEstudiante->concepto_final = "";
        }

        if($evaluacion->save()){
            $notaFinalEstudiante->save();
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","La evaluación fue alamcenada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
       
    }

    public function crear_evaluacion_comportamiento(Request $request){
        
        $estudiante = EstudiantesCurso::find($request->input('id_estudiante_curso'));
        $anios = ConfAnios::find($estudiante->id_anio);
        $periodo = PeriodosClases::find($request->input('periodo'));
        $notaComportamiento = $request->input('nota_comportamiento')?$request->input('nota_comportamiento'):"";
        $conceptoComportamiento = $request->input('conceptos_comportamiento')?$request->input('conceptos_comportamiento'):"";

        $evaluacion = EvaluacionComportamiento::where("id_estudiante",$estudiante->id_estudiante)->where("id_grado",$estudiante->id_curso)->first();
        if($evaluacion == null){
            $evaluacion = new EvaluacionComportamiento();

            $evaluacion->fecha_evaluacion = Carbon::now()->toDateString();
            $evaluacion->id_anio = $estudiante->id_anio;
            $evaluacion->nom_anio = $estudiante->desc_anio;
            $evaluacion->id_estudiante = $estudiante->id_estudiante;
            $evaluacion->nom_estudiante = $estudiante->nombre_estudiante;
            $evaluacion->id_grado =  $estudiante->id_curso;
            $evaluacion->nom_grado =  $estudiante->nom_curso;
            $evaluacion->nota_periodo_uno = "0";
            $evaluacion->nota_periodo_dos = "0";
            $evaluacion->nota_periodo_tres = "0";
            $evaluacion->concepto_per1 = "";
            $evaluacion->concepto_per2 = "";
            $evaluacion->concepto_per3 = "";

            if($periodo->id == 1){
                $evaluacion->nota_periodo_uno = $notaComportamiento;
                $evaluacion->concepto_per1 = $conceptoComportamiento;
            }elseif($periodo->id == 2){
                $evaluacion->nota_periodo_dos = $notaComportamiento;
                $evaluacion->concepto_per2 = $conceptoComportamiento;
            }else{
                $evaluacion->nota_periodo_tres = $notaComportamiento;
                $evaluacion->concepto_per3 = $conceptoComportamiento;
            }
        }else{
             if($periodo->id == 1){
                $evaluacion->nota_periodo_uno = $notaComportamiento;
                $evaluacion->concepto_per1 = $conceptoComportamiento;
            }elseif($periodo->id == 2){
                $evaluacion->nota_periodo_dos = $notaComportamiento;
                $evaluacion->concepto_per2 = $conceptoComportamiento;
            }else{
                $evaluacion->nota_periodo_tres = $notaComportamiento;
                $evaluacion->concepto_per3 = $conceptoComportamiento;
            }
        }
        
        $suma = floatval(isset($evaluacion->nota_periodo_uno) ? $evaluacion->nota_periodo_uno : 0) +
                    floatval(isset($evaluacion->nota_periodo_dos) ? $evaluacion->nota_periodo_dos : 0) +
                    floatval(isset($evaluacion->nota_periodo_tres) ? $evaluacion->nota_periodo_tres : 0);
        
        $notaFinal =  $suma / $anios->cant_periodos;
        $evaluacion->nota_final = round($notaFinal,2);
        if (  $evaluacion->nota_final >= 5) {
            $estudiante->desempenio = 'Superior';
        } elseif (  $evaluacion->nota_final >= 4.5) {
            $estudiante->desempenio = 'Alto';
        } elseif (  $evaluacion->nota_final >= 3.9) {
            $estudiante->desempenio = 'Básico';
        } else {
            $estudiante->desempenio = 'Bajo';
        }
        if($evaluacion->save()){
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","La evaluación fue alamcenada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
       
    }

    public function crear_evaluacion_comportamiento_transicion(Request $request){
        
        $estudiante = EstudiantesCurso::find($request->input('id_estudiante_curso'));
        $anios = ConfAnios::find($estudiante->id_anio);
        $periodo = PeriodosClases::find($request->input('periodo'));
        $notaComportamiento = $request->input('desempenio_compo')?$request->input('desempenio_compo'):"";
        $conceptoComportamiento = $request->input('conceptos_comportamiento')?$request->input('conceptos_comportamiento'):"";

        $evaluacion = EvaluacionComportamiento::where("id_estudiante",$estudiante->id_estudiante)->where("id_grado",$estudiante->id_curso)->first();
        if($evaluacion == null){
            $evaluacion = new EvaluacionComportamiento();

            $evaluacion->fecha_evaluacion = Carbon::now()->toDateString();
            $evaluacion->id_anio = $estudiante->id_anio;
            $evaluacion->nom_anio = $estudiante->desc_anio;
            $evaluacion->id_estudiante = $estudiante->id_estudiante;
            $evaluacion->nom_estudiante = $estudiante->nombre_estudiante;
            $evaluacion->id_grado =  $estudiante->id_curso;
            $evaluacion->nom_grado =  $estudiante->nom_curso;
            $evaluacion->nota_periodo_uno = "0";
            $evaluacion->nota_periodo_dos = "0";
            $evaluacion->nota_periodo_tres = "0";
            $evaluacion->concepto_per1 = "";
            $evaluacion->concepto_per2 = "";
            $evaluacion->concepto_per3 = "";

            if($periodo->id == 1){
                $evaluacion->nota_periodo_uno = $notaComportamiento;
                $evaluacion->concepto_per1 = $conceptoComportamiento;
            }elseif($periodo->id == 2){
                $evaluacion->nota_periodo_dos = $notaComportamiento;
                $evaluacion->concepto_per2 = $conceptoComportamiento;
            }else{
                $evaluacion->nota_periodo_tres = $notaComportamiento;
                $evaluacion->concepto_per3 = $conceptoComportamiento;
            }
        }else{
             if($periodo->id == 1){
                $evaluacion->nota_periodo_uno = $notaComportamiento;
                $evaluacion->concepto_per1 = $conceptoComportamiento;
            }elseif($periodo->id == 2){
                $evaluacion->nota_periodo_dos = $notaComportamiento;
                $evaluacion->concepto_per2 = $conceptoComportamiento;
            }else{
                $evaluacion->nota_periodo_tres = $notaComportamiento;
                $evaluacion->concepto_per3 = $conceptoComportamiento;
            }
        }
        
        $suma = floatval(isset($evaluacion->nota_periodo_uno) ? $evaluacion->nota_periodo_uno : 0) +
                    floatval(isset($evaluacion->nota_periodo_dos) ? $evaluacion->nota_periodo_dos : 0) +
                    floatval(isset($evaluacion->nota_periodo_tres) ? $evaluacion->nota_periodo_tres : 0);
        
        $notaFinal =  $suma / $anios->cant_periodos;
        $evaluacion->nota_final = round($notaFinal,2);
        if ( $estudiante->nota_final >= 2.5 && $estudiante->nota_final <= 3) {
            $estudiante->desempenio = 'Alto';
        } elseif ( $estudiante->nota_final >= 1.5 && $estudiante->nota_final < 2.5) {
            $estudiante->desempenio = 'Medio';
        } elseif ( $estudiante->nota_final > 0 && $estudiante->nota_final < 1.5 ) {
            $estudiante->desempenio = 'Bajo';
        }
        
        if($evaluacion->save()){
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","La evaluación fue alamcenada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
       
    }

    public function consultar_evaluacion($idPeriodo=null, $id_estudiante=null,$idClase = null){
        
        $estudiante = EstudiantesCurso::find($id_estudiante);
        $claseDocente =  ConfClasesDocente::find($idClase);
        $evaluacion = EvaluacionEstudiante::where("id_estudiante",$estudiante->id_estudiante)->where("id_periodo",$idPeriodo)
                                                ->where("id_materia",$claseDocente->id_materia)->first();
        
        if($evaluacion != null){
            $notas = json_decode($evaluacion->json_evaluaciones);
            $notaFinal = $evaluacion->sum_nota;
            $desempenio = $evaluacion->desempenio;
            $conceptos = $evaluacion->conceptos;
        }else{
            $notas = [];
            $notaFinal = 0;
            $desempenio = 'Bajo';
            $conceptos = '';
        }
        return response()->json([ 'notas' => $notas,'nota_final' =>$notaFinal, 'desempenio' => $desempenio,'conceptos' =>$conceptos],200);

    }

    public function consultar_evaluacion_comportamiento($idPeriodo=null, $id_estudiante=null,$idClase = null){
        
        $estudiante = EstudiantesCurso::find($id_estudiante);
        $claseDocente =  ConfClasesDocente::find($idClase);
        $evaluacion = EvaluacionComportamiento::where("id_estudiante",$estudiante->id_estudiante)->where("id_grado",$estudiante->id_curso)->first();
        
        if($evaluacion != null){
            if($idPeriodo == 1){
                $notaComportamiento = $evaluacion->nota_periodo_uno;
                $conceptoComportamiento = $evaluacion->concepto_per1;
            }elseif($idPeriodo == 2){
                $notaComportamiento = $evaluacion->nota_periodo_dos;
                $conceptoComportamiento = $evaluacion->concepto_per2;
            }else{
                $notaComportamiento = $evaluacion->nota_periodo_tres;
                $conceptoComportamiento = $evaluacion->concepto_per3;
            }
        }else{
            $notaComportamiento = 0;
            $conceptoComportamiento = '';
        }
        return response()->json(['notaComportamiento' => $notaComportamiento, 'conceptoComportamiento' => $conceptoComportamiento,
                                    'claseDocente'=>$claseDocente],200);

    }

    public function consultar_evaluacion_transicion($idPeriodo=null, $id_estudiante=null){
        
        $estudiante = EstudiantesCurso::find($id_estudiante);
        $evaluacion = EvaluacionTransicion::where("id_estudiante",$estudiante->id_estudiante)->where("id_periodo",$idPeriodo)->first();
        
        if($evaluacion != null){
            $notas = json_decode($evaluacion->json_evaluaciones);
        }else{
            $notas = [];
        }
        return response()->json([ 'notas' => $notas],200);

    }

    public function crear_evaluacion_transicion(Request $request){

        $estudiante = EstudiantesCurso::find($request->input('id_estudiante_curso'));
        $anios = ConfAnios::find($estudiante->id_anio);
        $periodo = PeriodosClases::find($request->input('periodo'));
        $evaluaciones = json_decode($request->input('evaluaciones'),true);

        $total = 0;
        $cantidad = count($evaluaciones);
        foreach ($evaluaciones as $item) {
            $total += (int) $item['evaluacion'];
        }
        // 3. Calcular el promedio
        $notaFinalResultado = $cantidad > 0 ? $total / $cantidad : 0;
        $notaFinal = round($notaFinalResultado,2);

        $notasArray = array();
        $evaluacion = EvaluacionTransicion::where("id_estudiante",$estudiante->id_estudiante)->where("id_periodo",$periodo->id)->first();
        if($evaluacion == null){
            $evaluacion = new EvaluacionTransicion();
            
            $evaluacion->id_estudiante_curso = $estudiante->id;
            $evaluacion->id_anio = $estudiante->id_anio;
            $evaluacion->des_anio = $estudiante->desc_anio;
            $evaluacion->id_estudiante = $estudiante->id_estudiante;
            $evaluacion->nom_estudiante = $estudiante->nombre_estudiante;
            $evaluacion->id_periodo = $periodo->id;
            $evaluacion->nom_perido = $periodo->nombre;

            foreach ($evaluaciones as $dataNota) {
                $actividad = ItemEvaluarTransicion::find($dataNota["id_criterio"]);
                $newarraynotas = array(
                    "id" => $actividad->id,
                    "dimencion" => $actividad->nom_materia,
                    "id_dimencion" => $actividad->id_materia,
                    "nombre" => $actividad->descripcion,
                    "nota" => $dataNota["evaluacion"]
                );
                array_push($notasArray, $newarraynotas);
            }
        }else{
            foreach ($evaluaciones as $dataNota) {
                $actividad = ItemEvaluarTransicion::find($dataNota["id_criterio"]);
                $newarraynotas = array(
                    "id" => $actividad->id,
                    "dimencion" => $actividad->nom_materia,
                    "id_dimencion" => $actividad->id_materia,
                    "nombre" => $actividad->descripcion,
                    "nota" => $dataNota["evaluacion"]
                );
                array_push($notasArray, $newarraynotas);
            }
        }
        $evaluacion->sum_nota = round($notaFinal,2);
        $evaluacion->json_evaluaciones = json_encode($notasArray);
        $evaluacion->estado = 'A';

        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);

        $notaFinalEstudiante = NotaFinalTransicion::where("id_anio",$estudiante->id_anio)->where("id_estudiante",$estudiante->id_estudiante)
                                                    ->where("id_grado",$estudiante->id_curso)->where("id_docente",$docente->id)->first();
        if($notaFinalEstudiante == null){
            $notaFinalEstudiante = new NotaFinalTransicion();
            $notaFinalEstudiante->id_anio =$estudiante->id_anio;
            $notaFinalEstudiante->des_anio = $estudiante->desc_anio;
            $notaFinalEstudiante->id_estudiante = $estudiante->id_estudiante;
            $notaFinalEstudiante->nom_estudiante = $estudiante->nombre_estudiante;
            $notaFinalEstudiante->id_docente = $docente->id;
            $notaFinalEstudiante->nom_docente = $docente->nom_completo;
            $notaFinalEstudiante->id_grado = $estudiante->id_curso;
            $notaFinalEstudiante->desc_grado = $estudiante->nom_curso;
            $notaFinalEstudiante->estado = "A";
            if($periodo->id == 1){
                $notaFinalEstudiante->nota_periodo_uno = $evaluacion->sum_nota;
                $notaFinalEstudiante->nota_periodo_dos = 0;
                $notaFinalEstudiante->nota_periodo_tres = 0;
            }elseif($periodo->id == 2){
                $notaFinalEstudiante->nota_periodo_dos = $evaluacion->sum_nota;
                $notaFinalEstudiante->nota_periodo_uno = 0;
                $notaFinalEstudiante->nota_periodo_tres = 0;
            }else{
                $notaFinalEstudiante->nota_periodo_tres = $evaluacion->sum_nota;
                $notaFinalEstudiante->nota_periodo_uno = 0;
                $notaFinalEstudiante->nota_periodo_dos = 0;
            }
            $suma = floatval(isset($notaFinalEstudiante->nota_periodo_uno) ? $notaFinalEstudiante->nota_periodo_uno : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_dos) ? $notaFinalEstudiante->nota_periodo_dos : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_tres) ? $notaFinalEstudiante->nota_periodo_tres : 0);
            
            $notaFinalResul =  $suma / $anios->cant_periodos;
            $notaFinalPer =  round($notaFinalResul,2);
            $notaFinalEstudiante->nota_final =  $notaFinalPer;
        }else{
            if($periodo->id == 1){
                $notaFinalEstudiante->nota_periodo_uno = $notaFinal;
            }elseif($periodo->id == 2){
                $notaFinalEstudiante->nota_periodo_dos = $notaFinal;
            }else{
                $notaFinalEstudiante->nota_periodo_tres = $notaFinal;
            }
            $suma = floatval(isset($notaFinalEstudiante->nota_periodo_uno) ? $notaFinalEstudiante->nota_periodo_uno : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_dos) ? $notaFinalEstudiante->nota_periodo_dos : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_tres) ? $notaFinalEstudiante->nota_periodo_tres : 0);
            
            $notaFinalFinal =  $suma / $anios->cant_periodos;
            $notaFinalPer =  round($notaFinalFinal,2);
            $notaFinalEstudiante->nota_final =  $notaFinalPer;
            $notaFinalEstudiante->concepto_final = "";
        }
        if($evaluacion->save()){
            $notaFinalEstudiante->save();
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","La evaluacion fue alamcenada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function listado_estudiantes_evaluar($idPersona=null, $idAnio=null){

        $directorGrupo =  ConfDirectorGrupo::where("id_docente",$idPersona)->where("id_anio", $idAnio)->first();
        $lstEstudiantes = EstudiantesCurso::where("id_curso",$directorGrupo->id_curso)->where("id_anio",$idAnio)->get();

        $curso = Grados::find($directorGrupo->id_curso);
        $evaluacionesFinales = EvaluacionComportamiento::all();

        foreach ($lstEstudiantes as $estudiante) {
            $estudianteFiltro = $estudiante->id_estudiante;
            $anioFiltro = $estudiante->id_anio;
            $cursoFiltro = $estudiante->id_curso;

            $filtrados = array_filter($evaluacionesFinales->toArray(), function($item) use ($estudianteFiltro, $anioFiltro, $cursoFiltro) {
                return $item['id_estudiante'] == $estudianteFiltro &&
                        $item['id_anio'] == $anioFiltro &&
                        $item['id_grado'] == $cursoFiltro;
            });

            if (empty($filtrados)) {
                $estudiante->nota_primer_periodo = 0;
                $estudiante->nota_segundo_periodo = 0;
                $estudiante->nota_tercer_periodo = 0;
                $estudiante->nota_final = 0;
                $estudiante->desempenio = 'Bajo';
            } else {
                foreach ($filtrados as $filtro) {
                    $estudiante->nota_primer_periodo = $filtro['nota_periodo_uno'];
                    $estudiante->nota_segundo_periodo = $filtro['nota_periodo_dos'];
                    $estudiante->nota_tercer_periodo = $filtro['nota_periodo_tres'];
                    $estudiante->nota_final = $filtro['nota_final'];
                    if ( $estudiante->nota_final >= 4.6) {
                        $estudiante->desempenio = 'Superior';
                    } elseif ( $estudiante->nota_final >= 4.0) {
                        $estudiante->desempenio = 'Alto';
                    } elseif ( $estudiante->nota_final >= 3.0) {
                        $estudiante->desempenio = 'Básico';
                    } else {
                        $estudiante->desempenio = 'Bajo';
                    }
                }
            }


        }

        return view('evaluacion.listado_estudiantes_evaluar_comportamiento')->with("lstEstudiantes",$lstEstudiantes)->with("curso",$curso);
        
    }

    public function listado_estudiantes_evaluar_transicion($idPersona=null, $idAnio=null){

        $directorGrupo =  ConfDirectorGrupo::where("id_docente",$idPersona)->where("id_anio", $idAnio)->first();
        $lstEstudiantes = EstudiantesCurso::where("id_curso",$directorGrupo->id_curso)->where("id_anio",$idAnio)->get();

        $curso = Grados::find($directorGrupo->id_curso);
        $evaluacionesFinales = EvaluacionComportamiento::all();

        foreach ($lstEstudiantes as $estudiante) {
            $estudianteFiltro = $estudiante->id_estudiante;
            $anioFiltro = $estudiante->id_anio;
            $cursoFiltro = $estudiante->id_curso;

            $filtrados = array_filter($evaluacionesFinales->toArray(), function($item) use ($estudianteFiltro, $anioFiltro, $cursoFiltro) {
                return $item['id_estudiante'] == $estudianteFiltro &&
                        $item['id_anio'] == $anioFiltro &&
                        $item['id_grado'] == $cursoFiltro;
            });

            if (empty($filtrados)) {
                $estudiante->nota_primer_periodo = 0;
                $estudiante->nota_segundo_periodo = 0;
                $estudiante->nota_tercer_periodo = 0;
                $estudiante->nota_final = 0;
                $estudiante->desempenio = 'Bajo';
            } else {
                foreach ($filtrados as $filtro) {
                    $estudiante->nota_primer_periodo = $filtro['nota_periodo_uno'];
                    $estudiante->nota_segundo_periodo = $filtro['nota_periodo_dos'];
                    $estudiante->nota_tercer_periodo = $filtro['nota_periodo_tres'];
                    $estudiante->nota_final = $filtro['nota_final'];
                    if ( $estudiante->nota_final >= 2.5 && $estudiante->nota_final <= 3) {
                        $estudiante->desempenio = 'Alto';
                    } elseif ( $estudiante->nota_final >= 1.5 && $estudiante->nota_final < 2.5) {
                        $estudiante->desempenio = 'Medio';
                    } elseif ( $estudiante->nota_final > 0 && $estudiante->nota_final < 1.5 ) {
                        $estudiante->desempenio = 'Bajo';
                    }
                }
            }


        }
        return view('evaluacion.listado_estudiantes_evaluar_comportamiento_transicion')->with("lstEstudiantes",$lstEstudiantes)->with("curso",$curso);
    }

    public function listado_estudiantes_transicion($idPersona=null, $idAnio=null, $clasificacion=null){

        $lstEstudiantes = EstudiantesCurso::where("id_curso",$clasificacion)->where("id_anio",$idAnio)->get();
        $lstMaterias = Materias::where("tipo_curso", 1)->get();
        $cantidadMaterias = count($lstMaterias);

        foreach ($lstEstudiantes as $estudiante) {
            $evaluacionesFinales = NotaFinalEstudiante::where("id_estudiante",$estudiante->id)->where("id_anio",$idAnio)->get();
            if($evaluacionesFinales != null){
                $cantidad = count($evaluacionesFinales);
                $estudiante->materias_evaluadas = $cantidad;
                $estudiante->pendientes_evaluar = $cantidadMaterias - $cantidad;
            }else{
                $estudiante->materias_evaluadas = 0;
                $estudiante->pendientes_evaluar = 0;
            }
        }
         
        return view('evaluacion.listado_estudiantes_transicion')->with("lstEstudiantes",$lstEstudiantes);
        
    }

    public function form_generar_concepto_transicion($idEstudiante=null, $idClase=null){
        
        $estudiante = EstudiantesCurso::find($idEstudiante);
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($idClase);
        $lstMaterias = Materias::where("tipo_curso", 1)->get();
    
        $lstConceptosEvaluar = ConceptosEvaluacionTransicion::where('id_anio', $anios->id)->where('id_grado',$estudiante->id_curso)->get();
        $periodos = PeriodosClases::all();

        return view('evaluacion.form_generacion_concepto_transicion')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("claseDocente",$claseDocente)
        ->with("lstMaterias",$lstMaterias)
        ->with("lstConceptosEvaluar",$lstConceptosEvaluar)
        ->with("periodos",$periodos);

    }

    public function consultar_evaluacion_materias_transicion($idPeriodo=null, $id_estudiante=null){
        
        $estudiante = EstudiantesCurso::find($id_estudiante);
        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);

        $notaFinalEstudiante = NotaFinalTransicion::where("id_anio",$estudiante->id_anio)->where("id_estudiante",$estudiante->id_estudiante)
                                                    ->where("id_grado",$estudiante->id_curso)->where("id_docente",$docente->id)->first();
        if($notaFinalEstudiante != null){
            if($idPeriodo == 1){
                $textoConcepto = $notaFinalEstudiante->concepto_per1;
                $textoNota = floatval(isset($notaFinalEstudiante->nota_periodo_uno) ? $notaFinalEstudiante->nota_periodo_uno : 0);
            }elseif($idPeriodo == 2){
                 $textoConcepto = $notaFinalEstudiante->concepto_per2;
                  $textoNota = floatval(isset($notaFinalEstudiante->nota_periodo_dos) ? $notaFinalEstudiante->nota_periodo_dos : 0);
            }else{
                $textoConcepto = $notaFinalEstudiante->concepto_per3;
                 $textoNota = floatval(isset($notaFinalEstudiante->nota_periodo_tres) ? $notaFinalEstudiante->nota_periodo_tres : 0);
            }
        }

        return response()->json(['textoConcepto' => $textoConcepto, 'textoNota' =>  $textoNota],200);

    }

    public function crear_concepto_transicion(Request $request){
        
        $estudiante = EstudiantesCurso::find($request->input('id_estudiante_curso'));
        $periodo = PeriodosClases::find($request->input('periodo'));
        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);

        $concepto = NotaFinalTransicion::where("id_anio",$estudiante->id_anio)->where("id_estudiante",$estudiante->id_estudiante)
                                                    ->where("id_grado",$estudiante->id_curso)->where("id_docente",$docente->id)->first();
        if($periodo->id == 1){
            $concepto->concepto_per1 = $request->input('conceptos')?$request->input('conceptos'):"";
        }elseif($periodo->id == 2){
            $concepto->concepto_per2 = $request->input('conceptos')?$request->input('conceptos'):"";
        }else{
            $concepto->concepto_per3 = $request->input('conceptos')?$request->input('conceptos'):"";
        }
        
        if($concepto->save()){
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","El concepto fue almacenado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }

    }

    


    

    

}

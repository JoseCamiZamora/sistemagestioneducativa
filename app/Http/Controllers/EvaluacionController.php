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
        return view("evaluacion.listado_anios_evaluacion")->with("lstAnios", $lstAnios)
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
                    } else if ( $estudiante->nota_final >= 4.5) {
                        $estudiante->desempenio = 'Alto';
                    } else if ( $estudiante->nota_final >= 3.9) {
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

    
    public function listado_estudiantes_configurados_t($idCurso=null, $idClase=null){
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
                $estudiante->desempenio = 'En proceso';
            } else {
                foreach ($filtrados as $filtro) {
                    $estudiante->nota_primer_periodo = $filtro['nota_periodo_uno'];
                    $estudiante->nota_segundo_periodo = $filtro['nota_periodo_dos'];
                    $estudiante->nota_tercer_periodo = $filtro['nota_periodo_tres'];
                    $estudiante->nota_final = $filtro['nota_final'];
                    if($estudiante->nota_final > 0){
                        if ( $estudiante->nota_final >= 2.5) {
                            $estudiante->desempenio = 'Logro alcanzado';
                        } elseif ( $estudiante->nota_final >= 1.5) {
                            $estudiante->desempenio = 'En proceso';
                        } else {
                            $estudiante->desempenio = 'Se requiere apoyo';
                        }
                    }else{
                        $estudiante->desempenio = 'En proceso';
                    }
                   
                }
            }
        }

        return view('evaluacion.listado_estudiantes_transicion_evaluar')->with('clasesDocente',$clasesDocente)
        ->with("lstEstudiantes",$lstEstudiantes)
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
        $periodos = PeriodosClases::all();
        return view('evaluacion.form_evaluacion')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("tiposEvaluacion",$tiposEvaluacion)
        ->with("claseDocente",$claseDocente)
        ->with("periodos",$periodos);

    }

    public function form_evaluacion_transicion($idEstudiante=null, $idClase=null){
        
        $estudiante = EstudiantesCurso::find($idEstudiante);
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($idClase);
        $itemEvaluar = ItemEvaluarTransicion::where('id_materia', $claseDocente->id_materia)->get();
        $periodos = PeriodosClases::all();
        return view('evaluacion.form_evaluacion_transicion')->with('estudiante',$estudiante)
        ->with("anios",$anios)
        ->with("itemEvaluar",$itemEvaluar)
        ->with("claseDocente",$claseDocente)
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
                $actividad = new ConfEvaluaciones();
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
                $actividad = new ConfEvaluaciones();
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
        $evaluacion->conceptos = $request->input('periodo')?$request->input('periodo'):"";
        //dd("id_anio",$estudiante->id_anio,"id_grado",$estudiante->id_curso,"id_materia",$claseDocente->id_materia,"id_materia",$claseDocente->id_materia,"id_docente",$claseDocente->id_docente);
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
            }else if($periodo->id == 2){
                $notaFinalEstudiante->nota_periodo_dos = $notaFinal;
                $notaFinalEstudiante->nota_periodo_uno = 0;
                $notaFinalEstudiante->nota_periodo_tres = 0;
            }else{
                $notaFinalEstudiante->nota_periodo_tres = $notaFinal;
                $notaFinalEstudiante->nota_periodo_uno = 0;
                $notaFinalEstudiante->nota_periodo_dos = 0;
            }
            $suma = floatval(isset($notaFinalEstudiante->nota_periodo_uno) ? $notaFinalEstudiante->nota_periodo_uno : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_dos) ? $notaFinalEstudiante->nota_periodo_dos : 0) +
                    floatval(isset($notaFinalEstudiante->nota_periodo_tres) ? $notaFinalEstudiante->nota_periodo_tres : 0);
            
            $notaFinal =  $suma / $anios->cant_periodos;
            $notaFinalEstudiante->nota_final =  round($notaFinal,2);
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
            
            $notaFinal =  $suma / $anios->cant_periodos;
            $notaFinalEstudiante->nota_final =  round($notaFinal,2);
        }

        

        if($evaluacion->save()){
            $notaFinalEstudiante->save();
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","La evaluacion fue alamcenada exitosamente");
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
        }else{
            $notas = [];
            $notaFinal = 0;
            $desempenio = 'Bajo';
        }
        return response()->json([ 'notas' => $notas,'nota_final' =>$notaFinal, 'desempenio' => $desempenio,'conceptos' =>$evaluacion->conceptos ],200); 

    }

    public function consultar_evaluacion_transicion($idPeriodo=null, $id_estudiante=null,$idClase = null){
        
        $estudiante = EstudiantesCurso::find($id_estudiante);
        $claseDocente =  ConfClasesDocente::find($idClase);
        $evaluacion = EvaluacionTransicion::where("id_estudiante",$estudiante->id_estudiante)->where("id_periodo",$idPeriodo)
                                                ->where("id_materia",$claseDocente->id_materia)->first();
        
        if($evaluacion != null){
            $notas = json_decode($evaluacion->json_evaluaciones);
            $concepto = $evaluacion->conceptos;
        }else{
            $notas = [];
             $concepto = "";
        }
        return response()->json([ 'notas' => $notas, 'conceptos' =>$concepto],200);

    }

    public function crear_evaluacion_transicion(Request $request){

        $estudiante = EstudiantesCurso::find($request->input('id_estudiante_curso'));
        $anios = ConfAnios::find($estudiante->id_anio);
        $claseDocente =  ConfClasesDocente::find($request->input('id_clase'));
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
        $evaluacion = EvaluacionTransicion::where("id_estudiante",$estudiante->id_estudiante)->where("id_periodo",$periodo->id)
                                            ->where("id_materia",$claseDocente->id_materia)->first();
        if($evaluacion == null){
            $evaluacion = new EvaluacionTransicion();
            
            $evaluacion->id_estudiante_curso = $estudiante->id;
            $evaluacion->id_anio = $estudiante->id_anio;
            $evaluacion->des_anio = $estudiante->desc_anio;
            $evaluacion->id_estudiante = $estudiante->id_estudiante;
            $evaluacion->nom_estudiante = $estudiante->nombre_estudiante;
            $evaluacion->id_materia =  $claseDocente->id_materia;
            $evaluacion->nom_materia =  $claseDocente->nom_materia;
            $evaluacion->id_periodo = $periodo->id;
            $evaluacion->nom_perido = $periodo->nombre;

            foreach ($evaluaciones as $dataNota) {
                $actividad = ItemEvaluarTransicion::find($dataNota["id_criterio"]);
                $newarraynotas = array(
                    "id" => $actividad->id,
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
                    "nombre" => $actividad->descripcion,
                    "nota" => $dataNota["evaluacion"]
                );
                array_push($notasArray, $newarraynotas);
            }
        }
        $evaluacion->sum_nota = round($notaFinal,2);
        if ( $evaluacion->sum_nota >= 2.5) {
            $evaluacion->desempenio = 'Logro alcanzado';
        } elseif ( $evaluacion->sum_nota >= 1.5) {
            $evaluacion->desempenio = 'En proceso';
        } else {
            $evaluacion->desempenio = 'Se requiere apoyo';
        }
        $evaluacion->json_evaluaciones = json_encode($notasArray);
        $evaluacion->estado = 'A';
        $evaluacion->conceptos = $request->input('conceptos')?$request->input('conceptos'):"";

        $notaFinalEstudiante = NotaFinalEstudiante::where("id_anio",$estudiante->id_anio)->where("id_estudiante",$estudiante->id_estudiante)
                                                    ->where("id_grado",$estudiante->id_curso)->where("id_materia",$claseDocente->id_materia)
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
        }
        if($evaluacion->save()){
            $notaFinalEstudiante->save();
            return view("evaluacion.mensajes.msj_confirmacion")->with("msj","La evaluacion fue alamcenada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }


    }

    

}

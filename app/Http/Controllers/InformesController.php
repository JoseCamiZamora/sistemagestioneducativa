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
use App\ConfClasesDocente;
use App\TipoCursos;
use App\ConfDirectorGrupo;
use App\PeriodosClases;
use App\EstudiantesCurso;
use App\NotaFinalEstudiante;
use App\EvaluacionComportamiento;
use App\EvaluacionTransicion;
use App\NotaFinalTransicion;
use App\ObservacionEstudiante;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

use setasign\Fpdi\Fpdi;
use Exception;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class InformesController extends Controller
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

    public function index_reportes() {
        
        $usuarioactual=Auth::user();
     
        return view('informes.index_reportes')->with('usuario_actual', $usuarioactual);

    }

    public function form_generar_reporte_notas() {
        
        $usuarioactual=Auth::user();
        $grados = Grados::all();
        $anios = ConfAnios::all();
        $periodos = PeriodosClases::all();
        $estidiantes = EstudiantesCurso::all();
        
     
        return view('informes.form_generar_reporte_notas')->with('usuario_actual', $usuarioactual)
                                                        ->with('grados', $grados)
                                                        ->with('anios', $anios)
                                                        ->with('periodos', $periodos)
                                                        ->with('estidiantes', $estidiantes);

    }

    public function pdf_infomre_periodo($idCurso=null,$idAnio=null,$idPeriodo=null){

        ini_set('memory_limit', '712M');
        $evaluaciones = NotaFinalEstudiante::where("id_anio",$idAnio)->where("id_grado",$idCurso)->get();
        $evaluacionComportamiento = EvaluacionComportamiento::where('id_anio', $idAnio)->where('id_grado',$idCurso)->get();
        $docente =  ConfDirectorGrupo::where("id_anio",$idAnio)->where("id_curso",$idCurso)->first();
        $lstMaterias = Materias::where("tipo_curso", "=", '3')->get();
        $grado = Grados::find($idCurso);
        $periodoClases = PeriodosClases::find($idPeriodo);
        $anio = ConfAnios::find($idAnio);
        $observacionesFinales = ObservacionEstudiante::all();
        

        $reporte = [];
        foreach ($evaluaciones as $item) {
            $idEstudiante = $item['id_estudiante'];
            $idMateria = $item['id_materia'];

            $comportamiento = array_values(array_filter($evaluacionComportamiento->toArray(), function($itemComp) use ($idEstudiante) {
                return $itemComp['id_estudiante'] == $idEstudiante;
            }));

            // Determinar el dato del comportamiento por periodo (si existe)
            $periodosComp = [];
            if (!empty($comportamiento)) {
                if ($idPeriodo == 1) {

                    if ( $item['nota_periodo_uno'] >= 4.6) {
                        $desempenio1 = 'Superior';
                    } elseif ( $item['nota_periodo_uno'] >= 4.0) {
                        $desempenio1 = 'Alto';
                    } elseif ( $item['nota_periodo_uno'] >= 3.0) {
                        $desempenio1 = 'Básico';
                    } else {
                        $desempenio1 = 'Bajo';
                    }

                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_uno'],
                        'concepto' => $comportamiento[0]['concepto_per1'],
                        'desempenio' => $desempenio1
                    ];
                } elseif ($idPeriodo == 2) {
                    if ( $item['nota_periodo_dos'] >= 4.6) {
                        $desempenio2 = 'Superior';
                    } elseif ( $item['nota_periodo_dos'] >= 4.0) {
                        $desempenio2 = 'Alto';
                    } elseif ( $item['nota_periodo_dos'] >= 3.0) {
                        $desempenio2 = 'Básico';
                    } else {
                        $desempenio2 = 'Bajo';
                    }
                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_dos'],
                        'concepto' => $comportamiento[0]['concepto_per2'],
                        'desempenio' => $desempenio2
                    ];
                } else {
                    
                    if ( $item['nota_periodo_tres'] >= 4.6) {
                        $desempenio3 = 'Superior';
                    } elseif ( $item['nota_periodo_tres'] >= 4.0) {
                        $desempenio3 = 'Alto';
                    } elseif ( $item['nota_periodo_tres'] >= 3.0) {
                        $desempenio3 = 'Básico';
                    } else {
                        $desempenio3 = 'Bajo';
                    }

                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_tres'],
                        'concepto' => $comportamiento[0]['concepto_per3'],
                        'desempenio' => $desempenio3
                    ];
                }
            }

            $anioFiltro = $anio->id;
            $cursoFiltro = $grado->id;
            $periodoFiltro = $periodoClases->id;

            $filtradosObs = array_values(array_filter($observacionesFinales->toArray(), function($item) use ($idEstudiante, $anioFiltro, $cursoFiltro, $periodoFiltro) {
                return $item['id_estudiante'] == $idEstudiante &&
                       $item['id_anio'] == $anioFiltro &&
                       $item['id_curso'] == $cursoFiltro &&
                       $item['id_periodo'] == $periodoFiltro;
            }));

           
            $observacionFinal = "";
            if(!empty($filtradosObs)){
                if ($idPeriodo == 1) {
                    $observacionFinal = $filtradosObs[0]['obs_per1']?? '';
                } elseif ($idPeriodo == 2) {
                   $observacionFinal = $filtradosObs[0]['obs_per2'] ?? '';
                } else {
                   $observacionFinal = $filtradosObs[0]['obs_per3'] ?? '';
                }
            }

            // ✅ Inicializar el estudiante si aún no está
            if (!isset($reporte[$idEstudiante])) {
                $reporte[$idEstudiante] = [
                    'data_estudiante' => [
                        'id_estudiante'  => $item['id_estudiante'],
                        'nom_estudiante' => $item['nom_estudiante'],
                        'anio'           => $item['des_anio'],
                        'observacion'    => $observacionFinal ?? "",
                    ],
                    'data_comportamiento' => !empty($periodosComp) ? [
                        'id_materia'        => null,
                        'nom_materia'       => 'COMPORTAMIENTO',
                        'periodo'           => $idPeriodo,
                        'nota'              => $periodosComp['nota'],
                        'concepto'          => $periodosComp['concepto'],
                        'desempenio'        => $periodosComp['desempenio'],
                        'id_docente'        => null,
                        'nom_docente'       => null,
                        'intensidad_horas'  => null
                    ] : null,
                    'data_materia' => []
                ];
            }

            $intensidadHoras = array_values(array_filter($lstMaterias->toArray(), function($item) use ($idMateria) {
                return $item['id'] == $idMateria;
            }));

            // Determinar el periodo y sus datos
            if($idPeriodo == 1){
                if ( $item['nota_periodo_uno'] >= 4.6) {
                    $desempenio1 = 'Superior';
                } elseif ( $item['nota_periodo_uno'] >= 4.0) {
                    $desempenio1 = 'Alto';
                } elseif ( $item['nota_periodo_uno'] >= 3.0) {
                    $desempenio1 = 'Básico';
                } else {
                    $desempenio1 = 'Bajo';
                }

                $periodos = [
                    1 => ['nota' => $item['nota_periodo_uno'], 'concepto' => $item['concepto_per1'], 'desempenio' => $desempenio1,
                          'horas_justificadas' =>$item['faltas_just_per1'], 'horas_no_justificadas' =>$item['faltas_no_just_per1']]
                ];

            }elseif($idPeriodo == 2){
                if ( $item['nota_periodo_dos'] >= 4.6) {
                    $desempenio2 = 'Superior';
                } elseif ( $item['nota_periodo_dos'] >= 4.0) {
                    $desempenio2 = 'Alto';
                } elseif ( $item['nota_periodo_dos'] >= 3.0) {
                    $desempenio2 = 'Básico';
                } else {
                    $desempenio2 = 'Bajo';
                }

                $periodos = [
                   2 => ['nota' => $item['nota_periodo_dos'], 'concepto' => $item['concepto_per2'],'desempenio' => $desempenio2,
                   'horas_justificadas' =>$item['faltas_just_per2'], 'horas_no_justificadas' =>$item['faltas_no_just_per2'] ]
                ];

            }else{

                if ( $item['nota_periodo_tres'] >= 4.6) {
                    $desempenio3 = 'Superior';
                } elseif ( $item['nota_periodo_tres'] >= 4.0) {
                    $desempenio3 = 'Alto';
                } elseif ( $item['nota_periodo_tres'] >= 3.0) {
                    $desempenio3 = 'Básico';
                } else {
                    $desempenio3 = 'Bajo';
                }

                $periodos = [
                    3 => ['nota' => $item['nota_periodo_tres'], 'concepto' => $item['concepto_per3'],'desempenio' => $desempenio3,
                    'horas_justificadas' =>$item['faltas_just_per3'], 'horas_no_justificadas' =>$item['faltas_no_just_per3']]
                ];
            }
            
            foreach ($periodos as $periodo => $datos) {
                // Solo agregamos si hay nota registrada
                if ($datos['nota'] > 0) {
                    $reporte[$idEstudiante]['data_materia'][] = [
                        'id_materia'   => $item['id_materia'],
                        'nom_materia'  => $item['desc_materia'],
                        'periodo'      => $periodo,
                        'nota'         => $datos['nota'],
                        'concepto'     => $datos['concepto'],
                        'desempenio'   => $datos['desempenio'],
                        'id_docente'   => $item['id_docente'],
                        'nom_docente'  => $item['nom_docente'],
                        'intensidad_horas' => $intensidadHoras[0]['intensidad_horas'] ?? null,
                        'horas_justificadas' => $datos['horas_justificadas'],
                        'horas_no_justificadas' => $datos['horas_no_justificadas']
                    ];
                }
            }
        }

        // Reindexar por si lo necesitas como array plano:
        $reporte = array_values($reporte);
        //dd($reporte);

        setlocale(LC_TIME, 'es_ES.UTF-8'); // Asegura idioma español (Linux/Mac)
        Carbon::setLocale('es'); // Para métodos de Carbon

        $fecha = Carbon::now();
        // Mes (ej: junio)
        $mes = $fecha->translatedFormat('F');
        $diaNumero = $fecha->day;

        $fechaReporte = strtoupper($mes).' '.$diaNumero;
        
      $pdf = Pdf::loadView('informes.pdf.pdf_boletin_periodo', [
            'docente'        => $docente,
            'reporte'        => $reporte,
            'grado'          => $grado,
            'periodoClases'  => $periodoClases,
            'anio'           => $anio,
            'fechaReporte'   => $fechaReporte
      ]);
        $pdf->getDomPDF()->set_option("isHtml5ParserEnabled", true);
        $pdf->getDomPDF()->set_option("isRemoteEnabled", true);

        $filename = 'boletin_periodo_' . time() . '.pdf';
        $path = public_path('pdf/' . $filename);

        // 💾 Guardar el archivo
        $pdf->save($path);

        // 📤 Retornar la URL del archivo para abrirlo o descargarlo
        return response()->json(['url' => asset('pdf/' . $filename)]);
    }

    public function pdf_infomre_periodo_transicion($idCurso=null,$idAnio=null,$idPeriodo=null){

        ini_set('memory_limit', '812M');
        $evaluaciones = EvaluacionTransicion::where("id_anio",$idAnio)->where("id_periodo",$idPeriodo)->get();
        $notaFinalEstudiante = NotaFinalTransicion::where("id_anio",$idAnio)->where("id_grado",$idCurso)->get();
        $evaluacionComportamiento = EvaluacionComportamiento::where('id_anio', $idAnio)->where('id_grado',$idCurso)->get();
        $docente =  ConfDirectorGrupo::where("id_anio",$idAnio)->where("id_curso",$idCurso)->first();
        $grado = Grados::find($idCurso);
        $periodoClases = PeriodosClases::find($idPeriodo);
        $anio = ConfAnios::find($idAnio);

        $reporte = [];
        foreach ($evaluaciones as $item) {
            $idEstudiante = $item['id_estudiante'];

             $comportamiento = array_values(array_filter($evaluacionComportamiento->toArray(), function($itemComp) use ($idEstudiante) {
                return $itemComp['id_estudiante'] == $idEstudiante;
            }));

             $periodosComp = [];
            if (!empty($comportamiento)) {
                if ($idPeriodo == 1) {

                    if ( $item['nota_periodo_uno'] = 3) {
                        $desempenio1 = 'Alto';
                    } elseif ( $item['nota_periodo_uno'] == 2) {
                        $desempenio1 = 'Medio';
                    } else {
                        $desempenio1 = 'Bajo';
                    }

                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_uno'],
                        'concepto' => $comportamiento[0]['concepto_per1'],
                        'desempenio' => $desempenio1
                    ];
                } elseif ($idPeriodo == 2) {
                    
                    if ( $item['nota_periodo_dos'] = 3) {
                        $desempenio2 = 'Alto';
                    } elseif ( $item['nota_periodo_dos'] == 2) {
                        $desempenio2 = 'Medio';
                    } else {
                        $desempenio2 = 'Bajo';
                    }
                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_dos'],
                        'concepto' => $comportamiento[0]['concepto_per2'],
                        'desempenio' => $desempenio2
                    ];
                } else {

                    if ( $item['nota_periodo_tres'] = 3) {
                        $desempenio3 = 'Alto';
                    } elseif ( $item['nota_periodo_tres'] == 2) {
                        $desempenio3 = 'Medio';
                    } else {
                        $desempenio3 = 'Bajo';
                    }

                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_tres'],
                        'concepto' => $comportamiento[0]['concepto_per3'],
                        'desempenio' => $desempenio3
                    ];
                }
            }
            
            $notaFinal = array_values(array_filter($notaFinalEstudiante->toArray(), function($itemComp) use ($idEstudiante) {
                return $itemComp['id_estudiante'] == $idEstudiante;
            }));
            $constLogroAlcanzado = "LOGRO ALCANZADO";
            $constLogroPorceso = "LOGRO EN PROCESO";
            $conceptoFinal = "";
            $desempenioFinal = "";
            if(!empty($notaFinal)){
                if ($idPeriodo == 1) {
                    $desempenioFinal = $notaFinal[0]['concepto_per1'];
                    if(intval($notaFinal[0]['nota_periodo_uno']) >= 1.5){
                        $conceptoFinal = $constLogroAlcanzado;
                    }else{
                        $conceptoFinal = $constLogroPorceso;
                    }
                } elseif ($idPeriodo == 2) {
                   $desempenioFinal = $notaFinal[0]['concepto_per2'];
                    if(intval($notaFinal[0]['nota_periodo_uno']) >= 1.5){
                        $conceptoFinal = $constLogroAlcanzado;
                    }else{
                        $conceptoFinal = $constLogroPorceso;
                    }

                } else {
                   $desempenioFinal = $notaFinal[0]['concepto_per3'];
                    if(intval($notaFinal[0]['nota_periodo_uno']) >= 1.5){
                        $conceptoFinal = $constLogroAlcanzado;
                    }else{
                        $conceptoFinal = $constLogroPorceso;
                    }
                }
            }

            // ✅ Inicializar el estudiante si aún no está
            if (!isset($reporte[$idEstudiante])) {
                $reporte[$idEstudiante] = [
                    'data_estudiante' => [
                        'id_estudiante'  => $item['id_estudiante'],
                        'nom_estudiante' => $item['nom_estudiante'],
                        'anio'           => $item['des_anio'],
                        'concepto_final' => $conceptoFinal,
                        'desempenio_final' => $desempenioFinal
                    ],
                    'data_comportamiento' => !empty($periodosComp) ? [
                        'nom_materia'       => 'COMPORTAMIENTO',
                        'periodo'           => $idPeriodo,
                        'nota'              => $periodosComp['nota'],
                        'concepto'          => $periodosComp['concepto'],
                        'desempenio'        => $periodosComp['desempenio'],
                    ] : null,
                    'data_materia' => []
                ];
            }

            if ($item->json_evaluaciones != null) {
                $evaluacionesTransicion = json_decode($item->json_evaluaciones, true);
                
                $agrupado = [];

                foreach ($evaluacionesTransicion as $itemEva) {
                    $dim = $itemEva['dimencion'];

                    if (!isset($agrupado[$dim])) {
                        $agrupado[$dim] = [
                            'dimencion'     => $dim,
                            'id_dimencion'  => $itemEva['id_dimencion'],
                            'items'         => []
                        ];
                    }

                    $agrupado[$dim]['items'][] = [
                        'dimencion'     => $itemEva['id'],
                        'nom_dimencion'  => $itemEva['nombre'],
                        'nota' => intval($itemEva['nota'])
                    ];
                }

                // Convertir a array indexado para guardar en data_materia
                foreach ($agrupado as $dimData) {
                    $reporte[$idEstudiante]['data_materia'][] = $dimData;
                }
            }

        }
        //dd($reporte);
         // Reindexar por si lo necesitas como array plano:
        $reporte = array_values($reporte);

        setlocale(LC_TIME, 'es_ES.UTF-8'); // Asegura idioma español (Linux/Mac)
        Carbon::setLocale('es'); // Para métodos de Carbon

        $fecha = Carbon::now();
        // Mes (ej: junio)
        $mes = $fecha->translatedFormat('F');
        $diaNumero = $fecha->day;

        $fechaReporte = strtoupper($mes).' '.$diaNumero;
        
      $pdf = Pdf::loadView('informes.pdf.pdf_boletin_periodo_transicion', [
            'docente'        => $docente,
            'reporte'        => $reporte,
            'grado'          => $grado,
            'periodoClases'  => $periodoClases,
            'anio'           => $anio,
            'fechaReporte'   => $fechaReporte
      ]);
        $pdf->getDomPDF()->set_option("isHtml5ParserEnabled", true);
        $pdf->getDomPDF()->set_option("isRemoteEnabled", true);

        $filename = 'boletin_periodo_' . time() . '.pdf';
        $path = public_path('pdf/' . $filename);

        // 💾 Guardar el archivo
        $pdf->save($path);

        // 📤 Retornar la URL del archivo para abrirlo o descargarlo
        return response()->json(['url' => asset('pdf/' . $filename)]);

    }

    public function pdf_informe_director_grupo($idCurso=null,$idAnio=null,$idPeriodo=null){

        ini_set('memory_limit', '712M');
        $evaluaciones = NotaFinalEstudiante::where("id_anio",$idAnio)->where("id_grado",$idCurso)->get();
        $evaluacionComportamiento = EvaluacionComportamiento::where('id_anio', $idAnio)->where('id_grado',$idCurso)->get();
        $grado = Grados::find($idCurso);
        $periodoClases = PeriodosClases::find($idPeriodo);
        $anio = ConfAnios::find($idAnio);
        $docente =  ConfDirectorGrupo::where("id_anio",$idAnio)->where("id_curso",$idCurso)->first();
        $lstMaterias = Materias::where("tipo_curso", "=", '3')->get();


        $reporte = [];
        foreach ($evaluaciones as $item) {
            $idEstudiante = $item['id_estudiante'];
            $idMateria = $item['id_materia'];

            $comportamiento = array_values(array_filter($evaluacionComportamiento->toArray(), function($itemComp) use ($idEstudiante) {
                return $itemComp['id_estudiante'] == $idEstudiante;
            }));

            // Determinar el dato del comportamiento por periodo (si existe)
            $periodosComp = [];
            if (!empty($comportamiento)) {
                if ($idPeriodo == 1) {

                    if ( $item['nota_periodo_uno'] >= 4.6) {
                        $desempenio1 = 'Superior';
                    } elseif ( $item['nota_periodo_uno'] >= 4.0) {
                        $desempenio1 = 'Alto';
                    } elseif ( $item['nota_periodo_uno'] >= 3.0) {
                        $desempenio1 = 'Básico';
                    } else {
                        $desempenio1 = 'Bajo';
                    }

                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_uno'],
                        'concepto' => $comportamiento[0]['concepto_per1'],
                        'desempenio' => $desempenio1
                    ];
                } elseif ($idPeriodo == 2) {
                    if ( $item['nota_periodo_dos'] >= 4.6) {
                        $desempenio2 = 'Superior';
                    } elseif ( $item['nota_periodo_dos'] >= 4.0) {
                        $desempenio2 = 'Alto';
                    } elseif ( $item['nota_periodo_dos'] >= 3.0) {
                        $desempenio2 = 'Básico';
                    } else {
                        $desempenio2 = 'Bajo';
                    }
                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_dos'],
                        'concepto' => $comportamiento[0]['concepto_per2'],
                        'desempenio' => $desempenio2
                    ];
                } else {
                    
                    if ( $item['nota_periodo_tres'] >= 4.6) {
                        $desempenio3 = 'Superior';
                    } elseif ( $item['nota_periodo_tres'] >= 4.0) {
                        $desempenio3 = 'Alto';
                    } elseif ( $item['nota_periodo_tres'] >= 3.0) {
                        $desempenio3 = 'Básico';
                    } else {
                        $desempenio3 = 'Bajo';
                    }

                    $periodosComp = [
                        'nota' => $comportamiento[0]['nota_periodo_tres'],
                        'concepto' => $comportamiento[0]['concepto_per3'],
                        'desempenio' => $desempenio3
                    ];
                }
            }

            // ✅ Inicializar el estudiante si aún no está
            if (!isset($reporte[$idEstudiante])) {
                $reporte[$idEstudiante] = [
                    'data_estudiante' => [
                        'id_estudiante'  => $item['id_estudiante'],
                        'nom_estudiante' => $item['nom_estudiante'],
                        'anio'           => $item['des_anio'],
                    ],
                    'data_comportamiento' => !empty($periodosComp) ? [
                        'id_materia'        => null,
                        'nom_materia'       => 'COMPORTAMIENTO',
                        'periodo'           => $idPeriodo,
                        'nota'              => $periodosComp['nota'],
                        'concepto'          => $periodosComp['concepto'],
                        'desempenio'        => $periodosComp['desempenio'],
                        'id_docente'        => null,
                        'nom_docente'       => null,
                        'intensidad_horas'  => null
                    ] : null,
                    'data_materia' => []
                ];
            }

            $intensidadHoras = array_values(array_filter($lstMaterias->toArray(), function($item) use ($idMateria) {
                return $item['id'] == $idMateria;
            }));

            // Determinar el periodo y sus datos
            if($idPeriodo == 1){
                if ( $item['nota_periodo_uno'] >= 4.6) {
                    $desempenio1 = 'Superior';
                } elseif ( $item['nota_periodo_uno'] >= 4.0) {
                    $desempenio1 = 'Alto';
                } elseif ( $item['nota_periodo_uno'] >= 3.0) {
                    $desempenio1 = 'Básico';
                } else {
                    $desempenio1 = 'Bajo';
                }

                $periodos = [
                    1 => ['nota' => $item['nota_periodo_uno'], 'concepto' => $item['concepto_per1'], 'desempenio' => $desempenio1,
                          'horas_justificadas' =>$item['faltas_just_per1'], 'horas_no_justificadas' =>$item['faltas_no_just_per1']]
                ];

            }elseif($idPeriodo == 2){
                if ( $item['nota_periodo_dos'] >= 4.6) {
                    $desempenio2 = 'Superior';
                } elseif ( $item['nota_periodo_dos'] >= 4.0) {
                    $desempenio2 = 'Alto';
                } elseif ( $item['nota_periodo_dos'] >= 3.0) {
                    $desempenio2 = 'Básico';
                } else {
                    $desempenio2 = 'Bajo';
                }

                $periodos = [
                   2 => ['nota' => $item['nota_periodo_dos'], 'concepto' => $item['concepto_per2'],'desempenio' => $desempenio2,
                   'horas_justificadas' =>$item['faltas_just_per2'], 'horas_no_justificadas' =>$item['faltas_no_just_per2'] ]
                ];

            }else{

                if ( $item['nota_periodo_tres'] >= 4.6) {
                    $desempenio3 = 'Superior';
                } elseif ( $item['nota_periodo_tres'] >= 4.0) {
                    $desempenio3 = 'Alto';
                } elseif ( $item['nota_periodo_tres'] >= 3.0) {
                    $desempenio3 = 'Básico';
                } else {
                    $desempenio3 = 'Bajo';
                }

                $periodos = [
                    3 => ['nota' => $item['nota_periodo_tres'], 'concepto' => $item['concepto_per3'],'desempenio' => $desempenio3,
                    'horas_justificadas' =>$item['faltas_just_per3'], 'horas_no_justificadas' =>$item['faltas_no_just_per3']]
                ];
            }
            
            foreach ($periodos as $periodo => $datos) {
                // Solo agregamos si hay nota registrada
                if ($datos['nota'] > 0) {
                    $reporte[$idEstudiante]['data_materia'][] = [
                        'id_materia'   => $item['id_materia'],
                        'nom_materia'  => $item['desc_materia'],
                        'periodo'      => $periodo,
                        'nota'         => $datos['nota'],
                        'concepto'     => $datos['concepto'],
                        'desempenio'   => $datos['desempenio'],
                        'id_docente'   => $item['id_docente'],
                        'nom_docente'  => $item['nom_docente'],
                        'intensidad_horas' => $intensidadHoras[0]['intensidad_horas'] ?? null,
                        'horas_justificadas' => $datos['horas_justificadas'],
                        'horas_no_justificadas' => $datos['horas_no_justificadas']
                    ];
                }
            }
        }

        // Reindexar por si lo necesitas como array plano:
        $reporte = array_values($reporte);
        //dd($reporte);

        setlocale(LC_TIME, 'es_ES.UTF-8'); // Asegura idioma español (Linux/Mac)
        Carbon::setLocale('es'); // Para métodos de Carbon

        $fecha = Carbon::now();
        // Mes (ej: junio)
        $mes = $fecha->translatedFormat('F');
        $diaNumero = $fecha->day;

        $fechaReporte = strtoupper($mes).' '.$diaNumero;
        
      $pdf = Pdf::loadView('informes.pdf.pdf_boletin_periodo', [
            'docente'        => $docente,
            'reporte'        => $reporte,
            'grado'          => $grado,
            'periodoClases'  => $periodoClases,
            'anio'           => $anio,
            'fechaReporte'   => $fechaReporte
      ]);
        $pdf->getDomPDF()->set_option("isHtml5ParserEnabled", true);
        $pdf->getDomPDF()->set_option("isRemoteEnabled", true);

        $filename = 'boletin_periodo_' . time() . '.pdf';
        $path = public_path('pdf/' . $filename);

        // 💾 Guardar el archivo
        $pdf->save($path);

        // 📤 Retornar la URL del archivo para abrirlo o descargarlo
        return response()->json(['url' => asset('pdf/' . $filename)]);
    }

    
}


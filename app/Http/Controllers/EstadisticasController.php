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

use App\Exports\Informe1Export;
use App\Exports\Informe2Export;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class EstadisticasController extends Controller
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

    public function index_estadisticas() {
        
        $usuarioactual=Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);
        $docenteDirector =  ConfDirectorGrupo::all();
        $grados = Grados::all();
        $anios = ConfAnios::all();
        $periodos = PeriodosClases::all();
     
        return view('estadisticas.index_estadisticas')->with('usuario_actual', $usuarioactual)
                                                        ->with('docente', $docente)
                                                        ->with('docenteDirector', $docenteDirector)
                                                        ->with('grados', $grados)
                                                        ->with('anios', $anios)
                                                        ->with('periodos', $periodos);

    }

    public function reporte_estudiantes_excel_materias($anio=null,$curso=null,$periodo=null){

    $fileName = 'Ranking_estudiantes.xlsx';
    $filePath = storage_path('app/public/' . $fileName);

    // Guardar archivo temporalmente
    if($periodo == 'F'){
        Excel::store(new Informe2Export($anio, $curso, $periodo), 'public/' . $fileName);
    }else{
        Excel::store(new Informe1Export($anio, $curso, $periodo), 'public/' . $fileName);
    }
   

    // Leer y codificar en base64
    $fileContent = file_get_contents($filePath);
    $base64 = base64_encode($fileContent);

    // Eliminar el archivo
    Storage::delete('public/' . $fileName);

    // Retornar en JSON
    return response()->json([
        'file' => $base64,
        'filename' => $fileName,
    ]);
        
    }

    
}


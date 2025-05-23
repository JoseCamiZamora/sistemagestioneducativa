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


use PDF;
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
class DocentesController extends Controller
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


    public function listado_docentes() {
        $usuarioactual = Auth::user();
        $lstDocentes = Docentes::where("estado", "=", 'A')->paginate(50);
        return view("docentes.listado_docentes")->with("lstDocentes", $lstDocentes)
        ->with("usuarioactual", $usuarioactual);
    }

    public function form_nuevo_docente(){
        $usuario_actual=Auth::user();
        $tiposDocumentos = TiposDocumentos::all();
        $materias = Materias::all();
        $grados = Grados::all();

        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        return view("docentes.form_nuevo_docente")
               ->with("tiposDocumentos",$tiposDocumentos)
               ->with("materias",$materias)
               ->with("grados",$grados)
               ->with("usuario_actual",$usuario_actual);
    }

    public function crear_docente(Request $request){
        
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $docente = new Docentes();
        
        $tipoDoc = $request->input('tipoDocumento');
        $tipoDocumento = TiposDocumentos::find($tipoDoc);   
        $docente->id_tipo_documento=$tipoDocumento->id;
        $docente->tipo_documento= $tipoDocumento->descripcion;
        $docente->nro_documento=$request->input('identificacion')?$request->input('identificacion'):'';
        $docente->nombres=$request->input('nombres')?$request->input('nombres'):'';
        $docente->apellidos=$request->input('apellidos')?$request->input('apellidos'):'';
        $docente->nom_completo=$docente->nombres.' '.$docente->apellidos;
        $docente->direccion=$request->input('direccion')?$request->input('direccion'):'';
        $docente->telefono=$request->input('telefono')?$request->input('telefono'):'';
        $docente->correo=$request->input('email')?$request->input('email'):'';
        $docente->estado="A";
        $docente->json_materias = null;
        $docente->materias = "";
        $docente->grados = "";
        $docente->json_grados= null;

        

        if($docente->save()){

            $usuario=new User;
            $usuario->id_persona = $docente->id;
            $usuario->nombres=strtoupper($docente->nom_completo) ;
            $usuario->telefono= $docente->telefono;
            $usuario->identificacion=$docente->nro_documento;
            $usuario->tipo=1;
            $usuario->rol=2;
            $usuario->email=$docente->correo;
            $usuario->password= Hash::make($docente->nro_documento);
            $usuario->estado=1;
            $usuario->save();

            return view("docentes.mensajes.msj_creado_docente")->with("msj","Docente creado exitosamente")
            										   ->with("estado",$docente->estado);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    

    public function frm_editar_docente($id_docente= null){

        $docente=Docentes::find($id_docente);
        $tiposDocumentos = TiposDocumentos::all();
        $materias = Materias::all();
        $grados = Grados::all();

        $materasJson = json_decode($docente->json_materias);
        $gradosJson = json_decode($docente->json_grados);
       
        $usuario_actual=Auth::user();
        return view('docentes.form_editar_docente')->with('docente',$docente)
        ->with("usuario_actual",$usuario_actual)
        ->with("tiposDocumentos",$tiposDocumentos)
        ->with("materasJson",$materasJson)
        ->with("gradosJson",$gradosJson)
        ->with("materias",$materias)
        ->with("grados",$grados);

    }

    public function frm_clases_docente($id_docente= null){

        $docente=Docentes::find($id_docente);
        $materias = Materias::all();
        $grados = Grados::all();
        $anios = ConfAnios::all();
        $clases = ConfClasesDocente::all();
        $lstClasificaciones = TipoCursos::all();
       
        $usuario_actual=Auth::user();
        return view('docentes.form_clases_docente')->with('docente',$docente)
        ->with("usuario_actual",$usuario_actual)
        ->with("materias",$materias)
        ->with("anios",$anios)
        ->with("grados",$grados)
        ->with("lstClasificaciones",$lstClasificaciones)
        ->with("clases",$clases);

    }

    

    public function editar_docente(Request $request){
        
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $id_docente = $request->input('id_docente');
        $docente = Docentes::find($id_docente);
        
        $tipoDoc = $request->input('tipoDocumento');
        $tipoDocumento = TiposDocumentos::find($tipoDoc);  
        
        $docente->id_tipo_documento=$tipoDocumento->id;
        $docente->tipo_documento= $tipoDocumento->descripcion;
        $docente->nro_documento=$request->input('identificacion')?$request->input('identificacion'):'';
        $docente->nombres=$request->input('nombres')?$request->input('nombres'):'';
        $docente->apellidos=$request->input('apellidos')?$request->input('apellidos'):'';
        $docente->nom_completo=$docente->nombres.' '.$docente->apellidos;
        $docente->direccion=$request->input('direccion')?$request->input('direccion'):'';
        $docente->telefono=$request->input('telefono')?$request->input('telefono'):'';
        $docente->correo=$request->input('email')?$request->input('email'):'';
        $docente->estado="A";
        $docente->json_materias = null;
        $docente->json_grados = null;
        $docente->materias = "";
        $docente->grados = "";
       
        if($docente->save()){
            $usuario= User::where("id_persona",$docente->id)->first();
            if($usuario != null){
                $usuario->email=$docente->correo;
                $usuario->password= Hash::make($docente->nro_documento);
            }else{
                $usuario=new User;
                $usuario->id_persona = $docente->id;
                $usuario->nombres=strtoupper($docente->nom_completo) ;
                $usuario->telefono= $docente->telefono;
                $usuario->identificacion=$docente->nro_documento;
                $usuario->tipo=1;
                $usuario->rol=2;
                $usuario->email=$docente->correo;
                $usuario->password= Hash::make($docente->nro_documento);
                $usuario->estado=1;
            }
           
            $usuario->save();
            return view("docentes.mensajes.msj_actualziado_edit")->with("msj","Docente Actulizado exitosamente")
            										   ->with("estado",$docente->estado);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function buscar_estudiantes(Request $request){

        $usuario_actual=Auth::user();
        $dato=$request->input("dato_buscado");
        $lstEstudiantes=Estudiantes::where("identificacion","like","%".$dato."%")
                  ->orWhere("primer_nombre","like","%".$dato."%")
                  ->orWhere("segundo_nombre","like","%".$dato."%")
                  ->orWhere("primer_apellido","like","%".$dato."%")
                  ->orWhere("segundo_apellido","like","%".$dato."%")
                  ->paginate(100)
                  ->appends(request()->query());
        return view('estudiantes.listado_estudiantes')->with("usuario_actual",$usuario_actual)
                                                ->with("busqueda",true)
                                                ->with("lstEstudiantes", $lstEstudiantes);
    }

    public function adicionar_clases_docente(Request $request){
        
        $asignaciones = $request->input('asignaciones');
        $id_anio = $request->input('anio_escolar');
        $idDocente = $request->input('id_docente');
        $docente = Docentes::find($idDocente);
        $clasesDocente =  ConfClasesDocente::where("id_docente",$idDocente)->where("id_anio", $id_anio)->get();
       
        $cantidad = count($clasesDocente);
        
        if($cantidad > 0){
            $materiasRegistradas = [];

            foreach ($clasesDocente as $class) {
                $materiasRegistradas[] = $class->id_materia;
            }
            // Filtra asignaciones que no están ya registradas
            $asignaciones = array_filter($asignaciones, function($asignacion) use ($materiasRegistradas) {
                return !in_array($asignacion['materia'], $materiasRegistradas);
            });
            // Reindexar si lo necesitas
            $asignaciones = array_values($asignaciones);
           
            foreach ($asignaciones as $asignacion) {
                $clasesDocente = new ConfClasesDocente();
                $clasesDocente->id_docente = $docente->id;
                $clasesDocente->nombre_docente = $docente->nom_completo;
                $idClasificacion = $request->input('tipo_grado')?$request->input('tipo_grado'):'';
                $clasificacion = TipoCursos::find($idClasificacion);
                $clasesDocente->id_tipo_clase = $clasificacion->id;
                $clasesDocente->tipo_clase = $clasificacion->nombre;

                $anio = new ConfAnios();
                $anio = ConfAnios::find($asignacion['anio']);
                $clasesDocente->id_anio =  $anio->id;
                $clasesDocente->nom_anio =  $anio->anio_inicio.'-'.$anio->anio_fin;
                $clasesDocente->cant_periodos = $anio->cant_periodos;
                $materia = Materias::find($asignacion['materia']);  
                $clasesDocente->id_materia = $materia->id;
                $clasesDocente->nom_materia = $materia->nombre;
                $cursos  = $asignacion['cursos'];

                $cursosArray = array();
                foreach ($cursos as $cursoId) {
                    $grado = Grados::find($cursoId);
                    $newarrayaCurso = array(
                        "id" => $grado->id,
                        "nombre" => $grado->nombre
                    );
                    array_push($cursosArray, $newarrayaCurso);
                }
                $clasesDocente->json_cursos= json_encode($cursosArray);
                $clasesDocente->save();
            }
        }else{
            
            foreach ($asignaciones as $asignacion) {
                
                $clasesDocente = new ConfClasesDocente();
                $clasesDocente->id_docente = $docente->id;
                $clasesDocente->nombre_docente = $docente->nom_completo;
                $idClasificacion = $request->input('tipo_grado')?$request->input('tipo_grado'):'';
                $clasificacion = TipoCursos::find($idClasificacion);
                $clasesDocente->id_tipo_clase = $clasificacion->id;
                $clasesDocente->tipo_clase = $clasificacion->nombre;

                $anio = new ConfAnios();
                $anio = ConfAnios::find($asignacion['anio']);
                $clasesDocente->id_anio =  $anio->id;
                $clasesDocente->nom_anio =  $anio->anio_inicio.'-'.$anio->anio_fin;
                $clasesDocente->cant_periodos = $anio->cant_periodos;
                $materia = Materias::find($asignacion['materia']);  
                $clasesDocente->id_materia = $materia->id;
                $clasesDocente->nom_materia = $materia->nombre;
                $cursos  = $asignacion['cursos'];

                $cursosArray = array();
                foreach ($cursos as $cursoId) {
                    $grado = Grados::find($cursoId);
                    $newarrayaCurso = array(
                        "id" => $grado->id,
                        "nombre" => $grado->nombre
                    );
                    array_push($cursosArray, $newarrayaCurso);
                }
                $clasesDocente->json_cursos= json_encode($cursosArray);
                $clasesDocente->save();
            }
        }

        
        
        
        return view("docentes.mensajes.msj_clase_creada")->with("msj","La clase fue configurada exitosamente")
        ->with("estado",$docente->estado);
    }

    public function  borrar_clase_docente($idClase=null) {
        $clasesDocente =  ConfClasesDocente::find($idClase);
        $clasesDocente->delete();
        return response()->json([ 'estado' => 'borrada' ],200);  
    }


    

    

    
}

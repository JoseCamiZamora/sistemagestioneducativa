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
use App\ConfDirectorGrupo;
use App\ConceptosEvaluacion;
use App\ConceptosComportamiento;
use App\ConceptosEvaluacionTransicion;
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
class ConfiguracionController extends Controller
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

    public function index_configuracion() {
        
        $usuarioactual=Auth::user();
     
        return view('configuracion.index_configuracion')->with('usuario_actual', $usuarioactual);

    }

    public function index_conceptos() {
        
        $usuarioactual=Auth::user();
        $docenteCurso =  ConfDirectorGrupo::where("id_docente",$usuarioactual->id_persona)->first();
        if($docenteCurso->nom_curso == 'SIN CURSO'){
            $docenteCurso->id_curso = 0;
        }
        dd($docenteCurso);
        return view('configuracion.index_conceptos')->with('usuario_actual', $usuarioactual)->with('docenteCurso', $docenteCurso);

    }

    public function listado_docentes() {
        $usuarioactual = Auth::user();
        $lstDocentes = Docentes::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_docentes")->with("lstDocentes", $lstDocentes)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_estudiantes() {
        $usuarioactual = Auth::user();
        $lstEstudiantes = Estudiantes::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_estudiantes")->with("lstEstudiantes", $lstEstudiantes)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_materias() {
        $usuarioactual = Auth::user();
        $lstMaterias = Materias::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_materias")->with("lstMaterias", $lstMaterias)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_anios() {
        $usuarioactual = Auth::user();
        $lstAnios = ConfAnios::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_anios")->with("lstAnios", $lstAnios)
        ->with("usuarioactual", $usuarioactual);
    }

    public function  listado_conceptos() {
        $usuarioactual = Auth::user();
        $lstConceptos = ConceptosEvaluacion::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_conceptos")->with("lstConceptos", $lstConceptos)
        ->with("usuarioactual", $usuarioactual);
    }

    public function  listado_concepto_comportamiento() {
        $usuarioactual = Auth::user();
        $lstConceptosComp = ConceptosComportamiento::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_concepto_comportamiento")->with("lstConceptosComp", $lstConceptosComp)
        ->with("usuarioactual", $usuarioactual);
    }

    public function  listado_conceptos_trans() {
        $usuarioactual = Auth::user();
        $lstConceptos = ConceptosEvaluacionTransicion::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_conceptos_trans")->with("lstConceptos", $lstConceptos)
        ->with("usuarioactual", $usuarioactual);
    }

    public function  listado_dimensiones() {
        $usuarioactual = Auth::user();
        $lstDimensiones = ItemEvaluarTransicion::where("estado", "=", 'A')->paginate(20);
        return view("configuracion.listado_dimensiones")->with("lstDimensiones", $lstDimensiones)
        ->with("usuarioactual", $usuarioactual);
    }

    public function frm_asociar_curso($idEstudiante= null){

        $estudiante = Estudiantes::find($idEstudiante);
        $grados = Grados::all();
        $anios = ConfAnios::all();
        $historialGrados = EstudiantesCurso::where("id_estudiante",$idEstudiante)->get();
        foreach ($historialGrados as $data) {
            $registro = collect($anios)->firstWhere('id', $data->id_anio);
            $data->finalizado = $registro->finalizado;
        }
        $lstClasificaciones = TipoCursos::all();

        return view('configuracion.form_asociar_estudiante')->with('estudiante',$estudiante)
                                                        ->with("grados",$grados)
                                                        ->with("anios",$anios)
                                                        ->with("lstClasificaciones",$lstClasificaciones)
                                                        ->with("historialGrados",$historialGrados);

    }

    public function form_nuevo_anio(){
        $usuario_actual=Auth::user();
        $tiposEvaluacion = ConfEvaluaciones::all();
        $grados = Grados::all();
        $periodos = PeriodosClases::all();

        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        return view("configuracion.form_nuevo_anio")
               ->with("tiposEvaluacion",$tiposEvaluacion)
               ->with("grados",$grados)
               ->with("periodos",$periodos)
               ->with("usuario_actual",$usuario_actual);
    }

    public function crear_anio(Request $request){
        
        //crea una cuenta en el sistema
        $anio = new ConfAnios();

        $anio->anio_inicio = $request->input('anio_inicio')?$request->input('anio_inicio'):'';
        $anio->anio_fin = $request->input('anio_final')?$request->input('anio_final'):'';
        $periodos = $request->input('periodos');
        $actividades = $request->input('actividades');
        $cursos = $request->input('cursos');
        $periodosArray = array();
        foreach ($periodos as $data) {
            $periodo = PeriodosClases::find($data);
            $newarrayPeriodo = array(
                "id" => $periodo->id,
                "nombre" => $periodo->nombre
            );
            array_push($periodosArray, $newarrayPeriodo);
        }
        $anio->json_periodos= json_encode($periodosArray);
        
        $actividadArray = array();
        foreach ($actividades as $dataAct) {
            $actividad = ConfEvaluaciones::find($dataAct);
            $newarrayActividad = array(
                "id" => $actividad->id,
                "nombre" => $actividad->descripcion,
                "porcentaje" =>$actividad->porcentaje_evaluacion
            );
            array_push($actividadArray, $newarrayActividad);
        }
        $anio->json_evaluaciones= json_encode($actividadArray);

        
        $cursoArray = array();
        foreach ($cursos as $dataCurso) {
            $curso = Grados::find($dataCurso);
            $newarrayCurso = array(
                "id" => $curso->id,
                "nombre" => $curso->nombre
            );
            array_push($cursoArray, $newarrayCurso);
        }
        $anio->json_grados= json_encode($cursoArray);
        $anio->finalizado = 'NO';
        $anio->estado = 'A';
        $cantidad = count($periodos);
        $anio->cant_periodos = $cantidad;

        if($anio->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La configuracion del año fue creada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function editar_anio(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('id_anio');
        $usuario_actual=Auth::user();
        $anio = ConfAnios::find($idAnio);

        $anio->anio_inicio = $request->input('anio_inicio')?$request->input('anio_inicio'):'';
        $anio->anio_fin = $request->input('anio_final')?$request->input('anio_final'):'';
        $periodos = $request->input('periodos');
        $actividades = $request->input('actividad');
        $cursos = $request->input('cursos');

        $anio->json_evaluaciones = null;
        $anio->json_grados = null;
        $anio->json_periodos = null;

        $periodosArray = array();
        foreach ($periodos as $data) {
            $periodo = PeriodosClases::find($data);
            $newarrayPeriodo = array(
                "id" => $periodo->id,
                "nombre" => $periodo->nombre
            );
            array_push($periodosArray, $newarrayPeriodo);
        }
        $anio->json_periodos= json_encode($periodosArray);
        
        $actividadArray = array();
        foreach ($actividades as $dataAct) {
            $actividad = ConfEvaluaciones::find($dataAct);
            $newarrayActividad = array(
                "id" => $actividad->id,
                "nombre" => $actividad->descripcion,
                "porcentaje" =>$actividad->porcentaje_evaluacion
            );
            array_push($actividadArray, $newarrayActividad);
        }
        $anio->json_evaluaciones= json_encode($actividadArray);
        
        $cursoArray = array();
        foreach ($cursos as $dataCurso) {
            $curso = Grados::find($dataCurso);
            $newarrayCurso = array(
                "id" => $curso->id,
                "nombre" => $curso->nombre
            );
            array_push($cursoArray, $newarrayCurso);
        }
        $anio->json_grados= json_encode($cursoArray);
        $anio->finalizado = 'NO';
        $anio->estado = 'A';
        $cantidad = count($periodos);
        $anio->cant_periodos = $cantidad;

        if($anio->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La configuracion del año fue creada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }


    public function frm_editar_anio($idAnio= null){

        $anio = ConfAnios::find($idAnio);
        $materasJson = json_decode($anio->json_evaluaciones);
        $materiasSeleccionados = array_column($materasJson, 'id');
        $gradosJson = json_decode($anio->json_grados);
        $gradosSeleccionados = array_column($gradosJson, 'id');
        $periodosJson = json_decode($anio->json_periodos);
        $periodosSeleccionados = array_column($periodosJson, 'id');
        $tiposEvaluacion = ConfEvaluaciones::all();
        $grados = Grados::all();
        $periodos = PeriodosClases::all();
        $usuario_actual=Auth::user();

        return view('configuracion.form_editar_anio')->with('anio',$anio)
                                                        ->with("tiposEvaluacion",$tiposEvaluacion)
                                                        ->with("grados",$grados)
                                                        ->with("periodos",$periodos)
                                                        ->with('materiasSeleccionados',$materiasSeleccionados)
                                                        ->with('gradosSeleccionados',$gradosSeleccionados)
                                                        ->with('periodosJson',$periodosJson)
                                                        ->with('periodosSeleccionados',$periodosSeleccionados)
                                                        ->with("usuario_actual",$usuario_actual);

    }

    public function form_nuevo_materia(){
        $usuario_actual=Auth::user();
        $lstClasificaciones = TipoCursos::all();

        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        return view("configuracion.form_nuevo_materia")
               ->with("lstClasificaciones",$lstClasificaciones)
               ->with("usuario_actual",$usuario_actual);
    }

    public function crear_matria(Request $request){
        
        //crea una cuenta en el sistema
        $materia = new Materias();
        $idClasificacion = $request->input('tipo')?$request->input('tipo'):'';
        $clasificacion = TipoCursos::find($idClasificacion);
        
        $materia->nombre= strtoupper($request->input('materia')?$request->input('materia'):'');
        $materia->tipo_curso = $clasificacion->id;
        $materia->nom_clasificacion = $clasificacion->nombre;
        $materia->intensidad_horas = $request->input('instensidad_horas')?$request->input('instensidad_horas'):'';
        $materia->estado="A";

        if($materia->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La materia fue creada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function frm_editar_materia($idMateria= null){

        $materia = Materias::find($idMateria);
        $usuario_actual=Auth::user();
        $lstClasificaciones = TipoCursos::all();

        return view('configuracion.form_editar_materia')->with('materia',$materia)->with('lstClasificaciones',$lstClasificaciones)
        ->with("usuario_actual",$usuario_actual);

    }

    public function editar_materia(Request $request){
        
        //crea una cuenta en el sistema
        $materia = Materias::find($request->input('id_materia'));
        $idClasificacion = $request->input('tipo')?$request->input('tipo'):'';
        $clasificacion = TipoCursos::find($idClasificacion);
        
        $materia->nombre= strtoupper($request->input('materia')?$request->input('materia'):'');
        $materia->tipo_curso = $clasificacion->id;
        $materia->nom_clasificacion = $clasificacion->nombre;
        $materia->intensidad_horas = $request->input('instensidad_horas')?$request->input('instensidad_horas'):'';
        $materia->estado="A";
        if($materia->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La materia fue Actualizada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al Actualziar ;...") ;
        }
    }

    public function  borrar_materia($idMateria=null) {
        $materia = Materias::find($idMateria);
        $materia->delete();
        return response()->json([ 'estado' => 'borrada' ],200);
    }

    public function listado_actividades() {
        $usuarioactual = Auth::user();
        $lstActividades = ConfEvaluaciones::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_actividades")->with("lstActividades", $lstActividades)
        ->with("usuarioactual", $usuarioactual);
    }

    public function form_nueva_activdad(){
        $usuario_actual=Auth::user();
        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
        return view("configuracion.form_nueva_activdad")
               ->with("usuario_actual",$usuario_actual);
    }

    public function crear_actividad(Request $request){
        
        //crea una cuenta en el sistema
        $actividad = new ConfEvaluaciones();
        
        $actividad->descripcion= strtoupper($request->input('actividad')?$request->input('actividad'):'');
        $actividad->porcentaje_evaluacion= $request->input('porcentaje')?$request->input('porcentaje'):0;
        $actividad->estado="A";

        if($actividad->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La actividad fue creada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function frm_editar_actividad($idActividad= null){

        $actividad = ConfEvaluaciones::find($idActividad);
        $usuario_actual=Auth::user();

        return view('configuracion.form_editar_actividad')->with('actividad',$actividad)
        ->with("usuario_actual",$usuario_actual);
    }

    public function editar_actividad(Request $request){
        //crea una cuenta en el sistema
        $actividad = ConfEvaluaciones::find($request->input('id_actividad'));
        
        $actividad->descripcion= strtoupper($request->input('actividad')?$request->input('actividad'):'');
        $actividad->porcentaje_evaluacion= $request->input('porcentaje')?$request->input('porcentaje'):0;
        $actividad->estado="A";
        if($actividad->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La Actividad fue Actualizada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al Actualziar ;...") ;
        }
    }

    public function  borrar_actividad($idActividad=null) {
        $actividad = ConfEvaluaciones::find($idActividad);
        $actividad->delete();
        return response()->json([ 'estado' => 'borrada' ],200);  
    }

    public function listado_periodos() {
        $usuarioactual = Auth::user();
        $lstPeriodos = PeriodosClases::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_periodos")->with("lstPeriodos", $lstPeriodos)
        ->with("usuarioactual", $usuarioactual);
    }

    public function form_nuevo_periodo(){
        $usuario_actual=Auth::user();
        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
        return view("configuracion.form_nuevo_periodo")
            ->with("usuario_actual",$usuario_actual);
    }

    public function crear_periodo(Request $request){
        
        //crea una cuenta en el sistema
        $periodo = new PeriodosClases();
        
        $periodo->nombre= strtoupper($request->input('periodo')?$request->input('periodo'):'');
        $periodo->json_actividades = null;
        $periodo->estado="A";

        if($periodo->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","El periodo fue creado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }
    
    public function frm_editar_periodo($idPeriodo= null){

        $periodo = PeriodosClases::find($idPeriodo);
        $usuario_actual=Auth::user();

        return view('configuracion.form_editar_periodo')->with('periodo',$periodo)
        ->with("usuario_actual",$usuario_actual);
    }

    public function editar_periodo(Request $request){
        //crea una cuenta en el sistema
        $periodo = PeriodosClases::find($request->input('id_periodo'));
        
        $periodo->nombre= strtoupper($request->input('periodo')?$request->input('periodo'):'');
        $periodo->json_actividades = null;
        $periodo->estado="A";
        if($periodo->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","El periodo fue actualizado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al Actualziar ;...") ;
        }
    }

    public function  borrar_periodo($idPeriodo=null) {
        $periodo = PeriodosClases::find($idPeriodo);
        $periodo->delete();
        return response()->json([ 'estado' => 'borrada' ],200);  
    }

    public function listado_cursos() {
        $usuarioactual = Auth::user();
        $lstCursos = Grados::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_cursos")->with("lstCursos", $lstCursos)
        ->with("usuarioactual", $usuarioactual);
    }

    public function form_nuevo_curso(){
        $usuario_actual=Auth::user();
        $lstClasificaciones = TipoCursos::all();

        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
        return view("configuracion.form_nuevo_curso")
            ->with("lstClasificaciones",$lstClasificaciones)
            ->with("usuario_actual",$usuario_actual);
    }

    public function crear_curso(Request $request){
        
        //crea una cuenta en el sistema
        $curso = new Grados();
        $idClasificacion = $request->input('tipo')?$request->input('tipo'):'';
        $clasificacion = TipoCursos::find($idClasificacion);
        
        $curso->nombre= strtoupper($request->input('curso')?$request->input('curso'):'');
        $curso->tipo_grado = $clasificacion->id;
        $curso->nom_clasificacion = $clasificacion->nombre;
        $curso->estado="A";

        if($curso->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","El curso fue creado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function frm_editar_curso($idCurso= null){

        $curso = Grados::find($idCurso);
        $usuario_actual=Auth::user();
        $lstClasificaciones = TipoCursos::all();

        return view('configuracion.form_editar_curso')->with('curso',$curso)->with('lstClasificaciones',$lstClasificaciones)
        ->with("usuario_actual",$usuario_actual);
    }

    public function editar_curso(Request $request){
        //crea una cuenta en el sistema
        $curso = Grados::find($request->input('id_curso'));
        $idClasificacion = $request->input('tipo')?$request->input('tipo'):'';
        $clasificacion = TipoCursos::find($idClasificacion);
        
        $curso->nombre= strtoupper($request->input('curso')?$request->input('curso'):'');
        $curso->tipo_grado = $clasificacion->id;
        $curso->nom_clasificacion = $clasificacion->nombre;
        $curso->estado="A";
        if($curso->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","El curso fue actualizado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al Actualziar ;...") ;
        }
    }

    public function  borrar_curso($idCurso=null) {
        $curso = Grados::find($idCurso);
        $curso->delete();
        return response()->json([ 'estado' => 'borrada' ],200);  
    }

    public function listado_clasificacion() {
        $usuarioactual = Auth::user();
        $lstClasificacion = TipoCursos::where("estado", "=", 'A')->paginate(50);
        return view("configuracion.listado_clasificacion")->with("lstClasificacion", $lstClasificacion)
        ->with("usuarioactual", $usuarioactual);
    }

    public function form_nueva_clasificacion(){
        $usuario_actual=Auth::user();
        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
        return view("configuracion.form_nueva_clasificacion")
            ->with("usuario_actual",$usuario_actual);
    }

    public function crear_clasificacion(Request $request){
        
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $clasificacion = new TipoCursos();
        
        $clasificacion->nombre= strtoupper($request->input('clasificacion')?$request->input('clasificacion'):'');
        $clasificacion->estado="A";

        if($clasificacion->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La clasificación fue creado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function frm_editar_clasificacion($idClasificacion= null){

        $clasificacion = TipoCursos::find($idClasificacion);
        $usuario_actual=Auth::user();

        return view('configuracion.form_editar_clasificacion')->with('clasificacion',$clasificacion)
        ->with("usuario_actual",$usuario_actual);
    }

    public function editar_clasificacion(Request $request){
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $clasificacion = TipoCursos::find($request->input('id_clasificacion'));
        
        $clasificacion->nombre= strtoupper($request->input('clasificacion')?$request->input('clasificacion'):'');
        $clasificacion->estado="A";
        if($clasificacion->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","La clasificación fue actualizado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al Actualziar ;...") ;
        }
    }

    public function  borrar_clasificacion($idClasificacion=null) {
        $clasificacion = TipoCursos::find($idClasificacion);
        $clasificacion->delete();
        return response()->json([ 'estado' => 'borrada' ],200);
    }

    public function  consultar_lista_anios($idDocente=null,$idAnio=null ) {
        $lstAnio = ConfClasesDocente::where("id_docente",$idDocente)->where("id_anio",$idAnio)->get();
        return response()->json([ 'lstAnio' => $lstAnio ],200);
    }

     public function  consultar_lista_director_grupo($idDocente=null,$idAnio=null ) {
        $lstDirector = ConfDirectorGrupo::where("id_docente",$idDocente)->where("id_anio",$idAnio)->get();
        return response()->json([ 'lstDirector' => $lstDirector ],200);
    }

    public function  validar_curso_asociado($idAnio=null,$idCurso=null,$idEstudiante=null ) {
        $anio = EstudiantesCurso::where("id_anio",$idAnio)->where("id_estudiante",$idEstudiante)->first();
        if($anio != null){
            $estado = true;  
        }else{
            $estado = false;  
        }
        return response()->json([ 'estado' => $estado ],200);
    }

    public function adicionar_curso_estudiante(Request $request){
        
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $estudianteCurso = new EstudiantesCurso();

        $idAnio = $request->input('anio_escolar');
        $id_estudiante = $request->input('id_estudiante');
        $idCurso = $request->input('curso');
        $idClasificacion = $request->input('tipo_grado');
        
        $anio = ConfAnios::find($idAnio);
        $curso = Grados::find($idCurso);
        $estudiante = Estudiantes::find($id_estudiante);
        $clasificacion = TipoCursos::find($idClasificacion);

        $estudianteCurso->id_anio = $anio->id;
        $estudianteCurso->desc_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $estudianteCurso->id_estudiante = $estudiante->id;
        $estudianteCurso->nombre_estudiante = $estudiante->primer_nombre.' '.$estudiante->segundo_nombre.' '.$estudiante->primer_apellido.' '.$estudiante->segundo_apellido;
        $estudianteCurso->id_curso = $curso->id;
        $estudianteCurso->nom_curso = $curso->nombre;
        $estudianteCurso->id_clasificacion = $clasificacion->id;
        $estudianteCurso->tipo_grado = $clasificacion->nombre;
        $estudianteCurso->estado = 'A';

        if($estudianteCurso->save()){
            return view("configuracion.mensajes.msj_confirmacion")->with("msj","El curso fue matriculaso al estudiante de manera exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function  borrar_asocacion($idAsociacion=null) {
        $accion = EstudiantesCurso::find($idAsociacion);
        $accion->delete();
        return response()->json([ 'estado' => 'borrada' ],200);  
    }

    public function form_nuevo_concepto(){
       
        $usuario_actual=Auth::user();
        
        $docente =  ConfDirectorGrupo::where("id_docente",$usuario_actual->id_persona)->first();
        $periodos = PeriodosClases::all();
        $anios = ConfAnios::all();
        $cursos = Grados::all();
       
        $materias = Materias::all();

        return view("configuracion.form_nuevo_concepto")
            ->with("docente",$docente)
            ->with("periodos",$periodos)
            ->with("anios",$anios)
            ->with("cursos",$cursos)
            ->with("materias",$materias);
    }

    public function form_nuevo_concepto_trans(){
       
        $usuario_actual=Auth::user();
        $docente =  ConfDirectorGrupo::where("id_docente",$usuario_actual->id_persona)->first();
        $idCurso = $docente->id_curso;
        $periodos = PeriodosClases::all();
        $anios = ConfAnios::all();
        $cursos = Grados::where("id",$idCurso )->get();
        

        return view("configuracion.form_nuevo_concepto_trans")
            ->with("docente",$docente)
            ->with("periodos",$periodos)
            ->with("anios",$anios)
            ->with("cursos",$cursos);
    }

    public function form_nuevo_concepto_comp(){
       
        $usuario_actual=Auth::user();
        $docente =  ConfDirectorGrupo::where("id_docente",$usuario_actual->id_persona)->first();
        $idCurso = $docente->id_curso;
        $periodos = PeriodosClases::all();
        $anios = ConfAnios::all();
        $cursos = Grados::where("id",$idCurso )->get();
        

        return view("configuracion.form_nuevo_concepto_comp")
            ->with("docente",$docente)
            ->with("periodos",$periodos)
            ->with("anios",$anios)
            ->with("cursos",$cursos);
    }

    public function form_nueva_dimension(){
       
        $usuario_actual=Auth::user();
        $materias = Materias::where("tipo_curso", "=", 1)->paginate(50);
        $docente =  ConfDirectorGrupo::where("id_docente",$usuario_actual->id_persona)->first();

        return view("configuracion.form_nueva_dimension")
            ->with("docente",$docente)
            ->with("materias",$materias);
    }

    public function  info_materia_docente($idAnio=null,$idDocente=null) {

        $clasesDocente =  ConfClasesDocente::where("id_docente",$idDocente)->where("id_anio", $idAnio)->get();
        $agrupados = [];

        foreach ($clasesDocente as $item) {
            $clave = $item['id_materia'] . '-' . $item['nom_materia'] . '-' . $item['json_cursos'];

            if (!isset($agrupados[$clave])) {
                $agrupados[$clave] = [
                    'id_materia' => $item['id_materia'],
                    'nom_materia' => $item['nom_materia'],
                    'json_cursos' => json_decode($item['json_cursos'], true),
                ];
            }
        }

        // Si prefieres un array indexado en lugar de asociativo:
        $agrupadosFinal = array_values($agrupados);
       
        return response()->json([ 'materias' => $agrupadosFinal ],200);

    }

    public function  info_cursos_docente($idAnio=null,$idDocente=null,$idMateria=null) {

        $clasesDocente =  ConfClasesDocente::where("id_docente",$idDocente)->where("id_anio", $idAnio)->where("id_materia", $idMateria)->first();
        $dataCursos = json_decode($clasesDocente->json_cursos);
       
        return response()->json([ 'cursos' => $dataCursos, 'docente' => $clasesDocente  ],200);

    }

    public function nuevo_concepto(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('anio');
        $anio = ConfAnios::find($idAnio);
        $idMateria = $request->input('materia');
        $materia = Materias::find($idMateria);
        $idCurso = $request->input('curso');
        $curso = Grados::find($idCurso);
        $idPeriodo = $request->input('periodo');
        $periodo = PeriodosClases::find($idPeriodo);
        $desempenio = $request->input('desempenio');

        $clasesDocente =  ConceptosEvaluacion::where("id_anio", $idAnio)
                                            ->where("id_materia", $idMateria)
                                            ->where("id_grado", $idCurso)
                                            ->where("id_periodo", $idPeriodo)
                                            ->where("desempenio", (string)$desempenio)->first();
        //dd($clasesDocente);
        if($clasesDocente != null){
             return response()->json([
                'success' => false,
                'message' => 'NO'
            ], 200);

        }
        $concepto = new ConceptosEvaluacion();
        $concepto->id_anio = $anio->id;
        $concepto->nom_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $concepto->id_grado = $curso->id;
        $concepto->nom_grado = $curso->nombre;
        $concepto->id_periodo = $periodo->id;
        $concepto->nom_periodo = $periodo->nombre;
        $concepto->id_materia = $materia->id;
        $concepto->nom_materia = $materia->nombre;
        $concepto->desempenio = $desempenio;
        $concepto->descripcion = $request->input('conceptos')?$request->input('conceptos'):"";
        $concepto->estado = 'A';

        if($concepto->save()){
           return response()->json([
                'success' => true,
                'message' => 'SI'
            ], 200);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function nuevo_concepto_comp(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('anio');
        $anio = ConfAnios::find($idAnio);
        $idCurso = $request->input('curso');
        $curso = Grados::find($idCurso);
        $idPeriodo = $request->input('periodo');
        $periodo = PeriodosClases::find($idPeriodo);
        $desempenio = $request->input('desempenio');

        $clasesDocente =  ConceptosComportamiento::where("id_anio", $idAnio)
                                            ->where("id_curso", $idCurso)
                                            ->where("id_periodo", $idPeriodo)
                                            ->where("desempenio", (string)$desempenio)->first();
        //dd($clasesDocente);
        if($clasesDocente != null){
             return response()->json([
                'success' => false,
                'message' => 'NO'
            ], 200);

        }
        $concepto = new ConceptosComportamiento();
        $concepto->id_anio = $anio->id;
        $concepto->nom_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $concepto->id_curso = $curso->id;
        $concepto->nom_curso = $curso->nombre;
        $concepto->id_periodo = $periodo->id;
        $concepto->nom_periodo = $periodo->nombre;
        $concepto->desempenio = $desempenio;
        $concepto->descripcion = $request->input('conceptos')?$request->input('conceptos'):"";
        $concepto->estado = 'A';

        if($concepto->save()){
           return response()->json([
                'success' => true,
                'message' => 'SI'
            ], 200);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function nuevo_concepto_trans(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('anio');
        $anio = ConfAnios::find($idAnio);
        $idCurso = $request->input('curso');
        $curso = Grados::find($idCurso);
        $idPeriodo = $request->input('periodo');
        $periodo = PeriodosClases::find($idPeriodo);
        $desempenio = $request->input('desempenio');

        $clasesDocente =  ConceptosEvaluacionTransicion::where("id_anio", $idAnio)
                                            ->where("id_grado", $idCurso)
                                            ->where("id_periodo", $idPeriodo)
                                            ->where("desempenio", (string)$desempenio)->first();
        //dd($clasesDocente);
        if($clasesDocente != null){
             return response()->json([
                'success' => false,
                'message' => 'NO'
            ], 200);

        }
        $concepto = new ConceptosEvaluacionTransicion();
        $concepto->id_anio = $anio->id;
        $concepto->nom_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $concepto->id_grado = $curso->id;
        $concepto->nom_grado = $curso->nombre;
        $concepto->id_periodo = $periodo->id;
        $concepto->nom_periodo = $periodo->nombre;
        $concepto->desempenio = $desempenio;
        $concepto->descripcion = $request->input('conceptos')?$request->input('conceptos'):"";
        $concepto->estado = 'A';

        if($concepto->save()){
           return response()->json([
                'success' => true,
                'message' => 'SI'
            ], 200);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function nueva_dimension(Request $request){
        
        //crea una cuenta en el sistema
        $idMateria = $request->input('materia');
        $materia = Materias::find($idMateria);

        $dimension = new ItemEvaluarTransicion();
        $dimension->id_materia = $materia->id;
        $dimension->nom_materia = $materia->nombre;
        $dimension->descripcion = $request->input('dimension')?$request->input('dimension'):"";
        $dimension->estado = 'A';

        if($dimension->save()){
           return view("configuracion.mensajes.msj_confirmacion")->with("msj","La dimension fue almacenada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    

    

    public function frm_editar_concepto($idConcepto= null){

        $concepto = ConceptosEvaluacion::find($idConcepto);
        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);
        $anios = ConfAnios::all();
        $periodos = PeriodosClases::all();
        
        $clasesDocente =  ConfClasesDocente::where("id_docente",$docente->id)->where("id_anio", $concepto->id_anio)->get();
       
        $agrupados = [];
        foreach ($clasesDocente as $item) {
            $clave = $item->id_materia . '-' . $item->nom_materia;

            if (!isset($agrupados[$clave])) {
                $agrupados[$clave] = [
                    'id' => $item->id_materia,
                    'nombre' => $item->nom_materia
                ];
            }
        }

        $materias = array_values($agrupados);
        $clasesDocenteCurso =  ConfClasesDocente::where("id_docente",$docente->id)->where("id_anio", $concepto->id_anio)->where("id_materia", $concepto->id_materia)->first();
        $cursos = json_decode($clasesDocenteCurso->json_cursos);


        return view('configuracion.form_editar_concepto')->with('docente',$docente)
                                                        ->with("concepto",$concepto)
                                                        ->with("docente",$docente)
                                                        ->with("periodos",$periodos)
                                                        ->with("anios",$anios)
                                                        ->with("cursos",$cursos)
                                                        ->with("materias",$materias);
    }

    public function frm_editar_concepto_comp($idConcepto= null){

        $concepto = ConceptosComportamiento::find($idConcepto);
        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);
        $anios = ConfAnios::all();
        $periodos = PeriodosClases::all();

        $docenteCurso =  ConfDirectorGrupo::where("id_docente",$docente->id)->first();
        $idCurso = $docenteCurso->id_curso;
        $cursos = Grados::where("id",$idCurso )->get();
        

        return view('configuracion.form_editar_concepto_comp')->with('docente',$docente)
                                                        ->with("concepto",$concepto)
                                                        ->with("docente",$docente)
                                                        ->with("periodos",$periodos)
                                                        ->with("anios",$anios)
                                                        ->with("cursos",$cursos);
    }

    public function frm_editar_concepto_trans($idConcepto= null){

        $concepto = ConceptosEvaluacionTransicion::find($idConcepto);
        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);
        $anios = ConfAnios::all();
        $periodos = PeriodosClases::all();

        $docenteCurso =  ConfDirectorGrupo::where("id_docente",$docente->id)->first();
        $idCurso = $docenteCurso->id_curso;
        $cursos = Grados::where("id",$idCurso )->get();
        

        return view('configuracion.form_editar_concepto_trans')->with('docente',$docente)
                                                        ->with("concepto",$concepto)
                                                        ->with("docente",$docente)
                                                        ->with("periodos",$periodos)
                                                        ->with("anios",$anios)
                                                        ->with("cursos",$cursos);
    }

    public function frm_editar_dimension($idDimension= null){

        $dimension = ItemEvaluarTransicion::find($idDimension);
        $usuarioactual = Auth::user();
        $docente = Docentes::find($usuarioactual->id_persona);
        $materias = Materias::where("tipo_curso", "=", 1)->get();

        return view('configuracion.form_editar_dimension')->with('docente',$docente)
                                                        ->with("dimension",$dimension)
                                                        ->with("materias",$materias);
    }

    public function  borrar_concepto($idConcepto=null) {
        $concepto = ConceptosEvaluacion::find($idConcepto);
        $concepto->delete();
        return response()->json([ 'estado' => 'borrada' ],200);
    }

    public function  borrar_concepto_comp($idConcepto=null) {
        $concepto = ConceptosComportamiento::find($idConcepto);
        $concepto->delete();
        return response()->json([ 'estado' => 'borrada' ],200);
    }

    public function  borrar_concepto_trans($idConcepto=null) {
        $concepto = ConceptosEvaluacionTransicion::find($idConcepto);
        $concepto->delete();
        return response()->json([ 'estado' => 'borrada' ],200);
    }

    public function  borrar_dimension($idDimencion=null) {
        $dimension = ItemEvaluarTransicion::find($idDimencion);
        $dimension->delete();
        return response()->json([ 'estado' => 'borrada' ],200);
    }
    

    public function editar_concepto(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('anio');
        $anio = ConfAnios::find($idAnio);
        $idMateria = $request->input('materia');
        $materia = Materias::find($idMateria);
        $idCurso = $request->input('curso');
        $curso = Grados::find($idCurso);
        $idPeriodo = $request->input('periodo');
        $periodo = PeriodosClases::find($idPeriodo);
        $desempenio = $request->input('desempenio');

        $concepto = ConceptosEvaluacion::find($request->input('id_concepto'));
        $concepto->id_anio = $anio->id;
        $concepto->nom_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $concepto->id_grado = $curso->id;
        $concepto->nom_grado = $curso->nombre;
        $concepto->id_periodo = $periodo->id;
        $concepto->nom_periodo = $periodo->nombre;
        $concepto->id_materia = $materia->id;
        $concepto->nom_materia = $materia->nombre;
        $concepto->desempenio = $desempenio;
        $concepto->descripcion = $request->input('conceptos')?$request->input('conceptos'):"";

        if($concepto->save()){
           return view("configuracion.mensajes.msj_confirmacion")->with("msj","El concepto fue actualziado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function editar_concepto_comp(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('anio');
        $anio = ConfAnios::find($idAnio);
        $idCurso = $request->input('curso');
        $curso = Grados::find($idCurso);
        $idPeriodo = $request->input('periodo');
        $periodo = PeriodosClases::find($idPeriodo);
        $desempenio = $request->input('desempenio');

        $concepto = ConceptosComportamiento::find($request->input('id_concepto'));
        $concepto->id_anio = $anio->id;
        $concepto->nom_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $concepto->id_curso = $curso->id;
        $concepto->nom_curso = $curso->nombre;
        $concepto->id_periodo = $periodo->id;
        $concepto->nom_periodo = $periodo->nombre;
        $concepto->desempenio = $desempenio;
        $concepto->descripcion = $request->input('conceptos')?$request->input('conceptos'):"";

        if($concepto->save()){
           return view("configuracion.mensajes.msj_confirmacion")->with("msj","El concepto fue actualziado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

    public function editar_concepto_trans(Request $request){
        
        //crea una cuenta en el sistema
        $idAnio = $request->input('anio');
        $anio = ConfAnios::find($idAnio);
        $idCurso = $request->input('curso');
        $curso = Grados::find($idCurso);
        $idPeriodo = $request->input('periodo');
        $periodo = PeriodosClases::find($idPeriodo);
        $desempenio = $request->input('desempenio');

        $concepto = ConceptosEvaluacionTransicion::find($request->input('id_concepto'));
        $concepto->id_anio = $anio->id;
        $concepto->nom_anio = $anio->anio_inicio.' - '.$anio->anio_fin;
        $concepto->id_grado = $curso->id;
        $concepto->nom_grado = $curso->nombre;
        $concepto->id_periodo = $periodo->id;
        $concepto->nom_periodo = $periodo->nombre;
        $concepto->desempenio = $desempenio;
        $concepto->descripcion = $request->input('conceptos')?$request->input('conceptos'):"";

        if($concepto->save()){
           return view("configuracion.mensajes.msj_confirmacion")->with("msj","El concepto fue actualziado exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }

     public function editar_dimension(Request $request){
        
         //crea una cuenta en el sistema
        $idMateria = $request->input('materia');
        $materia = Materias::find($idMateria);

        $dimension = ItemEvaluarTransicion::find($request->input('id_dimension'));
        $dimension->id_materia = $materia->id;
        $dimension->nom_materia = $materia->nombre;
        $dimension->descripcion = $request->input('dimension')?$request->input('dimension'):"";
        $dimension->estado = 'A';

        if($dimension->save()){
           return view("configuracion.mensajes.msj_confirmacion")->with("msj","La dimension fue actualizada exitosamente");
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }



    

    


   

    

    



    
}

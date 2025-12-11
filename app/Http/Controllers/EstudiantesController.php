<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Estudiantes;
use App\TiposDocumentos;
use App\Grados;
use App\EstudiantesCurso;
use App\ConfAnios;
use App\NotaFinalEstudiante;
use App\EvaluacionEstudiante;


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
class EstudiantesController extends Controller
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


    public function listado_estudiantes() {
        $usuarioactual = Auth::user();
        $estado = 'A';
        $filtro = 'I';
        $grados = Grados::all();
        $anios = ConfAnios::all();
        $lstEstudiantes = Estudiantes::where("estado", "=", $estado)->paginate(50);
        return view("estudiantes.listado_estudiantes")->with("lstEstudiantes", $lstEstudiantes)
        ->with("estado", $estado)
        ->with("grados",$grados)
        ->with("anios",$anios)
         ->with("filtro",$filtro)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_estudiantes_i() {
        $usuarioactual = Auth::user();
        $grados = Grados::all();
        $estado = 'I';
        $filtro = 'I';
        $lstEstudiantes = Estudiantes::where("estado", "=", $estado)->paginate(50);
        return view("estudiantes.listado_estudiantes")->with("lstEstudiantes", $lstEstudiantes)
        ->with("estado", $estado)
        ->with("grados",$grados)
         ->with("filtro",$filtro)
        ->with("usuarioactual", $usuarioactual);
    }

    public function listado_estudiantes_filtro($idAnio=null, $idGrado=null) {
        
        //dd('idanio',$idAnio , 'idGrado',$idGrado );
        $usuarioactual = Auth::user();
        $estado = 'A';
        $grados = Grados::all();
        $anios = ConfAnios::all();
        $anioFind = ConfAnios::find($idAnio);
        $cursoFind = Grados::find($idGrado);
        $filtro = 'A';
        $lstEstudiantes = Estudiantes::where("estado", "=", $estado)->get();
        $estudiantesCurso = EstudiantesCurso::where("id_anio",$idAnio)->where("id_curso",$idGrado)->get();
        
        // Creamos una colección con los IDs de estudiantes del curso
        $idsCurso = $estudiantesCurso->pluck('id_estudiante')->toArray();

        // Filtramos los estudiantes activos que están en ese curso
        $estudiantesFiltrados = $lstEstudiantes->filter(function ($estudiante) use ($idsCurso) {
            return in_array($estudiante->id, $idsCurso);
        });

        return view("estudiantes.listado_estudiantes")->with("lstEstudiantes", $estudiantesFiltrados)
        ->with("estado", $estado)
        ->with("grados",$grados)
        ->with("anios",$anios)
        ->with("filtro",$filtro)
        ->with("anioFind",$anioFind)
        ->with("cursoFind",$cursoFind)
        ->with("usuarioactual", $usuarioactual);

        
    }

    

    public function form_nuevo_estudiante(){
        $usuario_actual=Auth::user();
        $tiposDocumentos = TiposDocumentos::all();

        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        return view("estudiantes.form_nuevo_estudiante")
               ->with("tiposDocumentos",$tiposDocumentos)
               ->with("usuario_actual",$usuario_actual);
    }

    public function crear_estudiante(Request $request){
        
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $estudiante = new Estudiantes();
        
        $tipoDoc = $request->input('tipoDocumento');
        $tipoDocumento = TiposDocumentos::find($tipoDoc);
        $estudiante->fecha_matricula = date("y-m-d");
        $estudiante->id_tipo_documento=$tipoDocumento->id;
        $estudiante->tipo_documento= $tipoDocumento->descripcion;
        $estudiante->identificacion=$request->input('identificacion')?$request->input('identificacion'):'';
        $estudiante->lugar_expedicion=$request->input('lugar_expedicion')?$request->input('lugar_expedicion'):'';
        $estudiante->fecha_nacimiento=$request->input("fecha_nacimiento", "0000-00-00");
        $estudiante->lugar_nacimiento=$request->input('lugar_nacimeinto')?$request->input('lugar_nacimeinto'):'';
        $estudiante->primer_nombre=$request->input('primer_nombre')?$request->input('primer_nombre'):'';
        $estudiante->segundo_nombre=$request->input('segundo_nombre')?$request->input('segundo_nombre'):'';
        $estudiante->primer_apellido=$request->input('primer_apellido')?$request->input('primer_apellido'):'';
        $estudiante->segundo_apellido=$request->input('segundo_apellido')?$request->input('segundo_apellido'):'';
        $estudiante->genero=$request->input('genero')?$request->input('genero'):'';
        $estudiante->tipo_rh=$request->input('rh')?$request->input('rh'):'';

        $edadEstudiante = Carbon::parse($estudiante->fecha_nacimiento)->age;

        $estudiante->edad=$edadEstudiante;
        $estudiante->nacionalidad=$request->input('nacionalidad')?$request->input('nacionalidad'):'';
        $estudiante->direccion=$request->input('direccion')?$request->input('direccion'):'';
        $estudiante->barrio=$request->input('barrio')?$request->input('barrio'):'';
        $estudiante->comuna=$request->input('comuna')?$request->input('comuna'):'';
        $estudiante->corregimiento=$request->input('corregimiento')?$request->input('corregimiento'):'';
        $estudiante->vereda=$request->input('vereda')?$request->input('vereda'):'';
        $estudiante->telefono=$request->input('telefono')?$request->input('telefono'):'';
        $estudiante->correo_electronico=$request->input('email')?$request->input('email'):'';
        
        $estudiante->tipos_seguridad_social=$request->input('seguridad_social')?$request->input('seguridad_social'):'';
        $estudiante->eps=$request->input('eps')?$request->input('eps'):'';
        $estudiante->sisben=$request->input('sisben')?$request->input('sisben'):'';
        $estudiante->estrato=$request->input('estrato')?$request->input('estrato'):'';
        $estudiante->tiene_discapacidad=$request->input('discapaciadad')?$request->input('discapaciadad'):'';
        $estudiante->desc_discapacidad =$request->input('desc_discapacidad')?$request->input('desc_discapacidad'):'';
        $vacunas = $request->input('vacunas')?$request->input('vacunas'):[];
        $vacunasArray = array();
        if (count($vacunas) > 0) {
            foreach ($vacunas as $vac) {
                $newarrayact = array(
                    "nombre_vacuna" =>$vac
                );
                array_push( $vacunasArray, $newarrayact);
            }
        }else{
            $vacunasArray = null;
        }
        $estudiante->json_vacunas=json_encode($vacunasArray);
        $estudiante->pob_victima_conflicto =$request->input('victima_conflicto')?$request->input('victima_conflicto'):'NO';
        $estudiante->pob_desplazada_conflicto=$request->input('pob_des_conflicto')?$request->input('pob_des_conflicto'):'NO';
        $estudiante->estado="A";
        $estudiante->observaciones_adicionales=$request->input('observaciones')?$request->input('observaciones'):'';
        
        $parentesco1 = $request->input('parentesco1')?$request->input('parentesco1'):'';
        $parentesco2 = $request->input('parentesco2')?$request->input('parentesco2'):'';
        $parentesco3 = $request->input('parentesco3')?$request->input('parentesco3'):'';

        $responsablesArray = array();
        if($parentesco1 != ""){
            $tipoDoc1 = $request->input('tipoDocumento1');
            $tipoDocumento1 = TiposDocumentos::find($tipoDoc1);
            $newarrayact1 = array(
                "id" =>1,
                "tipo" => $request->input('parentesco1')?$request->input('parentesco1'):'',
                "id_documento" => $tipoDocumento1->id,
                "nombreDocumento" => $tipoDocumento1->descripcion,
                "identificacion" => $request->input('nro_identificacion1')?$request->input('nro_identificacion1'):'',
                "nombres" => $request->input('nombres1')?$request->input('nombres1'):'',
                "ocupacion" => $request->input('ocupacion1')?$request->input('ocupacion1'):'',
                "telefono" => $request->input('telefono1')?$request->input('telefono1'):''
            );
            array_push($responsablesArray, $newarrayact1);
        }
        if($parentesco2 != ""){
            $tipoDoc2 = $request->input('tipoDocumento2');
            $tipoDocumento2 = TiposDocumentos::find($tipoDoc2);
            $newarrayact2 = array(
                "id" =>2,
                "tipo" => $request->input('parentesco2')?$request->input('parentesco2'):'',
                "id_documento" => $tipoDocumento2->id,
                "nombreDocumento" => $tipoDocumento2->descripcion,
                "identificacion" => $request->input('nro_identificacion2')?$request->input('nro_identificacion2'):'',
                "nombres" => $request->input('nombres1')?$request->input('nombres2'):'',
                "ocupacion" => $request->input('ocupacion2')?$request->input('ocupacion2'):'',
                "telefono" => $request->input('telefono2')?$request->input('telefono2'):''
            );
            array_push($responsablesArray, $newarrayact2);
        }
        if($parentesco3 != ""){
            $tipoDoc3 = $request->input('tipoDocumento3');
            $tipoDocumento3 = TiposDocumentos::find($tipoDoc3);
            $newarrayact3 = array(
                "id" =>1,
                "tipo" => $request->input('parentesco3')?$request->input('parentesco3'):'',
                "id_documento" => $tipoDocumento3->id,
                "nombreDocumento" => $tipoDocumento3->descripcion,
                "identificacion" => $request->input('nro_identificacion3')?$request->input('nro_identificacion3'):'',
                "nombres" => $request->input('nombres3')?$request->input('nombres3'):'',
                "ocupacion" => $request->input('ocupacion3')?$request->input('ocupacion3'):'',
                "telefono" => $request->input('telefono3')?$request->input('telefono3'):''
            );
            array_push($responsablesArray, $newarrayact3);
        }
        $estudiante->responsable_json= json_encode($responsablesArray);

        if($estudiante->save())
        {
            return view("estudiantes.mensajes.msj_creado")->with("msj","Estudiante creado exitosamente")
            										   ->with("estado",$estudiante->estado);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }

    }

    public function frm_info_estudiante($id_estudiante= null){

        $estudiante=Estudiantes::find($id_estudiante);
        $infoResponsable = json_decode($estudiante->responsable_json);
        $responsable1 = "N";
        $responsable2 = "N";
        $responsable3 = "N";
        if($infoResponsable != null){
            
            foreach ($infoResponsable as $key => $value) {
                if($value->id == 1){
                    $responsable1 = $value;
                }if($value->id == 2){
                    $responsable2 = $value;
                }if($value->id == 3){
                    $responsable3 = $value;
                }
            }
        }else{
            $infoResponsable = [];
        }
        
        $vacunas = json_decode($estudiante->json_vacunas);
        $vacuna1 = 'N';
        $vacuna2 = 'N';
        $vacuna3 = 'N';
        $vacuna4 = 'N';
        $vacuna5 = 'N';
        $vacuna6 = 'N';
        $vacuna7 = 'N';
        if($vacunas != null){
            foreach( $vacunas as $key => $value ){
                if($value->nombre_vacuna == "DPT"){$vacuna1 = 'S';}
                if($value->nombre_vacuna == "T.VIRAL"){$vacuna2 = 'S';}
                if($value->nombre_vacuna == "POL"){$vacuna3 = 'S';}
                if($value->nombre_vacuna == "SAR"){$vacuna4 = 'S';}
                if($value->nombre_vacuna == "BCB"){$vacuna5 = 'S';}
                if($value->nombre_vacuna == "HIB"){$vacuna6 = 'S';}
                if($value->nombre_vacuna == "H.V."){$vacuna7 = 'S';}
            }
        }else{
            $vacunas = [];
        }
        

        //dd($vacuna1,$vacuna2,$vacuna3,$vacuna4,$vacuna5,$vacuna6,$vacuna7);
        $usuario_actual=Auth::user();
        return view('estudiantes.form_info_estudiante')->with('estudiante',$estudiante)
        ->with("usuario_actual",$usuario_actual)
        ->with("responsable1",$responsable1)
        ->with("responsable2",$responsable2)
        ->with("responsable3",$responsable3)
        ->with("vacuna1",$vacuna1)
        ->with("vacuna2",$vacuna2)
        ->with("vacuna3",$vacuna3)
        ->with("vacuna4",$vacuna4)
        ->with("vacuna5",$vacuna5)
        ->with("vacuna5",$vacuna5)
        ->with("vacuna6",$vacuna6)
        ->with("vacuna7",$vacuna7);

    }

    public function frm_editar_estudiante($id_estudiante= null){

        $estudiante=Estudiantes::find($id_estudiante);
        $tiposDocumentos = TiposDocumentos::all();
        $infoResponsable = json_decode($estudiante->responsable_json);
        $responsable1 = "N";
        $responsable2 = "N";
        $responsable3 = "N";
        if($infoResponsable != null){
            foreach ($infoResponsable as $key => $value) {
                if($value->id == 1){
                    $responsable1 = $value;
                }if($value->id == 2){
                    $responsable2 = $value;
                }if($value->id == 3){
                    $responsable3 = $value;
                }
            }
        }else{
            $infoResponsable = []; 
        }
        $vacunas = json_decode($estudiante->json_vacunas);
        $vacuna1 = 'N';
        $vacuna2 = 'N';
        $vacuna3 = 'N';
        $vacuna4 = 'N';
        $vacuna5 = 'N';
        $vacuna6 = 'N';
        $vacuna7 = 'N';
        if($vacunas != null){
            foreach( $vacunas as $key => $value ){
                if($value->nombre_vacuna == "DPT"){$vacuna1 = 'S';}
                if($value->nombre_vacuna == "T.VIRAL"){$vacuna2 = 'S';}
                if($value->nombre_vacuna == "POL"){$vacuna3 = 'S';}
                if($value->nombre_vacuna == "SAR"){$vacuna4 = 'S';}
                if($value->nombre_vacuna == "BCB"){$vacuna5 = 'S';}
                if($value->nombre_vacuna == "HIB"){$vacuna6 = 'S';}
                if($value->nombre_vacuna == "H.V."){$vacuna7 = 'S';}
            }
        }else{
            $vacunas = [];
        }
        //dd($vacuna1,$vacuna2,$vacuna3,$vacuna4,$vacuna5,$vacuna6,$vacuna7);
        $usuario_actual=Auth::user();
        return view('estudiantes.form_editar_estudiante')->with('estudiante',$estudiante)
        ->with("usuario_actual",$usuario_actual)
        ->with("tiposDocumentos",$tiposDocumentos)
        ->with("responsable1",$responsable1)
        ->with("responsable2",$responsable2)
        ->with("responsable3",$responsable3)
        ->with("vacuna1",$vacuna1)
        ->with("vacuna2",$vacuna2)
        ->with("vacuna3",$vacuna3)
        ->with("vacuna4",$vacuna4)
        ->with("vacuna5",$vacuna5)
        ->with("vacuna5",$vacuna5)
        ->with("vacuna6",$vacuna6)
        ->with("vacuna7",$vacuna7);

    }

    public function editar_estudiante(Request $request){
        
        //crea una cuenta en el sistema
        $usuario_actual=Auth::user();
        $id_estudiante = $request->input('id_estudiante');
        $estudiante = Estudiantes::find($id_estudiante);
        $tipoDoc = $request->input('tipoDocumento');
        $tipoDocumento = TiposDocumentos::find($tipoDoc);

        $estudiante->id_tipo_documento=$tipoDocumento->id;
        $estudiante->tipo_documento= $tipoDocumento->descripcion;
        $estudiante->identificacion=$request->input('identificacion')?$request->input('identificacion'):'';
        $estudiante->lugar_expedicion=$request->input('lugar_expedicion')?$request->input('lugar_expedicion'):'';
        $estudiante->fecha_nacimiento=$request->input("fecha_nacimiento", "0000-00-00");
        $estudiante->lugar_nacimiento=$request->input('lugar_nacimeinto')?$request->input('lugar_nacimeinto'):'';
        $estudiante->primer_nombre=$request->input('primer_nombre')?$request->input('primer_nombre'):'';
        $estudiante->segundo_nombre=$request->input('segundo_nombre')?$request->input('segundo_nombre'):'';
        $estudiante->primer_apellido=$request->input('primer_apellido')?$request->input('primer_apellido'):'';
        $estudiante->segundo_apellido=$request->input('segundo_apellido')?$request->input('segundo_apellido'):'';
        $estudiante->genero=$request->input('genero')?$request->input('genero'):'';
        $estudiante->tipo_rh=$request->input('rh')?$request->input('rh'):'';

        $edadEstudiante = Carbon::parse($estudiante->fecha_nacimiento)->age;

        $estudiante->edad=$edadEstudiante;
        $estudiante->nacionalidad=$request->input('nacionalidad')?$request->input('nacionalidad'):'';
        $estudiante->direccion=$request->input('direccion')?$request->input('direccion'):'';
        $estudiante->barrio=$request->input('barrio')?$request->input('barrio'):'';
        $estudiante->comuna=$request->input('comuna')?$request->input('comuna'):'';
        $estudiante->corregimiento=$request->input('corregimiento')?$request->input('corregimiento'):'';
        $estudiante->vereda=$request->input('vereda')?$request->input('vereda'):'';
        $estudiante->telefono=$request->input('telefono')?$request->input('telefono'):'';
        $estudiante->correo_electronico=$request->input('email')?$request->input('email'):'';
        
        $estudiante->tipos_seguridad_social=$request->input('seguridad_social')?$request->input('seguridad_social'):'';
        $estudiante->eps=$request->input('eps')?$request->input('eps'):'';
        $estudiante->sisben=$request->input('sisben')?$request->input('sisben'):'';
        $estudiante->estrato=$request->input('estrato')?$request->input('estrato'):'';
        $estudiante->tiene_discapacidad=$request->input('discapaciadad')?$request->input('discapaciadad'):'';
        $estudiante->desc_discapacidad =$request->input('desc_discapacidad')?$request->input('desc_discapacidad'):'';
        $vacunas = $request->input('vacunas')?$request->input('vacunas'):[];
        $vacunasArray = array();
        if (count($vacunas) > 0) {
            foreach ($vacunas as $vac) {
                $newarrayact = array(
                    "nombre_vacuna" =>$vac
                );
                array_push( $vacunasArray, $newarrayact);
            }
        }else{
            $vacunasArray = null;
        }
        $estudiante->json_vacunas=json_encode($vacunasArray);
        $estudiante->pob_victima_conflicto =$request->input('victima_conflicto')?$request->input('victima_conflicto'):'';
        $estudiante->pob_desplazada_conflicto=$request->input('pob_des_conflicto')?$request->input('pob_des_conflicto'):'';
        $estudiante->estado="A";
        $estudiante->observaciones_adicionales=$request->input('observaciones')?$request->input('observaciones'):'';
        
        $parentesco1 = $request->input('parentesco1')?$request->input('parentesco1'):'';
        $parentesco2 = $request->input('parentesco2')?$request->input('parentesco2'):'';
        $parentesco3 = $request->input('parentesco3')?$request->input('parentesco3'):'';
        $estudiante->responsable_json = null;
        $responsablesArray = array();
        if($parentesco1 != ""){
            $tipoDoc1 = $request->input('tipoDocumento1');
            $tipoDocumento1 = TiposDocumentos::find($tipoDoc1);
            $newarrayact1 = array(
                "id" =>1,
                "tipo" => $request->input('parentesco1')?$request->input('parentesco1'):'',
                "id_documento" => $tipoDocumento1->id,
                "nombreDocumento" => $tipoDocumento1->descripcion,
                "identificacion" => $request->input('nro_identificacion1')?$request->input('nro_identificacion1'):'',
                "nombres" => $request->input('nombres1')?$request->input('nombres1'):'',
                "ocupacion" => $request->input('ocupacion1')?$request->input('ocupacion1'):'',
                "telefono" => $request->input('telefono1')?$request->input('telefono1'):''
            );
            array_push($responsablesArray, $newarrayact1);
        }
        if($parentesco2 != ""){
            $tipoDoc2 = $request->input('tipoDocumento2');
            $tipoDocumento2 = TiposDocumentos::find($tipoDoc2);
            $newarrayact2 = array(
                "id" =>2,
                "tipo" => $request->input('parentesco2')?$request->input('parentesco2'):'',
                "id_documento" => $tipoDocumento2->id,
                "nombreDocumento" => $tipoDocumento2->descripcion,
                "identificacion" => $request->input('nro_identificacion2')?$request->input('nro_identificacion2'):'',
                "nombres" => $request->input('nombres1')?$request->input('nombres2'):'',
                "ocupacion" => $request->input('ocupacion2')?$request->input('ocupacion2'):'',
                "telefono" => $request->input('telefono2')?$request->input('telefono2'):''
            );
            array_push($responsablesArray, $newarrayact2);
        }
        if($parentesco3 != ""){
            $tipoDoc3 = $request->input('tipoDocumento3');
            $tipoDocumento3 = TiposDocumentos::find($tipoDoc3);
            $newarrayact3 = array(
                "id" =>3,
                "tipo" => $request->input('parentesco3')?$request->input('parentesco3'):'',
                "id_documento" => $tipoDocumento3->id,
                "nombreDocumento" => $tipoDocumento3->descripcion,
                "identificacion" => $request->input('nro_identificacion3')?$request->input('nro_identificacion3'):'',
                "nombres" => $request->input('nombres3')?$request->input('nombres3'):'',
                "ocupacion" => $request->input('ocupacion3')?$request->input('ocupacion3'):'',
                "telefono" => $request->input('telefono3')?$request->input('telefono3'):''
            );
            array_push($responsablesArray, $newarrayact3);
        }
        $estudiante->responsable_json= json_encode($responsablesArray);
        if($estudiante->save()){
           
            $estudiantesCurso = EstudiantesCurso::all();

            foreach ($estudiantesCurso as $estu) {
                if ($estu->id_estudiante == $estudiante->id) {
                    $estudiantesCursoActualizar = EstudiantesCurso::find($estu->id_estudiante);
                    $estudiantesCursoActualizar->nombre_estudiante = $estudiante->primer_nombre . " " .
                                                    $estudiante->segundo_nombre . " " .
                                                    $estudiante->primer_apellido . " " .
                                                    $estudiante->segundo_apellido;
                    $estudiantesCursoActualizar->save(); // ✅ guardamos el modelo actual
                }
            }

            $evaluacionEstudiante = EvaluacionEstudiante::all();
            foreach ($evaluacionEstudiante as $estuEva) {
                if ($estuEva->id_estudiante == $estudiante->id) {
                    $evaluacionActualizar = EvaluacionEstudiante::find($estuEva->id_estudiante);
                    $evaluacionActualizar->nom_estudiante = $estudiante->primer_nombre . " " .
                                                    $estudiante->segundo_nombre . " " .
                                                    $estudiante->primer_apellido . " " .
                                                    $estudiante->segundo_apellido;
                    $evaluacionActualizar->save(); // ✅ guardamos el modelo actual
                }
            }

            $notaFinal = NotaFinalEstudiante::all();
            foreach ($notaFinal as $estuEvaFinal) {
                if ($estuEvaFinal->id_estudiante == $estudiante->id) {
                    $evaluacionFinalActualizar = NotaFinalEstudiante::find($estuEvaFinal->id_estudiante);
                    $evaluacionFinalActualizar->nom_estudiante = $estudiante->primer_nombre . " " .
                                                    $estudiante->segundo_nombre . " " .
                                                    $estudiante->primer_apellido . " " .
                                                    $estudiante->segundo_apellido;
                    $evaluacionFinalActualizar->save(); // ✅ guardamos el modelo actual
                }
            }
            return view("estudiantes.mensajes.msj_actualziado")->with("msj","Estudiante fue actualizado exitosamente")
            										   ->with("estado",$estudiante->estado);
        }else{
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }

    }

    public function buscar_estudiantes(Request $request){

        $usuario_actual=Auth::user();
        $dato=$request->input("dato_buscado");
        $estado=$request->input("estado");
        $filtro = 'I';
        $grados = Grados::all();
        $anios = ConfAnios::all();

        $lstEstudiantes=Estudiantes::where("identificacion","like","%".$dato."%")
                  ->orWhere("primer_nombre","like","%".$dato."%")
                  ->orWhere("segundo_nombre","like","%".$dato."%")
                  ->orWhere("primer_apellido","like","%".$dato."%")
                  ->orWhere("segundo_apellido","like","%".$dato."%")
                  ->paginate(100)
                  ->appends(request()->query());
        return view('estudiantes.listado_estudiantes')->with("usuario_actual",$usuario_actual)
                                                ->with("busqueda",true)
                                                ->with("estado", $estado)
                                                ->with("filtro",$filtro)
                                                ->with("grados",$grados)
                                                ->with("anios",$anios)
                                                ->with("lstEstudiantes", $lstEstudiantes);
      }

       public function inactivarEstudiante($id_estudiante= null){

            $estudiante = Estudiantes::find($id_estudiante);
            $estudiante->estado ='I';
            $estudianteCurso = EstudiantesCurso::find($id_estudiante);
            $estudianteCurso->estado = 'I';
            $estudianteCurso->save();
            $estudiante->save();
            return response()->json([ 'estado' => 'OK' ],200);
       }

       public function activarEstudiante($id_estudiante= null){

            $estudiante = Estudiantes::find($id_estudiante);
            $estudiante->estado ='A';
            $estudianteCurso = EstudiantesCurso::find($id_estudiante);
            $estudianteCurso->estado = 'A';
            $estudianteCurso->save();
            $estudiante->save();
            return response()->json([ 'estado' => 'OK' ],200);
       }

    

    
}

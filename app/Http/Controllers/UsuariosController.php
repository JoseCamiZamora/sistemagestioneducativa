<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Mail;
use Illuminate\Support\Facades\Hash;
use File;
use Response;

class UsuariosController extends Controller
{
 



    public function form_nuevo_usuario(){
        //carga el formulario para agregar un nuevo usuario
        $usuario_actual=Auth::user();
        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
       
     
        return view("usuarios.form_nuevo_usuario")
               ->with("usuario_actual",$usuario_actual);

    }




    public function listado_usuarios(){
        //presenta un listado de usuarios paginados de 100 en 100
        $usuario_actual=Auth::user();
        if( $usuario_actual->rol!=1 ){  
        return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        $usuarios=User::paginate(100);
        
        return view("usuarios.listado_usuarios")->with("usuario_actual",$usuario_actual)
                                                ->with("usuarios",$usuarios);
    }




    public function crear_usuario(Request $request){
        //crea un nuevo usuario en el sistema
         $usuario_actual=Auth::user();
        if( $usuario_actual->rol!=1 ){  
        return view("mensajes.msj_no_autorizado")
               ->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
                   
        $reglas=[  'nombres' => 'required',
                   'rol' => 'required',
                   'telefono' => 'numeric',
                   'password' => 'required|min:5',
    	           'email' => 'required|email|unique:users', ];
        $mensajes=['nombres.required' => 'el nombre es obligatorio',
                   'rol.required' => 'el rol de usuario es obligatorio',
                   'telefono.numeric' => 'el telefono debe contener solo numeros',
                   'password.min' => 'El password debe tener al menos 5 caracteres',
    	           'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];
    	  
    	$validator = Validator::make( $request->all(),$reglas,$mensajes );
    	if( $validator->fails() ){ 
          
    	  	return view("usuarios.form_nuevo_usuario")->withErrors($validator)
                                                      ->withInput($request->flash());         
    	}
        

      	$usuario=new User;
      	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
        $usuario->telefono=$request->input("telefono");
        $usuario->identificacion=$request->input("identificacion");
        $usuario->tipo=1;
        $rolsel=$request->input("rol")?$request->input("rol"):0;
        if($rolsel>0 and $rolsel<5){  }else{  return 'el valor del rol no es permitido'; }
        $usuario->rol=$rolsel;
    	$usuario->email=$request->input("email");
        $usuario->password= Hash::make($request->input('password','niltonpruebas'));
        $usuario->estado=1;
      
        if($usuario->save())
        {
            return view("usuarios.mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente");
        }
        else
        {
            return view("usuarios.mensajes.msj_error")->with("msj","...Hubo un error al agregar ;...") ;
        }
    }


    public function informacion_usuario($id){
      //presenta los detalles e info del usuario
        $usuario_actual= Auth::user();
        if( $usuario_actual->rol!=1 ){  
          return view("mensajes.msj_no_autorizado")
                ->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        $usuariosel=User::find($id);
        if($usuariosel){

             return view("usuarios.informacion_usuario")->with('usuario',$usuariosel);
        }
        else{
             return redirect('usuarios');
        }


    }


    public function editar_usuario(Request $request){
      //actualizar los datos del usuario
      $usuario_actual= Auth::user();
      if( $usuario_actual->rol!=1 ){  return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); }
              
        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);

    	  $usuario->nombres=strtoupper( $request->input("nombres") ) ;
        $usuario->telefono=$request->input("telefono") ?  $request->input("telefono"):000;
        $rolsel=$request->input("rol") ?  $request->input("rol"):0;
        if($rolsel>0 and $rolsel<3){  }else{  return 'el valor del rol no es permitido'; }
        $usuario->rol=$rolsel;
    
    	 
        if( $usuario->save()){
            return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id ], 200);
        }
        else
        {
    		return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }
    }


    public function editar_acceso(Request $request){
       //permite cambiar la clave de acceso al sistema
             
        $usuario_actual= Auth::user();
        if( $usuario_actual->rol!=1 ){  
          return view("mensajes.msj_no_autorizado")
                 ->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }
             
        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);
        //$usuario->email=$request->input("email");
        $usuario->password=  Hash::make($request->input('password','pruebas123'));
             
        if( $usuario->save()){
            return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id ]);
        }
        else
        {
            return response()->json([ 'estado' => 'error', 'idusuario' => 0 ]);
        }
    }


    public function form_editar_imagen($id_usuario){
        //carga el formulario para agregar una nueva imagen de usuario
        $usuario_actual=Auth::user();
     
        if( $usuario_actual->rol!=1 ){  
            return view("mensajes.msj_no_autorizado")
            ->with("msj","no tiene autorizacion para acceder a esta seccion"); 
        }

        $usuario=User::find( $id_usuario);
        if(!$usuario){ return "usuario seleccionado no existe"; }
       
        return view("usuarios.form_editar_imagen")
               ->with("usuario",  $usuario);

    }

    public function editar_imagen(Request $request){
        
        $usuario_actual= Auth::user();
        if( $usuario_actual->rol!=1 ){  return view("mensajes.msj_no_autorizado")->with("msj","no tiene autorizacion para acceder a esta seccion"); }
       
        $file = $request->file('photo');
       
        $id_usuario = $request->input('id_usuario');
        $code=rand(1, 1000);
        
        $rutafinal='cuentas/usuarios/'.$id_usuario.'/imagen_'.$id_usuario.'_'.$code.'.'.$file->extension();
        $nombrefile='imagen_'.$id_usuario.'_'.$code.'.'.$file->extension();
        
         Storage::disk('public')->put($rutafinal,  file_get_contents($file)  );
         $usuario=User::find( $id_usuario);
         $usuario->foto=$nombrefile;

     
       
        if( $usuario->save()){
             
            return response()->json([ 'estado' => 'actualizado', 'idusuario' => $usuario->id, 'url_imagen'=> $rutafinal ]);
        }
        else
        {
        return response()->json([ 'estado' => 'error', 'idusuario' => 0, 'url_imagen'=> '' ]);
        }
        
       
      
    }

    public function mostrar_imagen($id_usuario,$filename){

      $path = storage_path() . '/app/public/cuentas/usuarios/'.$id_usuario.'/'.$filename;

      if(!File::exists($path)) abort(404);

      $file = File::get($path);
      $type = File::mimeType($path);

      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);
      return $response;

    }


    public function buscar_usuario(Request $request){
    	$dato=$request->input("dato_buscado");
    	$usuarios=User::where("name","like","%".$dato."%")->orwhere("apellidos","like","%".$dato."%")                                              ->paginate(100);
    	return view('listados.listado_usuarios')->with("usuarios",$usuarios);
    }




}

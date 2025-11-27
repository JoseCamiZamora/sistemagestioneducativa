<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/blogi', function () {
    
   return dd('camilo');
});


Route::post('/registro_usuario', 'AccesoController@registro_usuario');
Route::get('/form_reset_password', 'AccesoController@form_reset_password');
Route::post('/recuperar_password', 'AccesoController@recuperar_password');
Route::post('/login_externo', 'AccesoController@login_externo');
Route::get('/politicas', 'AccesoController@politicas');
Route::get('/email_leido/{idemail}', 'AccesoController@email_revisado');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	
	
   Route::get('/home', 'HomeController@index');
   Route::get('/logout', 'AccesoController@logout');
   Route::get('/usuarios', 'UsuariosController@listado_usuarios');
   Route::get('/form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
   Route::post('/crear_usuario', 'UsuariosController@crear_usuario');
   Route::get('/informacion_usuario/{id_usuario}', 'UsuariosController@informacion_usuario');
   Route::post('/editar_usuario', 'UsuariosController@editar_usuario');
   Route::post('/editar_acceso', 'UsuariosController@editar_acceso');
   Route::get('/form_editar_imagen/{id_usuario}', 'UsuariosController@form_editar_imagen');
   Route::post('/editar_imagen', 'UsuariosController@editar_imagen');
   Route::get('/mostrar_imagen/{id_usuario}/{filename}', 'UsuariosController@mostrar_imagen');

   // Rutas para modulo de estudiantes
   Route::get('/estudiantes/listado_estudiantes', 'EstudiantesController@listado_estudiantes');
   Route::get('/estudiantes/listado_estudiantes_i', 'EstudiantesController@listado_estudiantes_i');
   Route::get('/estudiantes/form_nuevo_estudiante', 'EstudiantesController@form_nuevo_estudiante');
   Route::post('/estudiantes/crear_estudiante', 'EstudiantesController@crear_estudiante');
   Route::get('/estudiantes/frm_info_estudiante/{id_estudiante}', 'EstudiantesController@frm_info_estudiante');
   Route::get('/estudiantes/frm_editar_estudiante/{id_estudiante}', 'EstudiantesController@frm_editar_estudiante');
   Route::post('/estudiantes/editar_estudiante', 'EstudiantesController@editar_estudiante');
   Route::post('/estudiantes/buscar_estudiantes', 'EstudiantesController@buscar_estudiantes');
   Route::get('/estudiantes/listado_estudiantes_filtro/{idAnio}/{idGrado}', 'EstudiantesController@listado_estudiantes_filtro');
   Route::get('/estudiantes/inactivarEstudiante/{id_estudiante}', 'EstudiantesController@inactivarEstudiante');
   Route::get('/estudiantes/activarEstudiante/{id_estudiante}', 'EstudiantesController@activarEstudiante');
   

   // Rutas para docentes
   Route::get('/docentes/listado_docentes', 'DocentesController@listado_docentes');
   Route::get('/docentes/form_nuevo_docente', 'DocentesController@form_nuevo_docente');
   Route::post('/docentes/crear_docente', 'DocentesController@crear_docente');
   Route::get('/docentes/frm_editar_docente/{id_docente}', 'DocentesController@frm_editar_docente');
   Route::post('/docentes/editar_docente', 'DocentesController@editar_docente');
   Route::get('/docentes/frm_clases_docente/{id_docente}', 'DocentesController@frm_clases_docente');
   Route::post('/docentes/adicionar_clases_docente', 'DocentesController@adicionar_clases_docente');
   Route::get('/docentes/borrar_clase_docente/{idClase?}', 'DocentesController@borrar_clase_docente');
   Route::get('/docentes/frm_director_grupo/{id_docente}', 'DocentesController@frm_director_grupo');
   Route::post('/docentes/adicionar_director_grupo', 'DocentesController@adicionar_director_grupo');
   Route::get('/docentes/borrar_director_grupo/{id_docente}', 'DocentesController@borrar_director_grupo');
   
   // Rutas Configuracion

   Route::get('/configuracion/index_configuracion', 'ConfiguracionController@index_configuracion');
   Route::get('/configuracion/listado_cursos', 'ConfiguracionController@listado_cursos');
   Route::get('/configuracion/listado_anios', 'ConfiguracionController@listado_anios');
   Route::post('/configuracion/crear_anio', 'ConfiguracionController@crear_anio');
   Route::get('/configuracion/frm_editar_anio/{idAnio?}', 'ConfiguracionController@frm_editar_anio');
   Route::post('/configuracion/editar_anio', 'ConfiguracionController@editar_anio');
   
   Route::get('/configuracion/listado_materias', 'ConfiguracionController@listado_materias');
   Route::get('/configuracion/form_nuevo_anio', 'ConfiguracionController@form_nuevo_anio');
   Route::get('/configuracion/form_nuevo_materia', 'ConfiguracionController@form_nuevo_materia');
   Route::post('/configuracion/crear_matria', 'ConfiguracionController@crear_matria');
   Route::get('/configuracion/frm_editar_materia/{idMateria?}', 'ConfiguracionController@frm_editar_materia');
   Route::get('/configuracion/borrar_materia/{idMateria?}', 'ConfiguracionController@borrar_materia');
   Route::post('/configuracion/editar_materia', 'ConfiguracionController@editar_materia');

   Route::get('/configuracion/listado_actividades', 'ConfiguracionController@listado_actividades');
   Route::get('/configuracion/form_nueva_activdad', 'ConfiguracionController@form_nueva_activdad');
   Route::post('/configuracion/crear_actividad', 'ConfiguracionController@crear_actividad');
   Route::get('/configuracion/frm_editar_actividad/{idActividad?}', 'ConfiguracionController@frm_editar_actividad');
   Route::post('/configuracion/editar_actividad', 'ConfiguracionController@editar_actividad');
   Route::get('/configuracion/borrar_actividad/{idActividad?}', 'ConfiguracionController@borrar_actividad');

   Route::get('/configuracion/listado_periodos', 'ConfiguracionController@listado_periodos');
   Route::get('/configuracion/form_nuevo_periodo', 'ConfiguracionController@form_nuevo_periodo');
   Route::post('/configuracion/crear_periodo', 'ConfiguracionController@crear_periodo');
   Route::get('/configuracion/frm_editar_periodo/{idPeriodo?}', 'ConfiguracionController@frm_editar_periodo');
   Route::post('/configuracion/editar_periodo', 'ConfiguracionController@editar_periodo');
   Route::get('/configuracion/borrar_periodo/{idPeriodo?}', 'ConfiguracionController@borrar_periodo');

   Route::get('/configuracion/listado_cursos', 'ConfiguracionController@listado_cursos');
   Route::get('/configuracion/form_nuevo_curso', 'ConfiguracionController@form_nuevo_curso');
   Route::post('/configuracion/crear_curso', 'ConfiguracionController@crear_curso');
   Route::get('/configuracion/frm_editar_curso/{idCurso?}', 'ConfiguracionController@frm_editar_curso');
   Route::post('/configuracion/editar_curso', 'ConfiguracionController@editar_curso');
   Route::get('/configuracion/borrar_curso/{idCurso?}', 'ConfiguracionController@borrar_curso');

   Route::get('/configuracion/listado_clasificacion', 'ConfiguracionController@listado_clasificacion');
   Route::get('/configuracion/form_nueva_clasificacion', 'ConfiguracionController@form_nueva_clasificacion');
   Route::post('/configuracion/crear_clasificacion', 'ConfiguracionController@crear_clasificacion');
   Route::get('/configuracion/frm_editar_clasificacion/{idClasificacion?}', 'ConfiguracionController@frm_editar_clasificacion');
   Route::post('/configuracion/editar_clasificacion', 'ConfiguracionController@editar_clasificacion');
   Route::get('/configuracion/borrar_clasificacion/{idClasificacion?}', 'ConfiguracionController@borrar_clasificacion');

   Route::get('/configuracion/listado_docentes', 'ConfiguracionController@listado_docentes');
   Route::get('/configuracion/listado_estudiantes', 'ConfiguracionController@listado_estudiantes');
   Route::get('/configuracion/frm_asociar_curso/{idEstudiante?}', 'ConfiguracionController@frm_asociar_curso');
   Route::get('/configuracion/consultar_lista_anios/{idDocente?}/{idAnio?}', 'ConfiguracionController@consultar_lista_anios');
   Route::get('/configuracion/validar_curso_asociado/{idAnio?}/{idCurso?}/{idEstudiante?}', 'ConfiguracionController@validar_curso_asociado');
   Route::post('/configuracion/adicionar_curso_estudiante', 'ConfiguracionController@adicionar_curso_estudiante');
   Route::get('/configuracion/consultar_lista_director_grupo/{idDocente?}/{idAnio?}', 'ConfiguracionController@consultar_lista_director_grupo');

   Route::get('/configuracion/listado_conceptos', 'ConfiguracionController@listado_conceptos');
   Route::get('/configuracion/form_nuevo_concepto', 'ConfiguracionController@form_nuevo_concepto');
   Route::get('/configuracion/info_materia_docente/{idAnio?}/{idDocente?}', 'ConfiguracionController@info_materia_docente');
   Route::get('/configuracion/info_cursos_docente/{idAnio?}/{idDocente?}/{idMateria?}', 'ConfiguracionController@info_cursos_docente');
   Route::post('/configuracion/nuevo_concepto', 'ConfiguracionController@nuevo_concepto');
   Route::get('/configuracion/frm_editar_concepto/{idConcepto?}', 'ConfiguracionController@frm_editar_concepto');
   Route::get('/configuracion/borrar_concepto/{idConcepto?}', 'ConfiguracionController@borrar_concepto');
   Route::post('/configuracion/editar_concepto', 'ConfiguracionController@editar_concepto');
   Route::get('/configuracion/index_conceptos', 'ConfiguracionController@index_conceptos');

   Route::get('/configuracion/listado_concepto_comportamiento', 'ConfiguracionController@listado_concepto_comportamiento');
   Route::get('/configuracion/form_nuevo_concepto_comp', 'ConfiguracionController@form_nuevo_concepto_comp');
   Route::post('/configuracion/nuevo_concepto_comp', 'ConfiguracionController@nuevo_concepto_comp');
   Route::get('/configuracion/frm_editar_concepto_comp/{idConcepto?}', 'ConfiguracionController@frm_editar_concepto_comp');
   Route::post('/configuracion/editar_concepto_comp', 'ConfiguracionController@editar_concepto_comp');
   Route::get('/configuracion/borrar_concepto_comp/{idConcepto?}', 'ConfiguracionController@borrar_concepto_comp');

   Route::get('/configuracion/listado_conceptos_trans', 'ConfiguracionController@listado_conceptos_trans');
   Route::get('/configuracion/form_nuevo_concepto_trans', 'ConfiguracionController@form_nuevo_concepto_trans');
   Route::post('/configuracion/nuevo_concepto_trans', 'ConfiguracionController@nuevo_concepto_trans');
   Route::get('/configuracion/frm_editar_concepto_trans/{idConcepto?}', 'ConfiguracionController@frm_editar_concepto_trans');
   Route::post('/configuracion/editar_concepto_trans', 'ConfiguracionController@editar_concepto_trans');
   Route::get('/configuracion/borrar_concepto_trans/{idConcepto?}', 'ConfiguracionController@borrar_concepto_trans');

   Route::get('/configuracion/listado_dimensiones', 'ConfiguracionController@listado_dimensiones');
   Route::get('/configuracion/form_nueva_dimension', 'ConfiguracionController@form_nueva_dimension');
   Route::post('/configuracion/nueva_dimension', 'ConfiguracionController@nueva_dimension');
   Route::get('/configuracion/frm_editar_dimension/{idDimencion?}', 'ConfiguracionController@frm_editar_dimension');
   Route::post('/configuracion/editar_dimension', 'ConfiguracionController@editar_dimension');
   Route::get('/configuracion/borrar_dimension/{idDimension?}', 'ConfiguracionController@borrar_dimension');

 
   
   
   
   
   

   

   
   

   // Rutas Evaluacion

   Route::get('/evaluacion/listado_anios_evaluacion', 'EvaluacionController@listado_anios_evaluacion');
   Route::get('/evaluacion/listado_periodos_evaluar/{id_anio?}', 'EvaluacionController@listado_periodos_evaluar');
   Route::get('/evaluacion/listado_materias_configuradas/{id_persona?}/{id_anio?}', 'EvaluacionController@listado_materias_configuradas');
   Route::get('/evaluacion/listado_cursos_configurados/{id_curso?}', 'EvaluacionController@listado_cursos_configurados');
   Route::get('/evaluacion/listado_estudiantes_configurados/{id_curso?}/{id_clase}', 'EvaluacionController@listado_estudiantes_configurados');
   Route::get('/evaluacion/form_evaluacion/{id_estudiante?}/{id_clase?}', 'EvaluacionController@form_evaluacion');
   Route::get('/evaluacion/form_evaluacion_transicion/{id_estudiante?}/{periodo?}', 'EvaluacionController@form_evaluacion_transicion');
   Route::post('/evaluacion/crear_evaluacion_estudiante', 'EvaluacionController@crear_evaluacion_estudiante');
   Route::get('/evaluacion/consultar_evaluacion/{id_periodo?}/{id_estudiante?}/{id_clase?}', 'EvaluacionController@consultar_evaluacion');
   Route::get('/evaluacion/listado_estudiantes_configurados_t/{id_curso?}/{id_anio?}', 'EvaluacionController@listado_estudiantes_configurados_t');
   Route::get('/evaluacion/consultar_evaluacion_transicion/{id_periodo?}/{id_estudiante?}', 'EvaluacionController@consultar_evaluacion_transicion');
   Route::post('/evaluacion/crear_evaluacion_transicion', 'EvaluacionController@crear_evaluacion_transicion');
   Route::get('/evaluacion/listado_estudiantes_evaluar/{id_persona?}/{id_anio?}', 'EvaluacionController@listado_estudiantes_evaluar');
   Route::get('/evaluacion/form_evaluacion_comportamiento/{id_estudiante?}/{id_clase?}', 'EvaluacionController@form_evaluacion_comportamiento');
   Route::get('/evaluacion/consultar_evaluacion_comportamiento/{id_periodo?}/{id_estudiante?}/{id_clase?}', 'EvaluacionController@consultar_evaluacion_comportamiento');
   Route::post('/evaluacion/crear_evaluacion_comportamiento', 'EvaluacionController@crear_evaluacion_comportamiento');
   Route::get('/evaluacion/listado_estudiantes_transicion/{id_persona?}/{id_anio?}/{clasificacion?}', 'EvaluacionController@listado_estudiantes_transicion');
   Route::get('/evaluacion/form_generar_concepto_transicion/{id_estudiante?}/{id_clase?}', 'EvaluacionController@form_generar_concepto_transicion');
   Route::get('/evaluacion/consultar_evaluacion_materias_transicion/{id_periodo?}/{id_estudiante?}', 'EvaluacionController@consultar_evaluacion_materias_transicion');
   Route::post('/evaluacion/crear_concepto_transicion', 'EvaluacionController@crear_concepto_transicion');
   Route::get('/evaluacion/listado_estudiantes_evaluar_transicion/{id_persona?}/{id_anio?}', 'EvaluacionController@listado_estudiantes_evaluar_transicion');
   Route::get('/evaluacion/form_evaluacion_comportamiento_transicion/{id_estudiante?}/{id_clase?}', 'EvaluacionController@form_evaluacion_comportamiento_transicion');
   Route::post('/evaluacion/crear_evaluacion_comportamiento_transicion', 'EvaluacionController@crear_evaluacion_comportamiento_transicion');
   Route::get('/evaluacion/generar_observacion_periodo/{id_persona?}/{id_anio?}/{estado?}', 'EvaluacionController@generar_observacion_periodo');
   Route::get('/evaluacion/form_generar_observacion_final/{idEstudiante?}/{idCurso?}/{idAnio?}', 'EvaluacionController@form_generar_observacion_final');
   Route::post('/evaluacion/crear_observacion_final', 'EvaluacionController@crear_observacion_final');
   Route::get('/evaluacion/consultar_observacion_periodo/{idEstudiante?}/{idAnio?}/{idDirectorGrupo?}/{idPeriodo?}', 'EvaluacionController@consultar_observacion_periodo');
   Route::get('/evaluacion/form_materias_evaluadas/{idEstudiante?}/{idPeriodo?}/{idAnio?}', 'EvaluacionController@form_materias_evaluadas');
   Route::get('/evaluacion/index_periodos_transicion/{anio?}/{idEstudiante?}', 'EvaluacionController@index_periodos_transicion');
   Route::get('/evaluacion/form_concepto_final/{id_estudiante?}/{id_clase?}/{id_curso?}', 'EvaluacionController@form_concepto_final');
   Route::get('/evaluacion/form_concepto_final_comportamiento/{id_estudiante?}/{id_curso?}', 'EvaluacionController@form_concepto_final_comportamiento');
   Route::post('/evaluacion/crear_concepto_final', 'EvaluacionController@crear_concepto_final');
   Route::post('/evaluacion/crear_concepto_final_comp', 'EvaluacionController@crear_concepto_final_comp');
   Route::get('/evaluacion/form_obs_final/{id_estudiante?}/{id_anio?}/{id_director?}', 'EvaluacionController@form_obs_final');
   Route::post('/evaluacion/crear_observacion_final_rep', 'EvaluacionController@crear_observacion_final_rep');
   
   
   // Rutas Inforermes

   Route::get('/informes/index_reportes', 'InformesController@index_reportes');
   Route::get('/informes/form_generar_reporte_notas', 'InformesController@form_generar_reporte_notas');
   Route::get('/informes/form_generar_reporte_estudaintes', 'InformesController@form_generar_reporte_estudaintes');
   Route::get('/informes/pdf_infomre_periodo/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_periodo');
   Route::get('/informes/pdf_infomre_periodo_dos/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_periodo_dos');
   Route::get('/informes/pdf_infomre_periodo_tres/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_periodo_tres');
   Route::get('/informes/pdf_infomre_periodo_transicion/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_periodo_transicion');
   Route::get('/informes/pdf_informe_director_grupo/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_informe_director_grupo');
   Route::get('/informes/pdf_infomre_certificado_notas_periodo/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_certificado_notas_periodo');
   Route::get('/informes/pdf_infomre_certificado_notas_periodo_dos/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_certificado_notas_periodo_dos');
   Route::get('/informes/pdf_infomre_certificado_notas_periodo_tres/{idCurso?}/{idAnio?}/{idPeriodo?}', 'InformesController@pdf_infomre_certificado_notas_periodo_tres');
   Route::get('/informes/info_estudiantes_cursos/{idAnio?}/{idCurso?}', 'InformesController@info_estudiantes_cursos');
   Route::get('/informes/pdf_infomre_periodo_estudiante/{idCurso?}/{idAnio?}/{idPeriodo?}/{idEstudiante?}', 'InformesController@pdf_infomre_periodo_estudiante');
   Route::get('/informes/pdf_infomre_cetirficado_estudiante/{idCurso?}/{idAnio?}/{idPeriodo?}/{idEstudiante?}', 'InformesController@pdf_infomre_cetirficado_estudiante');
   Route::get('/informes/pdf_infomre_constancia_estudiante/{idCurso?}/{idAnio?}/{idEstudiante?}', 'InformesController@pdf_infomre_constancia_estudiante');
   
   
   

   // rutas estadisticas
   Route::get('/estadisticas/index_estadisticas', 'EstadisticasController@index_estadisticas');
   Route::get('/estadisticas/reporte_estudiantes_excel_materias/{anio?}/{curso?}/{periodo?}', 'EstadisticasController@reporte_estudiantes_excel_materias');

   
   
   
});





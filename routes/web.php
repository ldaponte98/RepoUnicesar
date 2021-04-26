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
    return view('login.index');
})->name('index');




Route::any('index','UsuarioController@login')->name('usuario/login');
Route::get('registro','UsuarioController@registro')->name('registro');
Route::post('validar_registro','UsuarioController@validar_registro')->name('validar_registro');
Route::get('usuario/logout','UsuarioController@logout')->name('logout');
Route::get('panel','UsuarioController@panel')->name('panel');
Route::get('email/email_retraso',function () {
    return view('email.email_retraso');
})->name('email/email_retraso');

Route::get('email/email_formato_revisado',function () {
    return view('email.email_formato_revisado');
})->name('email/email_formato_revisado');

//RUTAS DOCENTE
Route::get('docente/listado_docentes','TerceroController@getDocentes')->name('docente/listado_docentes');
Route::get('docente/view/{id}','TerceroController@viewDocente')->name('docente/view');
Route::any('docente/horario/{id}','TerceroController@viewHorario')->name('docente/horario');
Route::any('docente/update_image/{id_tercero}','TerceroController@updateImageDocente')->name('docente/update_image');
Route::get('docente/buscar_asignaturas/{id_periodo_academico}/{id_tercero}','TerceroController@buscarAsignaturas')->name('docente/buscar_asignaturas');
Route::get('docente/filtrar/{caracteres}','TerceroController@filtrar')->name('docente/filtrar');
Route::get('docente/view_formato/{tipo_formato}/{id_tercero}','TerceroController@view_formato')->name('docente/view_formato');


Route::post('tercero/marcarFormatosComoLeido','TerceroController@marcarFormatosComoLeido')->name('tercero/marcarFormatosComoLeido');

Route::any('alumno/panel','TerceroController@panel')->name('alumno/panel');
Route::any('alumno/agregar_clase/{codigo_acceso}','TerceroController@agregar_clase')->name('alumno/agregar_clase');

Route::any('clases/panel/{id_grupo}','ClaseController@panel')->name('clases/panel');
Route::any('clases/mis_clases','ClaseController@clases_docente')->name('clases/mis_clases');
Route::post('clases/buscar_clases','ClaseController@buscar_clases')->name('clases/buscar_clases');
Route::any('clases/gestion','ClaseController@gestion')->name('clases/gestion');
Route::any('clases/view/{id_clase}','ClaseController@view')->name('clases/view');
Route::any('clases/gestionar_asistencia/{id_clase}','ClaseController@gestionar_asistencia')->name('clases/gestionar_asistencia');


//RUTAS ASIGNATURA
Route::get('asignatura/listado_asignaturas','AsignaturaController@getAsignaturas')->name('asignatura/listado_asignaturas');
Route::get('asignatura/view/{id}','AsignaturaController@viewAsignatura')->name('asignatura/view');
Route::get('asignatura/buscar_grupos/{id}','AsignaturaController@buscarGrupos')->name('asignatura/buscar_grupos');
Route::get('asignatura/buscar_grupos_docente/{id_asignatura}/{id_tercero}/{id_periodo_academico}','AsignaturaController@buscar_grupos_docente')->name('asignatura/buscar_grupos_docente');
Route::post('asignatura/agregar_unidad','AsignaturaController@agregarUnidad')->name('asignatura/agregar_unidad');
Route::post('asignatura/agregar_eje','AsignaturaController@agregarEje')->name('asignatura/agregar_eje');
Route::get('asignatura/get_unidades/{id}','AsignaturaController@getUnidades')->name('asignatura/get_unidades');
Route::get('asignatura/eliminar_unidad/{id}','AsignaturaController@eliminarUnidad')->name('asignatura/eliminar_unidad');
Route::get('asignatura/eliminar_eje/{id}','AsignaturaController@eliminarEje')->name('asignatura/eliminar_eje');



//RUTAS GRUPO
Route::post('grupo/buscar','GrupoController@buscar')->name('grupo/buscar');



//RUTAS NOTIFICACIONES
Route::any('notificacion/crear','NotificacionesController@crear')->name('notificacion/crear');
Route::any('notificacion/mis_notificaciones','NotificacionesController@listar_mis_notificaciones')->name('notificacion/mis_notificaciones');
Route::get('notificacion/ver_notificacion/{id_notificacion}','NotificacionesController@ver_notificacion')->name('notificacion/ver_notificacion');



//RUTAS SEGUIMIENTO
Route::get('seguimiento/consultar','SeguimientoAsignaturaController@listar')->name('seguimiento/consultar');
Route::get('seguimiento/consultar_informe_final','SeguimientoAsignaturaController@listarInformeFinal')->name('seguimiento/consultar_informe_final');
Route::any('seguimiento/editar/{id}','SeguimientoAsignaturaController@editar')->name('seguimiento/editar');
Route::get('seguimiento/view/{id}','SeguimientoAsignaturaController@view')->name('seguimiento/view');
Route::get('seguimiento/view_informe_final/{id}','SeguimientoAsignaturaController@viewInformeFinal')->name('seguimiento/view_informe_final');
Route::post('seguimiento/marcarComoLeido','SeguimientoAsignaturaController@marcarComoLeido')->name('seguimiento/marcarComoLeido');
Route::any('seguimiento/getReporte','SeguimientoAsignaturaController@getReporte')->name('seguimiento/getReporte');
Route::any('seguimiento/getReporteInformeFinal','SeguimientoAsignaturaController@getReporteInformeFinal')->name('seguimiento/getReporteInformeFinal');
Route::get('seguimiento/getEjesTematicos/{id}/{id_seguimiento}','SeguimientoAsignaturaController@getEjesTematicos')->name('seguimiento/getEjesTematicos');
Route::get('seguimiento/getSeguimiento/{id}','SeguimientoAsignaturaController@getSeguimiento')->name('seguimiento/getSeguimiento');
Route::get('seguimiento/imprimir/{id}','SeguimientoAsignaturaController@imprimir')->name('seguimiento/imprimir');
Route::get('seguimiento/view_imprimir/{id}','SeguimientoAsignaturaController@imprimir_prueba')->name('seguimiento/view_imprimir');

Route::get('seguimiento/imprimir_informe_final/{id}','SeguimientoAsignaturaController@imprimir_informe_final')->name('seguimiento/imprimir_informe_final');
Route::get('seguimiento/imprimir_informe_final_prueba/{id}','SeguimientoAsignaturaController@imprimir_informe_final_prueba')->name('seguimiento/imprimir_informe_final_prueba');

//RUTAS FECHAS
Route::any('fechas/fechas_de_entrega','FechasEntregaController@index')->name('fechas/fechas_de_entrega');
Route::any('fechas/editar_fechas_de_entrega/{periodo}/{formato}','FechasEntregaController@editar')->name('fechas/editar_fechas_de_entrega');
Route::any('fechas/plazo_extra_por_docente','FechasEntregaController@plazo_extra')->name('fechas/plazo_extra_por_docente');



//RUTAS PLAZO_DOCENTE
Route::post('plazo_docente/registrar','PlazoDocenteController@registrar')->name('plazo_docente/registrar');
Route::post('plazo_docente/actualizar','PlazoDocenteController@actualizar')->name('plazo_docente/actualizar');
Route::get('plazo_docente/buscar/{id_plazo}','PlazoDocenteController@buscar')->name('plazo_docente/buscar');
Route::get('plazo_docente/cancelar/{id_plazo}','PlazoDocenteController@cancelar')->name('plazo_docente/cancelar');


//RUTAS PLAN DE TRABAJO
Route::any('plan_trabajo/view','PlanTrabajoController@view')->name('plan_trabajo/view');
Route::any('plan_trabajo/editar','PlanTrabajoController@editar')->name('plan_trabajo/editar');
Route::get('plan_trabajo/consultar','PlanTrabajoController@listar')->name('plan_trabajo/consultar');
Route::any('plan_trabajo/getReporte','PlanTrabajoController@getReporte')->name('plan_trabajo/getReporte');
Route::get('plan_trabajo/imprimir/{id}','PlanTrabajoController@imprimir')->name('plan_trabajo/imprimir');

//RUTAS ACTIVIDADES COMPLEMENTARIAS
Route::get('actividades_complementarias/consultar','ActividadesComplementariasController@listar')->name('actividades_complementarias/consultar');
Route::any('actividades_complementarias/getReporte','ActividadesComplementariasController@getReporte')->name('actividades_complementarias/getReporte');
Route::any('actividades_complementarias/editar/{id}','ActividadesComplementariasController@editar')->name('actividades_complementarias/editar');
Route::any('actividades_complementarias/editar_detalle/{id_actividad}/{id_tipo_actividad}','ActividadesComplementariasController@editar_detalle')->name('actividades_complementarias/editar_detalle');
Route::any('actividades_complementarias/guardar_detalles','ActividadesComplementariasController@guardar_detalles')->name('actividades_complementarias/guardar_detalles');
Route::get('actividades_complementarias/enviar_formato/{id}','ActividadesComplementariasController@enviar_formato')->name('actividades_complementarias/enviar_formato');
Route::any('actividades_complementarias/imprimir/{id_actividad}/{id_actividad_plan_trabajo}','ActividadesComplementariasController@imprimir')->name('actividades_complementarias/imprimir');

//RUTAS PLAN ASIGNATURA
Route::get('plan_asignatura/buscar_asignatura',function () {
    return view('plan_asignatura.buscar_asignatura');
})->name('plan_asignatura/buscar_asignatura');
Route::get('plan_asignatura/consultar_desde_docente',function () {
    return view('plan_asignatura.consultar_desde_docente');
})->name('plan_asignatura/consultar_desde_docente');
Route::get('plan_asignatura/view/{id_asignatura}/{id_periodo_academico}','PlanAsignaturaController@view')->name('plan_asignatura/view');
Route::post('plan_asignatura/editar','PlanAsignaturaController@editar')->name('plan_asignatura/editar');
Route::get('plan_asignatura/imprimir/{id_plan_asignatura}','PlanAsignaturaController@imprimir')->name('plan_asignatura/imprimir');
Route::post('plan_asignatura/cargar_plan_existente','PlanAsignaturaController@cargar_plan_existente')->name('plan_asignatura/cargar_plan_existente');
Route::get('plan_asignatura/obtener_vista/{id_plan_asignatura}','PlanAsignaturaController@obtener_vista')->name('plan_asignatura/obtener_vista');

//RUTAS PLAN DESARROLLO ASIGNATURA
Route::get('plan_desarrollo_asignatura/consultar_desde_docente',function () {
    return view('plan_desarrollo_asignatura.consultar_desde_docente');
})->name('plan_desarrollo_asignatura/consultar_desde_docente');
Route::get('plan_desarrollo_asignatura/consultar',function () {
    return view('plan_desarrollo_asignatura.consultar');
})->name('plan_desarrollo_asignatura/consultar');
Route::get('plan_desarrollo_asignatura/view/{id_tercero}/{id_asignatura}/{id_periodo_academico}','PlanDesarrolloAsignaturaController@view')->name('plan_desarrollo_asignatura/view');
Route::post('plan_desarrollo_asignatura/obtener_fecha_sugerida','PlanDesarrolloAsignaturaController@obtener_fecha_sugerida')->name('plan_desarrollo_asignatura/obtener_fecha_sugerida');
Route::post('plan_desarrollo_asignatura/editar','PlanDesarrolloAsignaturaController@editar')->name('plan_desarrollo_asignatura/editar');
Route::get('plan_desarrollo_asignatura/imprimir/{id_plan_desarrollo_asignatura}','PlanDesarrolloAsignaturaController@imprimir')->name('plan_desarrollo_asignatura/imprimir');
Route::post('plan_desarrollo_asignatura/cargar_plan_existente','PlanDesarrolloAsignaturaController@cargar_plan_existente')->name('plan_desarrollo_asignatura/cargar_plan_existente');
Route::get('plan_desarrollo_asignatura/obtener_vista/{id_plan_desarrollo_asignatura}','PlanDesarrolloAsignaturaController@obtener_vista')->name('plan_desarrollo_asignatura/obtener_vista');
Route::get('plan_desarrollo_asignatura/consultar_general','PlanDesarrolloAsignaturaController@consultar_general')->name('plan_desarrollo_asignatura/consultar_general');
Route::post('plan_desarrollo_asignatura/getReporte','PlanDesarrolloAsignaturaController@getReporte')->name('plan_desarrollo_asignatura/getReporte');
Route::post('plan_desarrollo_asignatura/obtener_temas','PlanDesarrolloAsignaturaController@obtener_temas')->name('plan_desarrollo_asignatura/obtener_temas');




//RUTAS PARA ALIMENTAR DESDE ACADEMUSOFT
Route::any('comunication/updateFacultades','ComunicationController@updateFacultades')->name('comunication/updateFacultades');
Route::any('comunication/updateProgramasAcademicos','ComunicationController@updateProgramasAcademicos')->name('comunication/updateProgramasAcademicos');
Route::any('comunication/updatePeriodosAcademicos','ComunicationController@updatePeriodosAcademicos')->name('comunication/updatePeriodosAcademicos');
Route::any('comunication/updateAsignaturas','ComunicationController@updateAsignaturas')->name('comunication/updateAsignaturas');
Route::any('comunication/auth','ComunicationController@auth')->name('comunication/auth');






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

Route::post('index','UsuarioController@login')->name('usuario/login');
Route::get('usuario/logout','UsuarioController@logout')->name('logout');



//RUTAS DOCENTE
Route::get('docente/listado_docentes','TerceroController@getDocentes')->name('docente/listado_docentes');
Route::get('docente/view/{id}','TerceroController@viewDocente')->name('docente/view');
Route::any('docente/update_image/{id_tercero}','TerceroController@updateImageDocente')->name('docente/update_image');



//RUTAS ASIGNATURA
Route::get('asignatura/listado_asignaturas','AsignaturaController@getAsignaturas')->name('asignatura/listado_asignaturas');
Route::get('asignatura/view/{id}','AsignaturaController@viewAsignatura')->name('asignatura/view');
Route::get('asignatura/buscar_grupos/{id}','AsignaturaController@buscarGrupos')->name('asignatura/buscar_grupos');
Route::post('asignatura/agregar_unidad','AsignaturaController@agregarUnidad')->name('asignatura/agregar_unidad');
Route::post('asignatura/agregar_eje','AsignaturaController@agregarEje')->name('asignatura/agregar_eje');
Route::get('asignatura/get_unidades/{id}','AsignaturaController@getUnidades')->name('asignatura/get_unidades');
Route::get('asignatura/eliminar_unidad/{id}','AsignaturaController@eliminarUnidad')->name('asignatura/eliminar_unidad');
Route::get('asignatura/eliminar_eje/{id}','AsignaturaController@eliminarEje')->name('asignatura/eliminar_eje');



//RUTAS GRUPO
Route::post('grupo/buscar','GrupoController@buscar')->name('grupo/buscar');



//RUTAS NOTIFICACIONES
Route::post('notificacion/crear','NotificacionesController@crear')->name('notificacion/crear');



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







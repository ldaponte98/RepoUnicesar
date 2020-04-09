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


Route::get('docente/listado_docentes','TerceroController@getDocentes')->name('docente/listado_docentes');
Route::get('docente/view/{id}','TerceroController@viewDocente')->name('docente/view');
Route::any('docente/update_image/{id_tercero}','TerceroController@updateImageDocente')->name('docente/update_image');


Route::get('asignatura/listado_asignaturas','AsignaturaController@getAsignaturas')->name('asignatura/listado_asignaturas');
Route::get('asignatura/view/{id}','AsignaturaController@viewAsignatura')->name('asignatura/view');
Route::get('asignatura/buscar_grupos/{id}','AsignaturaController@buscarGrupos')->name('asignatura/buscar_grupos');

Route::post('grupo/buscar','GrupoController@buscar')->name('grupo/buscar');

Route::post('notificacion/crear','NotificacionesController@crear')->name('notificacion/crear');

Route::get('seguimiento/consultar','SeguimientoAsignaturaController@listar')->name('seguimiento/consultar');
Route::any('seguimiento/editar/{id}','SeguimientoAsignaturaController@editar')->name('seguimiento/editar');
Route::get('seguimiento/view/{id}','SeguimientoAsignaturaController@view')->name('seguimiento/view');
Route::post('seguimiento/marcarComoLeido','SeguimientoAsignaturaController@marcarComoLeido')->name('seguimiento/marcarComoLeido');
Route::any('seguimiento/getReporte','SeguimientoAsignaturaController@getReporte')->name('seguimiento/getReporte');
Route::get('seguimiento/getEjesTematicos/{id}','SeguimientoAsignaturaController@getEjesTematicos')->name('seguimiento/getEjesTematicos');
Route::get('seguimiento/getSeguimiento/{id}','SeguimientoAsignaturaController@getSeguimiento')->name('seguimiento/getSeguimiento');
Route::get('seguimiento/imprimir/{id}','SeguimientoAsignaturaController@imprimir')->name('seguimiento/imprimir');
Route::get('seguimiento/view_imprimir/{id}','SeguimientoAsignaturaController@imprimir_prueba')->name('seguimiento/view_imprimir');



Route::any('fechas/fechas_de_entrega','FechasEntregaController@index')->name('fechas/fechas_de_entrega');
Route::any('fechas/editar_fechas_de_entrega/{periodo}/{formato}','FechasEntregaController@editar')->name('fechas/editar_fechas_de_entrega');
Route::any('fechas/plazo_extra_por_docente','FechasEntregaController@plazo_extra')->name('fechas/plazo_extra_por_docente');


Route::post('plazo_docente/registrar','PlazoDocenteController@registrar')->name('plazo_docente/registrar');







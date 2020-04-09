@extends('layouts.main_docente')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp 
@section('header_content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="http://malsup.github.io/jquery.blockUI.js"></script>

<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Seguimiento de asignatura</a></li>
                            <li class="breadcrumb-item active">Realizar formato</li>
                        </ol>
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
                    </div><div class="col-md-2 col-8 align-self-center">
                    </div>
                    <div class="col-md-2 col-8 align-self-center">
                      <br> <br>   
                    <a target="_blank" onclick="cargar_unidades_ejes_causa_analisis_antiguos()" style="color: white; width: 100%;" class="btn pull-rigth hidden-sm-down btn-success">Volver</a>
                    </div>
                </div>
@endsection
@section('content')
{{ Form::open(array(
                                    'id' => 'form-seguimiento',
                                    'class'=>'form-horizontal form-material',
                                    'files' => true))
                                }}
	<div class="row">

                    <!-- Column -->
                    
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                
                                
                                <div class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-sm-12"  style="color: black;"><b>Datos Generales</b></label>
                                        
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-12" style="color: black;">Corte</label>
                                        <div class="col-sm-12">
                                            <select id="cor" class="form-control form-control-line" readonly>
                                                <option value="{{ $seguimiento->corte }}">{{ $seguimiento->corte }}</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="col-sm-12" style="color: black;">Asignatura</label>
                                        <div class="col-sm-12">
                                            <select id="asi" class="form-control form-control-line" readonly  >
                                                <option value="{{ $seguimiento->id_asignatura }}">{{ $seguimiento->asignatura->nombre }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Grupo</label>
                                        <div class="col-md-12">
                                           <select id="gru" class="form-control form-control-line"  >
                                                <option value="{{ $seguimiento->id_grupo }}">{{ $seguimiento->grupo->codigo }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12" style="color: black;">Creditos </label>
                                        <div class="col-sm-12">
                                             <input id="cre" type="text" class="form-control form-control-line " value="{{ $seguimiento->asignatura->num_creditos }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Numero de estudiantes inicial </label>
                                        <div class="col-md-12">
                                            <input id="num_estudiantes_iniciales" value="{{ $seguimiento->grupo->num_est_ini }}" type="number" class="form-control form-control-line" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Numero de estudiantes asistentes <b>*</b></label>
                                        <div class="col-md-12">
                                            <input id="num_estudiantes" name="num_estudiantes" value="{{ $seguimiento->grupo->num_est_ini }}" type="number" class="form-control form-control-line" required="" max="{{ $seguimiento->grupo->num_est_ini }}" min="0" onchange="validar_cantidad_de_estudiantes()">
                                        </div>
                                    </div><div class="form-group">
                                        <label class="col-md-12" style="color: black;">Unidades Programadas</label>
                                        <br><br>
                                        <div class="col-md-12" id="unidades">

                                        	@foreach ($seguimiento->asignatura->unidades as $unidad)
                                        	<input id="unidad_{{ $unidad->id_unidad_asignatura }}" onchange="buscar_ejes({{ $unidad->id_unidad_asignatura }})" style='cursor:hand; margin-left: -.1rem; margin-top: 5px;' class='form-check-input'  style='margin-left: -.25rem;'  value='{{ $unidad->id_unidad_asignatura }}' type='checkbox' >

                                        	<label for ="unidad_{{ $unidad->id_unidad_asignatura }}" style='margin-left: 13;' class='col-md-11'>{{ $unidad->nombre }}</label> <br>
                                        	@endforeach
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Ejes Tematicos Desarrollados</label>
                                        <br><br>
                                        <div class="col-md-12" id="ejes_tematicos">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Porcentaje de desarrollo a la asignatura</label>
                                        <div class="col-md-12">
                                            <input id="porcentaje_desarrollo" name="porcentaje_desarrollo"  type="text" class="form-control form-control-line " value="@php
                                               if($seguimiento->porcentaje_desarrollo){
                                                echo $seguimiento->porcentaje_desarrollo;
                                               }else{
                                                echo '0%';
                                               }
                                            @endphp" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Porcentaje ideal de desarrollo a la fecha</label>
                                        <div class="col-md-12">
                                            <input id="porcentaje_ideal" name="porcentaje_ideal"  type="text" class="form-control form-control-line " placeholder="" readonly  value="@php
                                               if($seguimiento->porcentaje_ideal){
                                                echo $seguimiento->porcentaje_ideal;
                                               }else{
                                                echo '100%';
                                               }
                                            @endphp" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12" style="color: black;">Relacion entre lo real y lo ideal</label>
                                        <div class="col-sm-12">
                                             <input id="relacion_ideal_real" type="text" name="relacion_ideal_real" class="form-control form-control-line " value="@php
                                               if($seguimiento->relacion_ideal_real){
                                                echo $seguimiento->relacion_ideal_real;
                                               }else{
                                                echo 'R=A/B';
                                               }
                                            @endphp" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6  ">
                                    <a  id="btnsubir" target="_blank" href='{{ route('seguimiento/view', $seguimiento->id_seguimiento) }}' class="btn   btn-success" style="color: white;">Ver mi ultimo registro</a>
                                    
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="col-sm-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Si no se cubrio el total de los contenidos programados, indique causas </label>
                                        <br><br>
                                        <div class="col-md-12" id="causas">
                                             <a  id="btnsubir" onclick="$('#modal_nueva_causa').modal('show')" class="btn  btn-info" style="color: white;">+ Agregar otra causa</a><br><br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
                                            class='form-check-input' style='margin-left: -.25rem;'
                                            onchange="seleccionar_causa(1)" id="cau_1" value='Dias Festivos' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Dias Festivos</label> <br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(2)" id="cau_2" value='Deficiencia en comprension de textos' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Deficiencia en comprension de textos</label> <br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(3)" id="cau_3" value='Deficiencias en conocimientos previos' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Deficiencias en conocimientos previos</label> <br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(4)" id="cau_4" value='Tematica extensa' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Tematica extensa</label> <br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(5)" id="cau_5" value='Asignacion tarde de asignatura' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Asignacion tarde de asignatura</label><br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(6)" id="cau_6" value='Poco compromiso de los estudiantes en el trabajo academico' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Poco compromiso de los estudiantes en el trabajo academico</label><br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(7)" id="cau_7" value='Estudiantes con pocas habilidades para las matematicas' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Estudiantes con pocas habilidades para las matematicas</label><br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(8)" id="cau_8" value='El no desarrollo de los contenidos de la asignatura prerrequisito' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>El no desarrollo de los contenidos de la asignatura prerrequisito</label><br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(9)" id="cau_9" value='Falta de salon o laboratorio para desarrollar las clases' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Falta de salon o laboratorio para desarrollar las clases</label><br>
                                            <input style='cursor:hand; margin-left: -.25rem;'
											class='form-check-input' onchange="seleccionar_causa(10)" id="cau_10" value='Dificultad para los estudiantes para comprender temas' type='checkbox' ><label style='margin-left: 13;' class='col-md-11'>Dificultad para los estudiantes para comprender temas</label><br>

                                            <div id="otras_causas">
                                                
                                            </div>


                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-12" id="bodyact"  style="color: black;"><b>Eficiencia Academica</b></label>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Promedio de notas obtentenidas <b>*</b> </label>
                                        <div class="row">
                                           
                                            <div class="col-md-6">
                                            <input id="prom_notas" name="prom_notas" max="5" min="0" step="0.1" type="number" class="form-control form-control-line" onchange="validar_promedio_notas()" style="margin-left: 18px;" value="{{ $seguimiento->prom_notas }}">
                                        </div>
                                        <div class="col-md-5">
                                            <a  id="btnsubir" data-toggle="modal"  data-target="#myModal2" class="btn btn-info pull-left" style="color: white;">   Ingresar Notas  </a>
                                        </div>
                                        </div>
                                        
                                        
                                        
                                    
                                    </div>
                            <div class="row">
                                        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;" >N° Aprobados <b>*</b></label>
                                        <div class="col-md-12">
                                            <input id="aprobados" name="aprobados"  type="number" class="form-control form-control-line " value="{{ $seguimiento->aprobados }}" onchange="establecer_reprobados()">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">N° Reprobados</label>
                                        <div class="col-md-12">
                                            <input id="reprobados" value="{{ $seguimiento->reprobados }}" name="reprobados" type="number" class="form-control form-control-line " readonly  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Analisis cualitativo del comportamiento academico de los estudiantes</label>
                                        <br><br>
                                        <div class="col-md-12">
                                           <div class="col-md-12" id="Analisis">
                                             <a  id="btnsubir" onclick="$('#modal_nuevo_analisis').modal('show')" class="btn  btn-info" style="color: white;">+ Agregar otro analisis</a><br><br>
                                            <input style='margin-left: -.25rem;'
												class='form-check-input' id="ana_1" onchange="seleccionar_analisis(1)" value='Grupo responsable, comprometido con tareas asignadas, asisten a clases y participa de tutorias.' type='checkbox' ><label style="margin-left: 8;" class='col-md-11' >Grupo responsable, comprometido con tareas asignadas, asisten a clases y participa de tutorias.</label> <br>
												                                            <input style='margin-left: -.25rem;'
												class='form-check-input' id="ana_2"  onchange="seleccionar_analisis(2)" value='En su gran mayoria estudiantes responsables participativos y dinamicos en clases.' type='checkbox' ><label style="margin-left: 8;" class='col-md-11'>En su gran mayoria estudiantes responsables participativos y dinamicos en clases.</label> <br>
												                                            <input style='margin-left: -.25rem;'
												class='form-check-input' id="ana_3"  onchange="seleccionar_analisis(3)" value='Grupo apatico a las clases, poco participativos, faltan a clases en muchas ocasiones y no asisten a tutorias.' type='checkbox' ><label style="margin-left: 8;" class='col-md-11'>Grupo apatico a las clases, poco participativos, faltan a clases en muchas ocasiones y no asisten a tutorias.</label> <br>
												                                            <input style='margin-left: -.25rem;'
												class='form-check-input' id="ana_4"  onchange="seleccionar_analisis(4)" value='Grupo poco comprometido con las tareas asignadas, inasistencia a clase, en su gran mayoría no participan de las tutorias.' type='checkbox' ><label style="margin-left: 8;" class='col-md-11'>Grupo poco comprometido con las tareas asignadas, inasistencia a clase, en su gran mayoria no participan de las tutorias.</label> <br>
												                                            <input style='margin-left: -.25rem;'
												class='form-check-input' id="ana_5"  onchange="seleccionar_analisis(5)" value='Grupo bueno academicamente, agradable para desarrollar las clases y preocupado por la aplicacion de la asignatura.' type='checkbox' ><label style="margin-left: 8;" class='col-md-11'>Grupo bueno academicamente, agradable para desarrollar las clases y preocupado por la aplicacion de la asignatura.</label><br>

                                                <div id="otros_analisis"></div>

                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Estrategias didacticas exitosas que desee compartir con sus colegas <b>*</b> </label>
                                        <div class="col-md-12">
                                            <input id="estrategias_didacticas" name="estrategias_didacticas" type="text" class="form-control form-control-line " value="{{ $seguimiento->estrategias_didacticas }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Estrategias evaluativas exitosas que desee compartir con sus colegas <b>*</b></label>
                                        <div class="col-md-12">
                                            <input id="estrategias_evaluativas" name="estrategias_evaluativas" type="text" class="form-control form-control-line " value="{{ $seguimiento->estrategias_evaluativas }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12"  style="color: black;"><b>Compromisos</b></label>
                                        
                                    </div>
                                    <div class="form-group">
                                        <div id="siR>100">
                                        <label class="col-md-12" style="color: black;">Estrategias para desarrollar racionalmente el 100% del contenido programatico </label>
                                        <div class="col-md-12">
                                            <input id="estrategias_desa_cont_programatico" type="text" name="estrategias_desa_cont_programatico" placeholder="Solo si R<100%" class="form-control form-control-line " value="{{ $seguimiento->estrategias_desa_cont_programatico }}">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Si el porcentaje de eficiencia es "critico", estrategias (no  reducir rigor academico ni cientifico) para mejor eficiencia academica <b>*</b></label>
                                        <div class="col-md-12">
                                            <input id="si_porc_efi_critico" name="si_porc_efi_critico" type="text" class="form-control form-control-line " value="{{ $seguimiento->si_porc_efi_critico }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="color: black;">Sugerencias u observaciones generales </label>
                                        <div class="col-md-12">
                                            <input id="sugerencias" name="sugerencias" type="text" class="form-control form-control-line " value="{{ $seguimiento->sugerencias }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6  ">
                                    <a  id="btnsubir" onclick="guardar();" class="btn  btn-success" style="color: white;">   Guardar Cambios  </a>
                                    
                                    
                                    </div>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                {{ Form::close() }}


<!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Notas del @php
                                        if($seguimiento->corte==1) {
                                            echo "primer Corte";
                                        }elseif ($seguimiento->corte==2) {
                                            echo "segundo Corte";
                                        }else{
                                            echo "tercer Corte";
                                        }
                                    @endphp
                            </h4>
                                  </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <div id="ContenidoNotas" class="">
               
                                               <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>                
                                            </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button id="calculartotales" type="button" class="btn btn-default btn-info"  >Calcular totales</button>
                                  </div>
                                </div>

                              </div>
                            </div>

                <!--modal de agregar nuevas causas-->
                <div id="modal_nueva_causa" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Agregar nueva causa
                            </h4>
                                  </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                                <label class="col-md-12" style="color: black;">Causa </label>
                                                <div class="col-md-12">
                                                    <input id="nueva_causa" type="text" class="form-control form-control-line ">
                                                </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button onclick="agregar_nueva_causa()" type="button" class="btn btn-default btn-info" >Agregar</button>
                                  </div>
                                </div>

                              </div>
                            </div>


                <!--modal de agregar nuevos analisis-->
                <div id="modal_nuevo_analisis" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Agregar nuevo analisis cualitativo
                            </h4>
                                  </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                                <label class="col-md-12" style="color: black;">Analisis cualitativo </label>
                                                <div class="col-md-12">
                                                    <input id="nuevo_analisis" type="text" class="form-control form-control-line ">
                                                </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button onclick="agregar_nuevo_analisis()" type="button" class="btn btn-default btn-info" >Agregar</button>
                                  </div>
                                </div>

                              </div>
                            </div>

       <script type="text/javascript">

        $(document).ready(function(){cargar_unidades_ejes_causa_analisis_antiguos()})

       	var unidades_seleccionadas = []
       	var ejes_seleccionados = []
        var causas_seleccionadas = []
        var analisis_seleccionados = []


       	function buscar_ejes(id_unidad) {
       		$("#ejes_tematicos").html("Cargando...")
       		var html_unidad = $("#unidad_"+id_unidad)
	       	 if(html_unidad.prop('checked')){
	       	 	var url = "../getEjesTematicos/"+id_unidad
	       	 	$.ajax({ type: "GET", url : url, dataType:  "JSON"})
		         .done(function(response){
		        	unidades_seleccionadas.push(response)
		        	establecer_ejes_tematicos()
                     verificar_ejes_ya_checkeados()
		        })
	       	 }else{
	       	 	//aca elimino la unidad si esta en el array 
	       	 	unidades_seleccionadas.forEach(function(unidad_seleccionada){
	       	 		if(unidad_seleccionada.unidad.id_unidad_asignatura == id_unidad){
	       	 			var pos = unidades_seleccionadas.indexOf(unidad_seleccionada)
	       	 			unidades_seleccionadas.splice(pos, pos+1)//esto elimina del array

	       	 			//ahora elimino los ejes si ah escojido
	       	 			unidad_seleccionada.ejes_tematicos.forEach(function(eje_tematico){
	       	 				eliminar_eje_de_array(eje_tematico.id_eje_tematico)
	       	 			})
	       	 			establecer_ejes_tematicos()
                        verificar_ejes_ya_checkeados()
	       	 		}
	       	 	})
	       	}	
       	}


       	function establecer_ejes_tematicos() {
       		$("#ejes_tematicos").html("Cargando...")
       		var html_ejes = ""
       		unidades_seleccionadas.forEach(function(unidad_seleccionada){
	       	 	html_ejes += "<li><b style='font-size: 18px; color: black;'>"+unidad_seleccionada.unidad.nombre+"</b></li>"	

	       	 	unidad_seleccionada.ejes_tematicos.forEach(function(eje){
	       	 		html_ejes += "<input id='eje_"+eje.id_eje_tematico+"'  onchange='seleccionar_eje("+eje.id_eje_tematico+")' style='cursor:hand; margin-left: -.1rem; margin-top: 5px;' class='form-check-input'  style='margin-left: -.25rem;'  value='' type='checkbox' ><label for ='eje_"+eje.id_eje_tematico+"' style='margin-left: 13;' class='col-md-11'>"+eje.nombre+"</label><br>"
	       	 	})
	       	 	html_ejes += "<hr>"
	       	})
	       	$("#ejes_tematicos").html(html_ejes)
       	}

       	function seleccionar_eje(id_eje){
       		var html_eje = $("#eje_"+id_eje)
       		 if(html_eje.prop('checked')){
       		 	ejes_seleccionados.push(id_eje)
       		 }else{
       		 	eliminar_eje_de_array(id_eje)
       		 }
             calcular_porcentajes()
       	}

       	function eliminar_eje_de_array(id_eje){
       		ejes_seleccionados.forEach(function(eje_seleccionado){
       	 		if(eje_seleccionado == id_eje){
       	 			var pos = ejes_seleccionados.indexOf(eje_seleccionado)
       	 			ejes_seleccionados.splice(pos, pos+1)//esto elimina del array
       	 		}
	       	})
             calcular_porcentajes()
       	}

       	function seleccionar_causa(num_causa) {
       		var causa = $("#cau_"+num_causa).val()
       		if($("#cau_"+num_causa).prop('checked')){
       		 	causas_seleccionadas.push(causa)
       		 }else{
       		 	causas_seleccionadas.forEach(function(causa_seleccionada){
	       	 		if(causa_seleccionada == causa){
	       	 			var pos = causas_seleccionadas.indexOf(causa_seleccionada)
	       	 			causas_seleccionadas.splice(pos, pos+1)//esto elimina del array
	       	 		}
		       	})
       		 }
       	}
        function seleccionar_analisis(num_analisis) {
            var analisis = $("#ana_"+num_analisis).val()
            if($("#ana_"+num_analisis).prop('checked')){
                analisis_seleccionados.push(analisis)
             }else{
                analisis_seleccionados.forEach(function(analisis_seleccionado){
                    if(analisis_seleccionado == analisis){
                        var pos = analisis_seleccionados.indexOf(analisis_seleccionado)
                        analisis_seleccionados.splice(pos, pos+1)//esto elimina del array
                    }
                })
             }
        }

        function verificar_ejes_ya_checkeados() {
            ejes_seleccionados.forEach(function(eje) {
                $("#eje_"+eje).prop('checked', true)
            })
        }

        var ultmina_causa = 10 //en este caso esta variable es para saber que id se le pondran a las causas que agregen, en este caso empieza en 10 porque estan definidas inicialmente 10
        function agregar_nueva_causa() {
            if($('#modal_nueva_causa').is(':visible'))$("#modal_nueva_causa").modal('hide');
            
            ultmina_causa++
            var nueva_causa = $("#nueva_causa").val()
            var html_nueva_causa = "<input style='cursor:hand; margin-left: -.25rem;'class='form-check-input' onchange='seleccionar_causa("+ultmina_causa+")' id='cau_"+ultmina_causa+"' value='"+nueva_causa+"' type='checkbox' checked='true'><label style='margin-left: 13;' class='col-md-11'>"+nueva_causa+"</label><br>"
            $("#otras_causas").html($("#otras_causas").html()+html_nueva_causa)
            seleccionar_causa(ultmina_causa)

        }

        var ultmino_analisis = 5 //en este caso esta variable es para saber que id se le pondran a los analisis que agregen, en este caso empieza en 5 porque estan definidas inicialmente 5
        function agregar_nuevo_analisis() {
            if($('#modal_nuevo_analisis').is(':visible'))$("#modal_nuevo_analisis").modal('hide');
            ultmino_analisis++
            var nuevo_analisis = $("#nuevo_analisis").val()
            var html_nuevo_analisis = "<input style='margin-left: -.25rem;' class='form-check-input' id='ana_"+ultmino_analisis+"'  onchange='seleccionar_analisis("+ultmino_analisis+")' value='"+nuevo_analisis+"' type='checkbox' checked='true' ><label style='margin-left: 8;' class='col-md-11'>"+nuevo_analisis+"</label><br>"

            $("#otros_analisis").html($("#otros_analisis").html()+html_nuevo_analisis)
            seleccionar_analisis(ultmino_analisis)
        }

        function calcular_porcentajes(){
            var total_ejes_a_desarrollar = 0
            unidades_seleccionadas.forEach(function(unidad){
                total_ejes_a_desarrollar += unidad.ejes_tematicos.length
            })

            var total_ejes_seleccionados = ejes_seleccionados.length
            var porcentaje_desarrollo_asignatura = (total_ejes_seleccionados/total_ejes_a_desarrollar) * 100
            var porcentaje_relacion_ideal_real = 100 - porcentaje_desarrollo_asignatura 

            porcentaje_desarrollo_asignatura = porcentaje_desarrollo_asignatura.toFixed(2)
            porcentaje_relacion_ideal_real = porcentaje_relacion_ideal_real.toFixed(2)

            if(unidades_seleccionadas.length==0 || total_ejes_seleccionados==0) porcentaje_desarrollo_asignatura = 0
            if(unidades_seleccionadas.length==0 || total_ejes_seleccionados==0) porcentaje_relacion_ideal_real = 100

            $("#porcentaje_desarrollo").val(porcentaje_desarrollo_asignatura+"%")
            $("#relacion_ideal_real").val(porcentaje_relacion_ideal_real+"%")

            if(porcentaje_desarrollo_asignatura == 100.00) {
                document.getElementById('estrategias_desa_cont_programatico').disabled = true;
                $("#estrategias_desa_cont_programatico").val("") 
            } 
            if(porcentaje_desarrollo_asignatura < 100){
                document.getElementById('estrategias_desa_cont_programatico').disabled = false;
                
            } 
        }

       
        function establecer_reprobados() {
            var total = $("#num_estudiantes").val()
            var aprobados = $("#aprobados").val()

            total = parseInt(total)
            aprobados = parseInt(aprobados)
            $("#reprobados").val("")
            //aca valido si lo q escribio es numero y si es permitido segun el numero de estudiantes
            if(aprobados > total){ $("#aprobados").val(total); $("#reprobados").val(0); return true}
            if(aprobados < 0){ $("#aprobados").val(0); $("#reprobados").val(total); return true}
            
            if(aprobados != "")  $("#reprobados").val(total-aprobados)
           
        }

        function validar_cantidad_de_estudiantes(){
            if($("#num_estudiantes").val() > $("#num_estudiantes_iniciales").val()) $("#num_estudiantes").val($("#num_estudiantes_iniciales").val())
            if($("#num_estudiantes").val() < 0) $("#num_estudiantes").val(0)

            $("#aprobados").val("");
            $("#reprobados").val("");
        }
        function validar_promedio_notas(){
            nota = $("#prom_notas").val()
            if(nota > 5) $("#prom_notas").val(5)
            if(nota < 1) $("#prom_notas").val(0)
            
        }


       	function guardar(){
            var data_form = $("#form-seguimiento").serialize()
            var url = '{{ route('seguimiento/editar', $seguimiento->id_seguimiento) }}'

            var unidades = []
            unidades_seleccionadas.forEach(function(unidad_seleccionada){
                unidades.push(unidad_seleccionada.unidad.id_unidad_asignatura)
            })

            var token = data_form.split("&")[0].split("=")[1];

            var data = {
                '_token' : token,
                'id_seguimiento' : {{ $seguimiento->id_seguimiento }},
                'num_estudiantes' : $("#num_estudiantes").val(),
                'porcentaje_desarrollo' : $("#porcentaje_desarrollo").val(),
                'porcentaje_ideal' : $("#porcentaje_ideal").val(),
                'relacion_ideal_real' : $("#relacion_ideal_real").val(),
                'prom_notas' : $("#prom_notas").val(),
                'aprobados' : $("#aprobados").val(),
                'reprobados' : $("#reprobados").val(),
                'estrategias_didacticas' : $("#estrategias_didacticas").val(),
                'estrategias_evaluativas' : $("#estrategias_evaluativas").val(),
                'estrategias_desa_cont_programatico' : $("#estrategias_desa_cont_programatico").val(),
                'si_porc_efi_critico' : $("#si_porc_efi_critico").val(),
                'sugerencias' : $("#sugerencias").val(),
                'unidades_programadas' : unidades,
                'ejes_desarrollados' : ejes_seleccionados,
                'causas' : causas_seleccionadas,
                'analisis_cualitativo' : analisis_seleccionados 
            }

            $.blockUI({
                        message: '<h1>Guardando</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .8,
                            color: '#fff'
                        }});
            $.post(url, data, function(response){
                $.unblockUI();
                if(response.error == false){
                    toastr.success('El seguimiento de asignatura se ah registrado correctamente.', 'Guardado correctamente', {timeOut: 3000})
                    location.href = '{{ route('seguimiento/view', $seguimiento->id_seguimiento) }}'
                }else{ 
                    console.log(response)
                    response.errores.forEach(function(error) {
                        toastr.error(error, 'Error', {timeOut: 5000})
                    })
                }
            }).fail(function(error){
                toastr.error('Ah ocurrido un error al intentar registrar el seguimiento.', 'Error', {timeOut: 3000})
            })


       	}


        function cargar_unidades_ejes_causa_analisis_antiguos() {
            var unidades, ejes, causas, analisis = []
            var url = '{{ route('seguimiento/getSeguimiento', $seguimiento->id_seguimiento) }}'
            $.get(url, function(response) {

                causas = response.causas
                causas.forEach(function(causa){
                    //recorro las causas q ya estan por defecto
                    var encontro_causa = false
                    for (var i = 1; i <= 10; i++) {
                        if($("#cau_"+i).val() == causa.causa){
                        encontro_causa = true
                         $("#cau_"+i).prop('checked', true)
                         seleccionar_causa(i)
                        }
                    }
                    if(encontro_causa == false)
                    {
                            $("#nueva_causa").val(causa.causa)
                            agregar_nueva_causa()
                    }
                })
                
                unidades = response.unidades
                unidades.forEach(function(unidad){
                    $("#unidad_"+unidad.id_unidad_asignatura).prop('checked', true)
                    buscar_ejes(unidad.id_unidad_asignatura)
                })

                setTimeout(function(){ 
                        ejes = response.ejes
                        ejes.forEach(function(eje){
                            $("#eje_"+eje.id_eje_tematico).prop('checked', true)
                            seleccionar_eje(eje.id_eje_tematico)
                        })
                }, 7000);

                analisis = response.analisis
                analisis.forEach(function(analisis){
                    //recorro las causas q ya estan por defecto
                    var encontro_analisis = false
                    for (var i = 1; i <= 5; i++) {
                        if($("#ana_"+i).val() == analisis.analisis){
                        encontro_analisis = true
                         $("#ana_"+i).prop('checked', true)
                         seleccionar_analisis(i)
                        }
                    }
                    if(encontro_analisis == false)
                    {
                        $("#nuevo_analisis").val(analisis.analisis)
                        agregar_nuevo_analisis()
                    }
                })
               
            })
        }
       	
       </script>

@endsection

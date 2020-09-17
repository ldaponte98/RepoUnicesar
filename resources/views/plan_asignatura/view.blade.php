@extends('layouts.main')
@section('header_content')
<style type="text/css">
    .font-small{
        font-size: 13px;
    }
    .tabla_info td{
      padding: 10px !important;
    }
    .tabla_info_2{
        margin-bottom: 5px;
    }
    .tabla_info_2 th{
        background-color: #C2D69B;
        padding: 7px !important;
        font-size: 12px;
        font-weight: bold;
    }
    .tabla_info_2 td{
      padding: 10px !important;
      font-size: 12px;
    }
</style>
	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Plan asignatura</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Plan asignatura</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Vista principal</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <br>
                    
                 </div>
    </div>
@endsection
@section('content')
 <div class="row">
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-block">
                <div class="row">
                    <div class="col-sm-9">
                        <h3><b>Plan de asignatura de {{ $asignatura->nombre }}</b></h3>
                    </div>
                    <div class="col-sm-3">
                        @php
                            $periodos_academicos = \App\PeriodoAcademico::all();
                        @endphp
                        <select id="id_periodo_academico" class="custom-select" style="width: 100%" onchange="location.href = '/plan_asignatura/view/{{ $asignatura->id_asignatura }}/'+$('#id_periodo_academico').val()">
                            @foreach ($periodos_academicos as $d)
                            <option value="{{ $d->id_periodo_academico }}" @if($d->id_periodo_academico == $periodo_academico->id_periodo_academico) selected @endif > Periodo {{ $d->periodo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="tabla_info" width="100%" cellspacing="0" cellpadding="0" border="1">
                      <tr>
                        <td width="25%"><b>Programa académico </b></td>
                        <td colspan="9" width="75%">{{ $asignatura->licencia->nombre }}</td>
                      </tr>
                      <tr>
                        <td><b>Nombre de la asignatura </b></td>
                        <td colspan="9">{{ $asignatura->nombre }}</td>
                      </tr>
                      <tr>
                        <td><b>Código de la asignatura </b></td>
                        <td colspan="9">{{ $asignatura->codigo }}</td>
                      </tr>
                      <tr>
                        <td><b>Créditos académicos </b></td>
                        <td colspan="9">{{ $asignatura->num_creditos }}</td>
                      </tr>
                      <tr>
                        <td rowspan="2"><b>Horas de trabajo semestral del estudiante </b></td>
                        <td style="background-color: #EAF1DD;" colspan="4"><center><b>Horas con acompañamiento docente</b></center></td>
                        <td style="background-color: #EAF1DD;" rowspan="2"><center><b>HTI</b></center></td>
                        <td rowspan="2"><center>{{ $asignatura->horas_totales_trabajo_independiente }}</center></td>
                        <td style="background-color: #EAF1DD;" rowspan="2"><center><b>HTT</b></center></td>
                        <td rowspan="2"><center>{{ $asignatura->horas_totales_semestre }}</center></td>
                      </tr>
                      <tr>
                        <td style="background-color: #EAF1DD;" ><center><b>HDD</b></center></td>
                        <td style="" ><center>{{ $asignatura->horas_teoricas }}</center></td>
                        <td style="background-color: #EAF1DD;" ><center><b>HTP</b></center></td>
                        <td style="" ><center>{{ $asignatura->horas_practicas }}</center></td>
                      </tr>
                      <tr>
                        <td><b>Prerrequisitos </b></td>
                        <td colspan="9">{{ $asignatura->prerrequisitos }}</td>
                      </tr>
                      <tr>
                        <td><b>Correquisitos </b></td>
                        <td colspan="9">{{ $asignatura->correquisitos }}</td>
                      </tr>
                      <tr>
                        <td><b>Departamento oferente </b></td>
                        <td colspan="9">Departamento de {{ strtolower($asignatura->licencia->nombre) }}</td>
                      </tr>
                      <tr>
                        <td><b>Tipo de asignatura </b></td>
                        <td colspan="2" style="background-color: #EAF1DD;">Teórica</td> 
                        <td><center>@if($asignatura->tipo == 'teorica') <b>X</b> @endif</center></td>
                        <td colspan="2" style="background-color: #EAF1DD;">Teórico práctica:</td> 
                        <td><center>@if($asignatura->tipo == 'teorica_practica') <b>X</b> @endif</center></td>
                        <td style="background-color: #EAF1DD;">Práctica</td> 
                        <td><center>@if($asignatura->tipo == 'practica') <b>X</b> @endif</center></td>
                      </tr>
                      <tr>
                          <td rowspan="3"><b>Naturaleza de la asignatura</b></td>
                          <td colspan="2">Habilitable</td>
                          <td colspan="1">@if($asignatura->habilitable == 1) <center><b>X</b></center> @endif</td>
                          <td colspan="3">No habilitable</td>
                          <td colspan="2">@if($asignatura->habilitable == 0) <center><b>X</b></center> @endif</td>
                      </tr>
                      <tr>
                          <td colspan="2">Validable</td>
                          <td colspan="1">@if($asignatura->validable == 1) <center><b>X</b></center> @endif</td>
                          <td colspan="3">No validable</td>
                          <td colspan="2">@if($asignatura->validable == 0) <center><b>X</b></center> @endif</td>
                      </tr>
                      <tr>
                          <td colspan="2">Homologable</td>
                          <td colspan="1">@if($asignatura->homologable == 1) <center><b>X</b></center> @endif</td>
                          <td colspan="3">No homologable</td>
                          <td colspan="2">@if($asignatura->homologable == 0) <center><b>X</b></center> @endif</td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970;">
                              <center><b>DESCRIPCIÓN DE LA ASIGNATURA</b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <textarea id="descripcion_asignatura" class="form-control" rows="4" placeholder="Describa brevemente el propósito de la asignatura, el semestre en el que está ubicado en el plan de estudios, área del plan de estudios a la que pertenece, importancia del curso en el plan de estudios. Explique cómo contribuye al logro del perfil de egreso y las competencias que debe desarrollar en el programa. Igualmente explique a cuáles áreas de desempeño de la profesión contribuye con su contenido y en general todo aquello que plantee una visión general de la asignatura y su contribución a la formación del estudiante." 
                              value="{{ $plan_asignatura->descripcion_asignatura }}">{{ $plan_asignatura->descripcion_asignatura }}</textarea>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970;">
                              <center><b>OBJETIVO GENERAL </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <textarea id="objetivo_general" class="form-control" rows="3" placeholder="Escriba el objetivo general de la asignatura. Este objetivo debe redactarse centrado en la contribución de la asignatura en el proceso de formación del estudiante, de acuerdo con los objetivos y competencias del programa." 
                              value="{{ $plan_asignatura->objetivo_general }}">{{ $plan_asignatura->objetivo_general }}</textarea>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970; ">
                              <center><b>OBJETIVOS ESPECÍFICOS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Declarar los objetivos específicos en términos de logros que, al ser desarrollados gradualmente, den cumplimiento al objetivo general y deben impactar su alcance. Los objetivos deben ser aplicables, verificables, medibles y alcanzables."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <table class="table">
                                  <tbody id="tabla_detalles_27">
                                      
                                  </tbody>
                              </table>
                              <div><button class="pull-right btn btn-info" onclick="modal_detalle(27)">Nuevo</button></div>
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" style="background-color: #38A970; ">
                              <center><b>ESTRATEGIAS PEDAGÓGICAS Y METODÓLOGICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Escriba las estrategias pedagógicas, metodológicas y didácticas que empleará para lograr los resultados de aprendizaje propuestos. Las estrategias deben estar en coherencia con el modelo pedagógico Institucional “Cognitivo contextual de corte constructivista”."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <table class="table">
                                  <tbody id="tabla_detalles_28">
                                      
                                  </tbody>
                              </table>
                              <div><button class="pull-right btn btn-info" onclick="modal_detalle(28)">Nuevo</button></div>
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" style="background-color: #38A970; ">
                              <center><b>COMPETENCIAS GENÉRICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Mencione las competencias genéricas que esta asignatura ayudará en la formación de los estudiantes, en concordancia con el PEI y el programa curricular. Estas competencias deben estar enfocadas al desarrollo del ser (axiológico, social, estético)."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <table class="table">
                                  <tbody id="tabla_detalles_29">
                                      
                                  </tbody>
                              </table>
                              <div><button class="pull-right btn btn-info" onclick="modal_detalle(29)">Nuevo</button></div>
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" style="background-color: #38A970; ">
                              <center><b>MECANISMOS DE EVALUACIÓN <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Describir los mecanismos efectivos de seguimiento, evaluación y análisis de los resultados de aprendizaje, de tal manera que se articulen de forma planificada y coherente con el proceso formativo, las actividades académicas, el nivel de formación y el o las modalidades en las cuales se ofrecerá el programa. Estos mecanismos de evaluación deben estar en concordancia con la normatividad institucional, deben quedar claros los porcentajes y todo aquello que es sujeto de valoración."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <table class="table">
                                  <tbody id="tabla_detalles_30">
                                  </tbody>
                              </table>
                              <div><button class="pull-right btn btn-info" onclick="modal_detalle(30)">Nuevo</button></div>
                          </td>
                      </tr>

                       <tr>
                          <td colspan="10" style="background-color: #38A970; ">
                              <center><b>REFERENCIAS BIBLIOGRÁFICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Escriba la bibliografía actualizada y necesaria para el desarrollo de la asignatura, disponibles en medio físico y en las bases de datos con la que cuenta la Institución. Observación: se recomienda el uso de las bases de datos por ser un recurso abierto con contenidos altamente significativos y actualizados."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              <table class="table">
                                  <tbody id="tabla_detalles_31">
                                      
                                  </tbody>
                              </table>
                              <div><button class="pull-right btn btn-info" onclick="modal_detalle(31)">Nuevo</button></div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970; ">
                              <center><b>CONTENIDOS, COMPETENCIAS ESPECÍFICAS Y RESULTADOS DE APRENDIZAJE </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                        <table class="tabla_info_2" width="100%" cellspacing="0" cellpadding="0" border="1">
                                 <thead>
                                     <tr>
                                         <th rowspan="2"><center>Unidad Tematica</center></th>
                                         <th rowspan="2"><center>Competencias especificas</center></th>
                                         <th rowspan="2"><center>Resultados de aprendizaje</center></th>
                                         <th colspan="2"><center>Horas presenciales</center></th>
                                         <th rowspan="2"><center>HTI</center></th>
                                         <th rowspan="2"><center>HTT</center></th>
                                         <th rowspan="2"></th>
                                     </tr>
                                     <tr>
                                         <th><center>HDD</center></th>
                                         <th><center>HTP</center></th>
                                     </tr>
                                 </thead>
                                  <tbody id="tabla_unidades">

                                  </tbody>
                              </table>
                              <div><button class="pull-right btn btn-info" onclick="modal_unidades()">Nueva</button></div>
                          </td>
                      </tr>
                    </table> 
                    </div>
                </div>
                <br>
                <center><button class="btn btn-info" onclick="guardar()"><i class="fa fa-save"></i>&nbsp;Guardar cambios</button></center>
                </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><div id="titulo_modal"></div></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group" >
                        <input type="hidden" id="tipo_detalle">
                        <label for="recipient-name" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="modal_nombre">
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="agregar_o_editar_detalle()" class="btn btn-info">Agregar</button>
                  </div>
                </div>
              </div>
        </div>

        <div class="modal fade" id="modal_unidades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><div id="titulo_modal_unidades"></div></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <label for="recipient-name" class="col-form-label"><b>Unidad tematica</b></label>
                        <input type="text" placeholder="Escriba el nombre de cada tema o contenido de cada unidad (teóricos y de laboratorio). Se pueden desarrollar por contenidos temáticos, núcleos problemáticos." class="form-control" id="modal_nombre_unidad">
                        
                        <label for="recipient-name" class="col-form-label"><b>Resultados de aprendizaje</b></label>
                        <textarea type="text" rows="4" placeholder="Enuncie los resultados de aprendizaje propuestos para cada unidad temática. Recuerde que los resultados de aprendizaje es todo aquello que el alumno debe saber, comprender o ser capaz de hacer y dan cumplimiento a las competencias de la asignatura." class="form-control" id="modal_resultados_aprendizaje"></textarea>
                        <div class="row">
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas presenciales HDD</b></label>
                                <input placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HDD"></input>
                          </div>
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas presenciales HTP</b></label>
                                <input placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HTP"></input>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas HTI</b></label>
                                <input placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HTI"></input>
                          </div>
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas HTT</b></label>
                                <input placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HTT"></input>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12"><br>
                            <div class="row">
                              <div class="col-sm-9">
                                <label for="recipient-name" class="col-form-label"><b>Competencias especificas</b></label>
                              </div>
                              <div class="col-sm-3">
                                <button class="btn btn-info w-100" onclick="$('#div_competencia_especifica').fadeIn()">Nueva</button>
                              </div>
                            </div>
                            <div class="row" id="div_competencia_especifica" style="display:none;">
                              <div class="col-sm-12" style="display: flex;">
                                <input placeholder="Escribe aqui la nueva competencia especifica" type="text" class="form-control" id="modal_input_competencia_especifica"></input>
                              
                                <button class="btn btn-success" onclick="agregar_o_editar_competencia()">Guardar</button>
                             
                                <button class="btn btn-danger" onclick="$('#div_competencia_especifica').fadeOut()">Cancelar</button>
                              </div>                            
                            </div>
                                <table class="table">
                                  <tbody id="tabla_competencias_unidad">
                                        
                                  </tbody>
                              </table>
                          </div>
                        </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="agregar_o_editar_unidad()" class="btn btn-info">Guardar cambios</button>
                  </div>
                </div>
              </div>
        </div>

        @csrf
        <script type="text/javascript">
            $(function () {
              cargar_informacion()
              $('[data-toggle="popover"]').popover()

            })

            var detalles = []
            var unidades = []
            var posicion_detalle_editar = null
            var posicion_unidad_editar = null
            var posicion_competencia_editar = null

            function modal_detalle(tipo_detalle) {
                $("#modal_nombre").val("")
                this.posicion_detalle_editar = null
                $("#modal").modal('show')
                $("#tipo_detalle").val(tipo_detalle)
                let titulo = ""

                switch(tipo_detalle){
                    case 27:
                        titulo = "Nuevo objetivo especifico"
                    break
                    case 28:
                        titulo = "Nueva estrategia pedagógica y metodólogica"
                    break
                    case 29:
                        titulo = "Nueva competencia generica"
                    break
                    case 30:
                        titulo = "Nuevo mecanismo de evaluación"
                    break
                    case 31:
                        titulo = "Nueva referencia bibliografica"
                    break
                }
                $("#titulo_modal").html(titulo)
            }

            function agregar_o_editar_detalle() {
                if(this.posicion_detalle_editar == null){
                    agregar_detalle()
                }else{
                    editar_detalle()
                }
            }

            function validar_data_unidad() {
              if($("#modal_nombre_unidad").val().trim() == ""){ alert("El nombre de la unidad es obligatorio."); return false }
              if($("#modal_resultados_aprendizaje").val().trim() == ""){ alert("Los resultados de aprendizajes son un campo obligatorio."); return false }
              if($("#modal_horas_HDD").val().trim() == ""){ alert("Las horas HDD son un campo obligatorio."); return false }
              if($("#modal_horas_HTP").val().trim() == ""){ alert("Las horas HTP son un campo obligatorio."); return false }
              if($("#modal_horas_HTI").val().trim() == ""){ alert("Las horas HTI son un campo obligatorio."); return false }
              if($("#modal_horas_HTT").val().trim() == ""){ alert("Las horas HTT son un campo obligatorio."); return false }
              if(this.competencias_especificas_actuales.length == 0) { alert("Es necesario el registro de competencias especificas para la unidad tematica."); return false }
              return true
            }

            function agregar_o_editar_unidad() {
              if(validar_data_unidad()){
                if(this.posicion_unidad_editar == null){
                    agregar_unidad()
                }else{
                    editar_unidad()
                }
              }  
            }



            var competencias_especificas_actuales = []

            function agregar_o_editar_competencia() {
              if($("#modal_input_competencia_especifica").val().trim() != ""){
                if(posicion_competencia_editar == null){
                  agregar_competencia()
                }else{
                  editar_competencia()
                }
                actualizar_tabla_competencias()
              }else{
                alert("Por favor suministre la competencia especifica.")
              }
            }

            function agregar_competencia(){
              let competencia = {
                'id_competencia' : null,
                'nombre' : $("#modal_input_competencia_especifica").val()

              }
              this.competencias_especificas_actuales.push(competencia)
              $("#modal_input_competencia_especifica").val("")
              $("#div_competencia_especifica").fadeOut()
            }

            function editar_competencia(){
              competencia = competencias_especificas_actuales[this.posicion_competencia_editar]
              competencia.nombre = $("#modal_input_competencia_especifica").val()
              competencias_especificas_actuales.splice(this.posicion_competencia_editar, 1, competencia)
              this.posicion_competencia_editar = null
              $("#modal_input_competencia_especifica").val("")
              $("#div_competencia_especifica").fadeOut()
            }

            function actualizar_tabla_competencias() {
              $("#tabla_competencias_unidad").html("")
              competencias_especificas_actuales.forEach((competencia) => {
                    let posicion = competencias_especificas_actuales.indexOf(competencia)
                    let fila = '<tr>'+
                                  '<td><li>'+competencia.nombre+'</li></td>'+
                                  '<td><div style="text-align: right;">'+
                                  '<a style="cursor: pointer;" onclick="input_editar_competencia('+posicion+')">'+'<i class="fa fa-pencil"></i></a>&nbsp;&nbsp;'+
                                  '<a style="cursor: pointer;" onclick="eliminar_competencia('+posicion+')"><i class="fa fa-trash"></i></a></div></td>'+
                                '</tr>'
                    $("#tabla_competencias_unidad").append(fila)
              })
            }

            function input_editar_competencia(posicion){
              posicion_competencia_editar = posicion
              $("#modal_input_competencia_especifica").val(this.competencias_especificas_actuales[posicion].nombre)
              $("#div_competencia_especifica").fadeIn()
            }

            function eliminar_competencia(posicion){
              res = confirm('¿Seguro que desea eliminar esta competencia especifica?')
              if(res){
                  competencias_especificas_actuales.splice(posicion, 1)
              }
              actualizar_tabla_competencias()
            }

            

            function agregar_unidad() {

                $("#modal_unidades").modal('hide')
                let unidad = {
                    'id_unidad' : null,
                    'puede_eliminar' : true,
                    'nombre' : $("#modal_nombre_unidad").val(),
                    'resultado_aprendizaje' : $("#modal_resultados_aprendizaje").val(),
                    'horas_hdd' : $("#modal_horas_HDD").val(),
                    'horas_htp' : $("#modal_horas_HTP").val(),
                    'horas_hti' : $("#modal_horas_HTI").val(),
                    'horas_htt' : $("#modal_horas_HTT").val(),
                    'competencias' : this.competencias_especificas_actuales
                }
                competencias_especificas_actuales = []
                $("#modal_nombre_unidad").val("")
                $("#resultado_aprendizaje").val("")
                $("#horas_hdd").val("")
                $("#horas_htp").val("")
                $("#horas_hti").val("")
                $("#horas_htt").val("")
                this.unidades.push(unidad) //agregar
                actualizar_tabla_unidades()
            }

            function editar_unidad() {
                $("#modal_unidades").modal('hide')
                let unidad = {
                    'id_unidad' : unidades[posicion_unidad_editar].id_unidad,
                    'puede_eliminar' : unidades[posicion_unidad_editar].puede_eliminar,
                    'nombre' : $("#modal_nombre_unidad").val(),
                    'resultado_aprendizaje' : $("#modal_resultados_aprendizaje").val(),
                    'horas_hdd' : $("#modal_horas_HDD").val(),
                    'horas_htp' : $("#modal_horas_HTP").val(),
                    'horas_hti' : $("#modal_horas_HTI").val(),
                    'horas_htt' : $("#modal_horas_HTT").val(),
                    'competencias' : this.competencias_especificas_actuales
                }
                competencias_especificas_actuales = []
                $("#modal_nombre_unidad").val("")
                $("#modal_resultados_aprendizaje").val("")
                $("#modal_horas_HDD").val("")
                $("#modal_horas_HTP").val("")
                $("#modal_horas_HTI").val("")
                $("#modal_horas_HTT").val("")
                this.unidades.splice(this.posicion_unidad_editar, 1, unidad) //editar
                actualizar_tabla_unidades()
            }

            function actualizar_tabla_unidades() {
              $("#tabla_unidades").html("")
              unidades.forEach((unidad) => {
                    let posicion = unidades.indexOf(unidad)
                    let fila = '<tr>'+
                                  '<td>'+unidad.nombre+'</td>'+
                                  '<td>'
                    unidad.competencias.forEach((competencia) => {
                      fila += '<li>'+competencia.nombre+'</li>'
                    })
                                    
                    fila +=       '</td>'+
                                  '<td>'+unidad.resultado_aprendizaje+'</td>'+
                                  '<td><center>'+unidad.horas_hdd+'</center></td>'+
                                  '<td><center>'+unidad.horas_htp+'</center></td>'+
                                  '<td><center>'+unidad.horas_hti+'</center></td>'+
                                  '<td><center>'+unidad.horas_htt+'</center></td>'+
                                  '<td>'+
                                    '<div style="text-align: center;">'+
                                      '<a style="cursor: pointer;" onclick="modal_editar_unidad('+posicion+')">'+
                                        '<i class="fa fa-pencil"></i></a>'
                    if(unidad.puede_eliminar){
                            fila += '&nbsp;&nbsp;'+
                                      '<a style="cursor: pointer;" onclick="eliminar_unidad('+posicion+')">'+
                                        '<i class="fa fa-trash"></i></a>'
                    }

                    fila +=       '</div></td>'+
                                '</tr>'
                    $("#tabla_unidades").append(fila)
              })
            }

            function modal_editar_unidad(posicion){
              this.posicion_unidad_editar = posicion
              unidad = unidades[posicion]
              competencias_especificas_actuales = []
              $("#modal_nombre_unidad").val(unidad.nombre)
              $("#titulo_modal_unidades").html("Edición contenido")
              $("#modal_resultados_aprendizaje").val(unidad.resultado_aprendizaje)
              $("#modal_horas_HDD").val(unidad.horas_hdd)
              $("#modal_horas_HTP").val(unidad.horas_htp)
              $("#modal_horas_HTI").val(unidad.horas_hti)
              $("#modal_horas_HTT").val(unidad.horas_htt)
              this.competencias_especificas_actuales = unidad.competencias
              actualizar_tabla_competencias()
              $("#modal_unidades").modal('show')
            } 
            function eliminar_unidad(posicion) {
                res = confirm('¿Seguro que desea eliminar esta unidad tematica?')
                if(res){
                    unidades.splice(posicion, 1)
                }
                actualizar_tabla_unidades()
            }

            function agregar_detalle() {
                $("#modal").modal('hide')
                let detalle = {
                    'id_detalle' : null,
                    'nombre' : $("#modal_nombre").val(),
                    'tipo' : $("#tipo_detalle").val()
                }
                $("#modal_nombre").val("")

                this.detalles.push(detalle) //agregar
                actualizar_tablas()
            }
            function editar_detalle() {
                $("#modal").modal('hide')
                detalle = detalles[this.posicion_detalle_editar]
                detalle.nombre = $("#modal_nombre").val()
                detalles.splice(this.posicion_detalle_editar, 1, detalle)
                this.posicion_detalle_editar = null
                $("#modal_nombre").val("")
                actualizar_tablas()
            }
            function eliminar_detalle(posicion) {
                res = confirm('¿Seguro que desea eliminar esta unidad?')
                if(res){
                    detalles.splice(posicion, 1)
                }
                actualizar_tablas()
            }

            function actualizar_tablas() {
                $("#tabla_detalles_27").html("")
                $("#tabla_detalles_28").html("")
                $("#tabla_detalles_29").html("")
                $("#tabla_detalles_30").html("")
                $("#tabla_detalles_31").html("")
                detalles.forEach((detalle) => {
                    let posicion = detalles.indexOf(detalle)
                    let fila = '<tr>'+
                                  '<td><li>'+detalle.nombre+'</li></td>'+
                                  '<td><div style="text-align: right;">'+
                                  '<a style="cursor: pointer;" onclick="modal_editar_detalle('+posicion+')">'+'<i class="fa fa-pencil"></i></a>&nbsp;&nbsp;'+
                                  '<a style="cursor: pointer;" onclick="eliminar_detalle('+posicion+')"><i class="fa fa-trash"></i></a></div></td>'+
                                '</tr>'
                    $("#tabla_detalles_"+detalle.tipo).append(fila)
                })

                //console.log(detalles)
            }
            function modal_editar_detalle(posicion) {
                $("#modal").modal('show')

                this.posicion_detalle_editar = posicion
                let titulo = ""
                switch(parseInt(detalles[posicion].tipo)){
                    case 27:
                        titulo = "Editar objetivo especifico"
                    break
                    case 28:
                        titulo = "Editar estrategia pedagógica y metodólogica"
                    break
                    case 29:
                        titulo = "Editar competencia generica"
                    break
                    case 30:
                        titulo = "Editar mecanismo de evaluación"
                    break
                    case 31:
                        titulo = "Editar referencia bibliografica"
                    break
                }
                $("#titulo_modal").html(titulo)
                $("#modal_nombre").val(detalles[posicion].nombre)
            }

            function modal_unidades() {
                this.posicion_unidad_editar = null
                $("#modal_unidades").modal('show')                
                $("#titulo_modal_unidades").html("Nuevo contenido")
            }

            function validar_data() {
              if($("#descripcion_asignatura").val().trim() == ""){ alert("La descripcion de la asignatura es obligatoria"); return false }
              if($("#objetivo_general").val().trim() == ""){ alert("Los objetivos generales son obligatorios"); return false }
              if(this.unidades.length == 0) { alert("Es necesario el registro de unidades tematicas al plan de asignatura"); return false }
              return true
            }

            function guardar() {
              if(validar_data()){
                let url = '{{ route('plan_asignatura/editar') }}'
                let _token = ""
                $("[name='_token']").each(function() { _token = this.value })
                let request = {
                    '_token' : _token,
                    'id_plan_asignatura' : '{{ $plan_asignatura->id_plan_asignatura }}',
                    'id_asignatura' : '{{ $asignatura->id_asignatura }}',
                    'id_periodo_academico' : '{{ $periodo_academico->id_periodo_academico }}',
                    'descripcion_asignatura' : $("#descripcion_asignatura").val(),
                    'objetivo_general' : $("#objetivo_general").val(),
                    'detalles' : this.detalles,
                    'unidades' : this.unidades
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
            
                //peticion http
                $.post(url, request, (response) => {
                  $.unblockUI();
                    if(response.error == false){
                        toastr.success(response.message, 'Guardado correctamente', {timeOut: 5000})
                        location.reload();
                    }else{
                        toastr.error(response.message, 'Error', {timeOut: 5000})
                    }
                })
                .fail((error)=>{
                    $.unblockUI();
                    toastr.error("Ocurrio un error en el servicio. Por favor comuniquese con el encargado", 'Error', {timeOut: 5000})
                })
              }
            }

            function cargar_informacion(){
              let competencias = []
               @foreach($plan_asignatura->unidades() as $unidad)
                @foreach($unidad->ejes as $eje_tematico)
                    competencias.push({
                      'id_competencia' : {{ $eje_tematico->id_eje_tematico }},
                      'nombre' : '{{ $eje_tematico->nombre }}'
                    })
                @endforeach
                this.unidades.push({
                    'id_unidad' : {{ $unidad->id_unidad }},
                    'puede_eliminar' : @if($unidad->puede_eliminar) true @else false @endif,
                    'nombre' : '{{ $unidad->nombre }}',
                    'resultado_aprendizaje' : '{{ $unidad->resultados_aprendizaje }}',
                    'horas_hdd' : {{ $unidad->horas_hdd }},
                    'horas_htp' : {{ $unidad->horas_htp }},
                    'horas_hti' : {{ $unidad->horas_hti }},
                    'horas_htt' : {{ $unidad->horas_htt }},
                    'competencias' : competencias
                }) 
                competencias = []
               @endforeach


               @foreach($plan_asignatura->detalles as $detalle)
                this.detalles.push({
                    'id_detalle' : {{ $detalle->id_plan_asignatura_detalle }},
                    'nombre' : '{{ $detalle->nombre }}',
                    'tipo' : '{{ $detalle->id_dominio_tipo }}'
                }) //agregar
               @endforeach
               actualizar_tabla_unidades()
               actualizar_tablas()
            }

</script>
            
@endsection
@extends('layouts.main_docente')

@section('header_content')
@php
    $usuario = \App\Usuario::find(session('id_usuario'));
@endphp
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
                        <h3><b>Plan de asignatura de {{ $asignatura->nombre }}  {{ $periodo_academico->periodo }}</b></h3>
                    </div>
                    <div class="col-sm-3" style="display: flex;">
                      <div class="btn-group">
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-cog"></i>
                          </button>
                          <div class="dropdown-menu animated slideInUp" style="">
                              <a class="dropdown-item" onclick="exportar_google_site()" style="cursor: pointer;"><i class="fa fa-google-plus-official"></i> &nbsp;Exportar para Google Site</a>
                          </div>
                      </div>
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
                        <table class="tabla_info table-responsive" width="100%" cellspacing="0" cellpadding="0" border="1">
                      <tr>
                        <td width="25%"><b>Programa académico </b></td>
                        <td colspan="9" width="85%">{{ $asignatura->licencia->nombre }}</td>
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
                        <td rowspan="2"><center>{{ $plan_asignatura->horas_totales_trabajo_independiente }}</center></td>
                        <td style="background-color: #EAF1DD;" rowspan="2"><center><b>HTT</b></center></td>
                        <td rowspan="2"><center>{{ $plan_asignatura->horas_totales_semestre }}</center></td>
                      </tr>
                      <tr>
                        <td style="background-color: #EAF1DD;" ><center><b>HDD</b></center></td>
                        <td style="" ><center>{{ $plan_asignatura->horas_teoricas }}</center></td>
                        <td style="background-color: #EAF1DD;" ><center><b>HTP</b></center></td>
                        <td style="" ><center>{{ $plan_asignatura->horas_practicas }}</center></td>
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
                          <td colspan="10" style="background-color: #38A970; color: #000000;">
                              <center><b>DESCRIPCIÓN DE LA ASIGNATURA</b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                            @php
                              echo $plan_asignatura->descripcion_asignatura;
                            @endphp
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000;">
                              <center><b>OBJETIVO GENERAL </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                            @php
                              echo $plan_asignatura->objetivo_general;
                            @endphp
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000; ">
                              <center><b>OBJETIVOS ESPECÍFICOS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Declarar los objetivos específicos en términos de logros que, al ser desarrollados gradualmente, den cumplimiento al objetivo general y deben impactar su alcance. Los objetivos deben ser aplicables, verificables, medibles y alcanzables."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->objetivos_especificos;
                              @endphp
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000; ">
                              <center><b>ESTRATEGIAS PEDAGÓGICAS Y METODÓLOGICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Escriba las estrategias pedagógicas, metodológicas y didácticas que empleará para lograr los resultados de aprendizaje propuestos. Las estrategias deben estar en coherencia con el modelo pedagógico Institucional “Cognitivo contextual de corte constructivista”."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->estrategias_pedagogicas;
                              @endphp
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000; ">
                              <center><b>COMPETENCIAS GENÉRICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Mencione las competencias genéricas que esta asignatura ayudará en la formación de los estudiantes, en concordancia con el PEI y el programa curricular. Estas competencias deben estar enfocadas al desarrollo del ser (axiológico, social, estético)."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->competencias_genericas;
                              @endphp
                          </td>
                      </tr>

                      <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000; ">
                              <center><b>MECANISMOS DE EVALUACIÓN <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Describir los mecanismos efectivos de seguimiento, evaluación y análisis de los resultados de aprendizaje, de tal manera que se articulen de forma planificada y coherente con el proceso formativo, las actividades académicas, el nivel de formación y el o las modalidades en las cuales se ofrecerá el programa. Estos mecanismos de evaluación deben estar en concordancia con la normatividad institucional, deben quedar claros los porcentajes y todo aquello que es sujeto de valoración."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                              @php
                                echo $plan_asignatura->mecanismos_evaluacion;
                              @endphp
                          </td>
                      </tr>

                       <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000; ">
                              <center><b>REFERENCIAS BIBLIOGRÁFICAS <a style="cursor: pointer;" data-toggle="popover" title="Información" data-content="Escriba la bibliografía actualizada y necesaria para el desarrollo de la asignatura, disponibles en medio físico y en las bases de datos con la que cuenta la Institución. Observación: se recomienda el uso de las bases de datos por ser un recurso abierto con contenidos altamente significativos y actualizados."><i class="fa fa-info-circle"></i></a>
                                </b></center>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10">
                               @php
                                echo $plan_asignatura->referencias_bibliograficas;
                               @endphp
                          </td>
                      </tr>
                      <tr>
                          <td colspan="10" style="background-color: #38A970; color: #000000; ">
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
                                     </tr>
                                     <tr>
                                         <th><center>HDD</center></th>
                                         <th><center>HTP</center></th>
                                     </tr>
                                 </thead>
                                  <tbody id="tabla_unidades">

                                  </tbody>
                              </table>
                          </td>
                      </tr>
                    </table> 
                    </div>

                </div>
                <br>
                <center><button class="btn btn-info" onclick="$('#modal_sugerencia').modal('show')"><i class="fa fa-plus"></i>&nbsp;Añadir sugerencia</button> &nbsp;&nbsp;&nbsp;@if($plan_asignatura->id_plan_asignatura)<a target="_blank" href="{{ route('plan_asignatura/imprimir', $plan_asignatura->id_plan_asignatura) }}" class="btn btn-danger"><i class="fa fa-print"></i> Imprimir</a> @endif</center>

                </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="modal_sugerencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Sugerencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>  
                  <div class="modal-body">
                      <div class="form-group" >
                        <input type="hidden" id="tipo_detalle">
                        <label for="recipient-name" class="col-form-label"><b>Escriba la sugerencia con relación al plan de asignatura</b></label>
                        <textarea rows="5" class="form-control" id="modal_mensaje_sugerencia" placeholder="Esta sugerencia sera enviada al jefe de departamento del programa."></textarea>
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="enviar_sugerencia()" class="btn btn-info">Enviar sugerencia</button>
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
                        <input disabled type="text" placeholder="Escriba el nombre de cada tema o contenido de cada unidad (teóricos y de laboratorio). Se pueden desarrollar por contenidos temáticos, núcleos problemáticos." class="form-control" id="modal_nombre_unidad">
                        
                        <label for="recipient-name" class="col-form-label"><b>Resultados de aprendizaje</b></label>
                        <textarea disabled type="text" rows="4" placeholder="Enuncie los resultados de aprendizaje propuestos para cada unidad temática. Recuerde que los resultados de aprendizaje es todo aquello que el alumno debe saber, comprender o ser capaz de hacer y dan cumplimiento a las competencias de la asignatura." class="form-control" id="modal_resultados_aprendizaje"></textarea>
                        <div class="row">
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas presenciales HDD</b></label>
                                <input disabled placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HDD"></input>
                          </div>
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas presenciales HTP</b></label>
                                <input disabled placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HTP"></input>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas HTI</b></label>
                                <input disabled placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HTI"></input>
                          </div>
                          <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label"><b>Horas HTT</b></label>
                                <input disabled placeholder="Por unidad tematica" type="number" class="form-control" id="modal_horas_HTT"></input>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <label for="recipient-name" class="col-form-label"><b>Competencias especificas</b></label>
                            <textarea type="text" rows="4" placeholder="" class="form-control" id="modal_competencias_especificas"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12"><br>
                            <div class="row">
                              <div class="col-sm-9">
                                <label for="recipient-name" class="col-form-label"><b>Ejes tematicos</b></label>
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
                  </div>
                </div>
              </div>
        </div>
            @php
                $jefe_departamento = \App\Tercero::where('id_licencia', $usuario->tercero->id_licencia)->where('id_dominio_tipo_ter', 2)->first();
            @endphp
        @csrf
        <script type="text/javascript">
            $(function () {
              cargar_informacion()
              $('[data-toggle="popover"]').popover()

            })

            var detalles = []
            var unidades = []

            var competencias_especificas_actuales = []

          

          
            function actualizar_tabla_competencias() {
              $("#tabla_competencias_unidad").html("")
              competencias_especificas_actuales.forEach((competencia) => {
                    let posicion = competencias_especificas_actuales.indexOf(competencia)
                    let fila = '<tr>'+
                                  '<td><li>'+competencia.nombre+'</li></td>'+
                                  '<td><div style="text-align: right;">'+
                                  '</tr>'
                    $("#tabla_competencias_unidad").append(fila)
              })
            }

            


           
            function actualizar_tabla_unidades() {
              $("#tabla_unidades").html("")
              let cont = 0
              unidades.forEach((unidad) => {
                cont++
                    let posicion = unidades.indexOf(unidad)
                    let fila = '<tr>'+
                                  '<td><center><b>Unidad N° '+cont+'</b><br> '+unidad.nombre+'<br><br>'
                    unidad.competencias.forEach((competencia) => {
                      fila += '<li><i>'+competencia.nombre+'</i></li>'
                    })
                                    
                    fila +=       '</center></td>'+
                                  '<td><center>'+unidad.competencias_especificas+'</center></td>'+
                                  '<td>'+unidad.resultado_aprendizaje+'</td>'+
                                  '<td><center>'+unidad.horas_hdd+'</center></td>'+
                                  '<td><center>'+unidad.horas_htp+'</center></td>'+
                                  '<td><center>'+unidad.horas_hti+'</center></td>'+
                                  '<td><center>'+unidad.horas_htt+'</center></td>'+
                                '</tr>'
                    $("#tabla_unidades").append(fila)
              })
            }

            function modal_editar_unidad(posicion){
              this.posicion_unidad_editar = posicion
              unidad = unidades[posicion]
              competencias_especificas_actuales = []
              $("#modal_nombre_unidad").val(unidad.nombre)
              $("#titulo_modal_unidades").html("Competencias especificas")
              $("#modal_resultados_aprendizaje").val(unidad.resultado_aprendizaje)
              $("#modal_horas_HDD").val(unidad.horas_hdd)
              $("#modal_horas_HTP").val(unidad.horas_htp)
              $("#modal_horas_HTI").val(unidad.horas_hti)
              $("#modal_horas_HTT").val(unidad.horas_htt)
              $("#modal_competencias_especificas").val(unidad.modal_competencias_especificas)
              this.competencias_especificas_actuales = unidad.competencias
              actualizar_tabla_competencias()
              $("#modal_unidades").modal('show')
            } 
           
            function actualizar_tablas() {
                

                //console.log(detalles)
            }
            
            function modal_unidades() {
                this.posicion_unidad_editar = null
                $("#modal_unidades").modal('show')                
                $("#titulo_modal_unidades").html("Nuevo contenido")
            }
            function enviar_sugerencia(){

              let mensaje = $("#modal_mensaje_sugerencia").val()
              if (mensaje.lenght == 0) {
                  alert("Debe llenar el campo requerido")
                  return false
              }
              if (mensaje.lenght>500) {
                  alert("Tamaño maximo de caracteres : 500")
                  return false
              }
              $("#modal_sugerencia").modal('hide')
              var id_tercero_envia = '{{ $usuario->tercero->id_tercero }}'
              var id_tercero_recibe = '{{ $jefe_departamento->id_tercero }}'
              var id_dominio_tipo = 32 //Sugerencia plan de asignatura
              var _token = document.getElementsByName('_token')[0].value;

              var data = {
                  mensaje : mensaje,
                  id_tercero_envia : id_tercero_envia,
                  id_tercero_recibe : id_tercero_recibe,
                  id_dominio_tipo : id_dominio_tipo,
                  id_formato : {{ $plan_asignatura->id_plan_asignatura }},
                  id_dominio_tipo_formato : {{ config('global.plan_asignatura') }},
                  _token : _token
              };
               $.blockUI({
                  message: '<h1>Enviando sugerencia...</h1><i class="fa fa-spinner fa-spin fa-3x fa-fw">',
                  css: {
                      border: 'none',
                      padding: '15px',
                      backgroundColor: '#000',
                      '-webkit-border-radius': '10px',
                      '-moz-border-radius': '10px',
                      opacity: .8,
                      color: '#ffffff'
                  }});
              $.post("{{ route('notificacion/crear') }}",data, function(response){
                  $.unblockUI();
                 if (!response.error) toastr.success('Sugerencia enviada exitosamente', 'Mensaje enviado', {timeOut: 5000}) 
                 if (response.error) toastr.error('Ocurrio un error al enviar la sugerencia', 'Mensaje no enviado', {timeOut: 3000})
              }).fail((error)=>{
                $.unblockUI();
                toastr.error('Ocurrio un error en el servicio al intentar enviar la sugerencia', 'Error en el servidor', {timeOut: 5000})
              });
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
                    'competencias_especificas' : '{{ $unidad->competencias_especificas }}',
                    'competencias' : competencias
                }) 
                competencias = []
               @endforeach
               
               actualizar_tabla_unidades()
               actualizar_tablas()
            }

            function exportar_google_site(){
              let url = '{{ route('plan_asignatura/obtener_vista', $plan_asignatura->id_plan_asignatura) }}'
              $.get(url, (response) => {
                copiar(response)
              }).fail((error) => {
                toastr.error('Ocurrio un error al exportar la pagina para google site', 'Error', {timeOut: 5000})
              })
            }

            function copiar(value){
              var aux = document.createElement("input");
              aux.setAttribute("value", value);
              document.body.appendChild(aux);
              aux.select();
              document.execCommand("copy");
              document.body.removeChild(aux);
              toastr.options.newestOnTop = false;
              toastr.info('Pagina copiada para Google Site.', 'Copiada', {timeOut: 5000})
            }

</script>
            
@endsection
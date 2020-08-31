<?php
    $usuario = \App\Usuario::find(session('id_usuario'));
    $tercero = $usuario->tercero;
?> 
<?php $__env->startSection('header_content'); ?>

	<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Docente</a></li>
                            <li class="hidden-sm-down breadcrumb-item active">Horario</li>
                        </ol>
                    </div>
                              
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<script>
  $(document).ready(function() {
    agregar_evento_antiguos_horario()
  })
  var lista_actividades = []
  var horario = []
    
   function actualizar_horario() {
    horario.forEach((evento)=>{
      var td = "<center><p>"+evento.tipo_evento+" <br>"+"<strong>"+evento.nombre+"</strong> <br>";
      
      td += "</p><center>"
      $("#td_"+evento.dia+"_"+evento.hora).html(td)
    })
  }
  function agregar_evento_antiguos_horario() {
    
    <?php 
      if($horario){
         foreach ($horario->detalles as $detalle) {
           ?> 
            var evento = {
                'dia' : '<?php echo e($detalle->dia_semana); ?>',
                'hora' : '<?php echo e($detalle->hora); ?>',
                'nombre' : '<?php echo e($detalle->evento); ?>',
                'tipo_evento' : '<?php echo e($detalle->tipo_evento->dominio); ?>',
                'id_tipo_evento' : '<?php echo e($detalle->id_dominio_tipo_evento); ?>'
            }
            horario.push(evento)
           <?php
        } 
      }
    ?>
    actualizar_horario()
  }

   
   
</script>



<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            
                <div class="form-group">
                    <?php
                    $imagen = 'assets/images/users/sin_foto.jpg';
                    if ($docente->foto)$imagen = 'files/'.$docente->cedula.'/'.$docente->foto;
                    ?>
                    <a> <img id="" target="Ver imagen" src="<?php echo e(asset($imagen)); ?>" class="img-circle" width="50" height="50" /> <b> <?php echo e(strtoupper($docente->getNameFull())); ?></b></a> 
                    <br><br>
                    <?php echo e(Form::open()); ?>

                                  <label style="color: black;"><b>Periodo Academico</b></label>
                                  <div class="row">
                                      <div class="col-sm-4">
                                        <select name="id_periodo_escojido" class="form-control form-control-line" >
                                                <?php
                                                    $periodos = \App\PeriodoAcademico::all();
                                                ?>

                                                <?php $__currentLoopData = $periodos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($periodo->id_periodo_academico == $periodo_academico->id_periodo_academico): ?>
                                                        <option selected value="<?php echo e($periodo->id_periodo_academico); ?>"><?php echo e($periodo->periodo); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($periodo->id_periodo_academico); ?>"><?php echo e($periodo->periodo); ?></option>
                                                    <?php endif; ?>
                                                
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                      <div class="col-sm-2">
                                        <button type="submit" style="color: white; height: 100%; width: 100%;  font-size: 16px;"  class="btn btn-success">Consultar</button>
                                      </div>
                                  </div>
                    <?php echo e(Form::close()); ?>


                            </div>

<style type="text/css">
  .tablita{
    border-color: black;
  }
  .tablita td{
    cursor: pointer !important;
    border-color: black;
  }
  .tablita p{
   font-size: 12px;
   margin-bottom: 0px;
  }
  .tablita th{
   color: black !important;
  }
</style>
<div class="table-responsive">
<table class="table table-bordered no-wrap tablita" >
    <tr style="background-color: #c7e6a4">
      <td style="color: black !important;"><center><b>HORAS</b></center></td>
      <th><center><b>LUNES</b></center></th>
      <th><center><b>MARTES</b></center></th>
      <th><center><b>MIERCOLES</b></center></th>
      <th><center><b>JUEVES</b></center></th>
      <th><center><b>VIERNES</b></center></th>
      <th><center><b>SABADO</b></center></th>
    </tr>
    <tr>
      <th ><center><b>6 - 7</b></center></th>
      <td id="td_Lunes_6-7" onclick="ModalNuevoEvento('Lunes', '6-7')"><center></center></td>
      <td id="td_Martes_6-7" onclick="ModalNuevoEvento('Martes', '6-7')"><center></center></td>
      <td id="td_Miercoles_6-7" onclick="ModalNuevoEvento('Miercoles', '6-7')"><center></center></td>
      <td id="td_Jueves_6-7" onclick="ModalNuevoEvento('Jueves', '6-7')"><center></center></td>
      <td id="td_Viernes_6-7" onclick="ModalNuevoEvento('Viernes', '6-7')"><center></center></td>
      <td id="td_Sabado_6-7" onclick="ModalNuevoEvento('Sabado', '6-7')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>7 - 8</b></center></th>
      <td id="td_Lunes_7-8" onclick="ModalNuevoEvento('Lunes', '7-8')"><center></center></td>
      <td id="td_Martes_7-8" onclick="ModalNuevoEvento('Martes', '7-8')"><center></center></td>
      <td id="td_Miercoles_7-8" onclick="ModalNuevoEvento('Miercoles', '7-8')"><center></center></td>
      <td id="td_Jueves_7-8" onclick="ModalNuevoEvento('Jueves', '7-8')"><center></center></td>
      <td id="td_Viernes_7-8" onclick="ModalNuevoEvento('Viernes', '7-8')"><center></center></td>
      <td id="td_Sabado_7-8" onclick="ModalNuevoEvento('Sabado', '7-8')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>8 - 9</b></center></th>
      <td id="td_Lunes_8-9" onclick="ModalNuevoEvento('Lunes', '8-9')"><center></center></td>
      <td id="td_Martes_8-9" onclick="ModalNuevoEvento('Martes', '8-9')"><center></center></td>
      <td id="td_Miercoles_8-9" onclick="ModalNuevoEvento('Miercoles', '8-9')"><center></center></td>
      <td id="td_Jueves_8-9" onclick="ModalNuevoEvento('Jueves', '8-9')"><center></center></td>
      <td id="td_Viernes_8-9" onclick="ModalNuevoEvento('Viernes', '8-9')"><center></center></td>
      <td id="td_Sabado_8-9" onclick="ModalNuevoEvento('Sabado', '8-9')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>9 - 10</b></center></th>
      <td id="td_Lunes_9-10" onclick="ModalNuevoEvento('Lunes', '9-10')"><center></center></td>
      <td id="td_Martes_9-10" onclick="ModalNuevoEvento('Martes', '9-10')"><center></center></td>
      <td id="td_Miercoles_9-10" onclick="ModalNuevoEvento('Miercoles', '9-10')"><center></center></td>
      <td id="td_Jueves_9-10" onclick="ModalNuevoEvento('Jueves', '9-10')"><center></center></td>
      <td id="td_Viernes_9-10" onclick="ModalNuevoEvento('Viernes', '9-10')"><center></center></td>
      <td id="td_Sabado_9-10" onclick="ModalNuevoEvento('Sabado', '9-10')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>10 - 11</b></center></th>
      <td id="td_Lunes_10-11" onclick="ModalNuevoEvento('Lunes', '10-11')"><center></center></td>
      <td id="td_Martes_10-11" onclick="ModalNuevoEvento('Martes', '10-11')"><center></center></td>
      <td id="td_Miercoles_10-11" onclick="ModalNuevoEvento('Miercoles', '10-11')"><center></center></td>
      <td id="td_Jueves_10-11" onclick="ModalNuevoEvento('Jueves', '10-11')"><center></center></td>
      <td id="td_Viernes_10-11" onclick="ModalNuevoEvento('Viernes', '10-11')"><center></center></td>
      <td id="td_Sabado_10-11" onclick="ModalNuevoEvento('Sabado', '10-11')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>11 - 12</b></center></th>
      <td id="td_Lunes_11-12" onclick="ModalNuevoEvento('Lunes', '11-12')"><center></center></td>
      <td id="td_Martes_11-12" onclick="ModalNuevoEvento('Martes', '11-12')"><center></center></td>
      <td id="td_Miercoles_11-12" onclick="ModalNuevoEvento('Miercoles', '11-12')"><center></center></td>
      <td id="td_Jueves_11-12" onclick="ModalNuevoEvento('Jueves', '11-12')"><center></center></td>
      <td id="td_Viernes_11-12" onclick="ModalNuevoEvento('Viernes', '11-12')"><center></center></td>
      <td id="td_Sabado_11-12" onclick="ModalNuevoEvento('Sabado', '11-12')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>12 - 13</b></center></th>
      <td id="td_Lunes_12-13" onclick="ModalNuevoEvento('Lunes', '12-13')"><center></center></td>
      <td id="td_Martes_12-13" onclick="ModalNuevoEvento('Martes', '12-13')"><center></center></td>
      <td id="td_Miercoles_12-13" onclick="ModalNuevoEvento('Miercoles', '12-13')"><center></center></td>
      <td id="td_Jueves_12-13" onclick="ModalNuevoEvento('Jueves', '12-13')"><center></center></td>
      <td id="td_Viernes_12-13" onclick="ModalNuevoEvento('Viernes', '12-13')"><center></center></td>
      <td id="td_Sabado_12-13" onclick="ModalNuevoEvento('Sabado', '12-13')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>13 - 14</b></center></th>
      <td id="td_Lunes_13-14" onclick="ModalNuevoEvento('Lunes', '13-14')"><center></center></td>
      <td id="td_Martes_13-14" onclick="ModalNuevoEvento('Martes', '13-14')"><center></center></td>
      <td id="td_Miercoles_13-14" onclick="ModalNuevoEvento('Miercoles', '13-14')"><center></center></td>
      <td id="td_Jueves_13-14" onclick="ModalNuevoEvento('Jueves', '13-14')"><center></center></td>
      <td id="td_Viernes_13-14" onclick="ModalNuevoEvento('Viernes', '13-14')"><center></center></td>
      <td id="td_Sabado_13-14" onclick="ModalNuevoEvento('Sabado', '13-14')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>14 - 15</b></center></th>
      <td id="td_Lunes_14-15" onclick="ModalNuevoEvento('Lunes', '14-15')"><center></center></td>
      <td id="td_Martes_14-15" onclick="ModalNuevoEvento('Martes', '14-15')"><center></center></td>
      <td id="td_Miercoles_14-15" onclick="ModalNuevoEvento('Miercoles', '14-15')"><center></center></td>
      <td id="td_Jueves_14-15" onclick="ModalNuevoEvento('Jueves', '14-15')"><center></center></td>
      <td id="td_Viernes_14-15" onclick="ModalNuevoEvento('Viernes', '14-15')"><center></center></td>
      <td id="td_Sabado_14-15" onclick="ModalNuevoEvento('Sabado', '14-15')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>15 - 16</b></center></th>
      <td id="td_Lunes_15-16" onclick="ModalNuevoEvento('Lunes', '15-16')"><center></center></td>
      <td id="td_Martes_15-16" onclick="ModalNuevoEvento('Martes', '15-16')"><center></center></td>
      <td id="td_Miercoles_15-16" onclick="ModalNuevoEvento('Miercoles', '15-16')"><center></center></td>
      <td id="td_Jueves_15-16" onclick="ModalNuevoEvento('Jueves', '15-16')"><center></center></td>
      <td id="td_Viernes_15-16" onclick="ModalNuevoEvento('Viernes', '15-16')"><center></center></td>
      <td id="td_Sabado_15-16" onclick="ModalNuevoEvento('Sabado', '15-16')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>16 - 17</b></center></th>
      <td id="td_Lunes_16-17" onclick="ModalNuevoEvento('Lunes', '16-17')"><center></center></td>
      <td id="td_Martes_16-17" onclick="ModalNuevoEvento('Martes', '16-17')"><center></center></td>
      <td id="td_Miercoles_16-17" onclick="ModalNuevoEvento('Miercoles', '16-17')"><center></center></td>
      <td id="td_Jueves_16-17" onclick="ModalNuevoEvento('Jueves', '16-17')"><center></center></td>
      <td id="td_Viernes_16-17" onclick="ModalNuevoEvento('Viernes', '16-17')"><center></center></td>
      <td id="td_Sabado_16-17" onclick="ModalNuevoEvento('Sabado', '16-17')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>17- 18</b></center></th>
      <td id="td_Lunes_17-18" onclick="ModalNuevoEvento('Lunes', '17-18')"><center></center></td>
      <td id="td_Martes_17-18" onclick="ModalNuevoEvento('Martes', '17-18')"><center></center></td>
      <td id="td_Miercoles_17-18" onclick="ModalNuevoEvento('Miercoles', '17-18')"><center></center></td>
      <td id="td_Jueves_17-18" onclick="ModalNuevoEvento('Jueves', '17-18')"><center></center></td>
      <td id="td_Viernes_17-18" onclick="ModalNuevoEvento('Viernes', '17-18')"><center></center></td>
      <td id="td_Sabado_17-18" onclick="ModalNuevoEvento('Sabado', '17-18')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>18 - 19</b></center></th>
      <td id="td_Lunes_18-19" onclick="ModalNuevoEvento('Lunes', '18-19')"><center></center></td>
      <td id="td_Martes_18-19" onclick="ModalNuevoEvento('Martes', '18-19')"><center></center></td>
      <td id="td_Miercoles_18-19" onclick="ModalNuevoEvento('Miercoles', '18-19')"><center></center></td>
      <td id="td_Jueves_18-19" onclick="ModalNuevoEvento('Jueves', '18-19')"><center></center></td>
      <td id="td_Viernes_18-19" onclick="ModalNuevoEvento('Viernes', '18-19')"><center></center></td>
      <td id="td_Sabado_18-19" onclick="ModalNuevoEvento('Sabado', '18-19')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>19 - 20</b></center></th>
      <td id="td_Lunes_19-20" onclick="ModalNuevoEvento('Lunes', '19-20')"><center></center></td>
      <td id="td_Martes_19-20" onclick="ModalNuevoEvento('Martes', '19-20')"><center></center></td>
      <td id="td_Miercoles_19-20" onclick="ModalNuevoEvento('Miercoles', '19-20')"><center></center></td>
      <td id="td_Jueves_19-20" onclick="ModalNuevoEvento('Jueves', '19-20')"><center></center></td>
      <td id="td_Viernes_19-20" onclick="ModalNuevoEvento('Viernes', '19-20')"><center></center></td>
      <td id="td_Sabado_19-20" onclick="ModalNuevoEvento('Sabado', '19-20')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>20 - 21</b></center></th>
      <td id="td_Lunes_20-21" onclick="ModalNuevoEvento('Lunes', '20-21')"><center></center></td>
      <td id="td_Martes_20-21" onclick="ModalNuevoEvento('Martes', '20-21')"><center></center></td>
      <td id="td_Miercoles_20-21" onclick="ModalNuevoEvento('Miercoles', '20-21')"><center></center></td>
      <td id="td_Jueves_20-21" onclick="ModalNuevoEvento('Jueves', '20-21')"><center></center></td>
      <td id="td_Viernes_20-21" onclick="ModalNuevoEvento('Viernes', '20-21')"><center></center></td>
      <td id="td_Sabado_20-21" onclick="ModalNuevoEvento('Sabado', '20-21')"><center></center></td>
    </tr>
    <tr>
      <th><center><b>21 - 22</b></center></th>
      <td id="td_Lunes_21-22" onclick="ModalNuevoEvento('Lunes', '21-22')"><center></center></td>
      <td id="td_Martes_21-22" onclick="ModalNuevoEvento('Martes', '21-22')"><center></center></td>
      <td id="td_Miercoles_21-22" onclick="ModalNuevoEvento('Miercoles', '21-22')"><center></center></td>
      <td id="td_Jueves_21-22" onclick="ModalNuevoEvento('Jueves', '21-22')"><center></center></td>
      <td id="td_Viernes_21-22" onclick="ModalNuevoEvento('Viernes', '21-22')"><center></center></td>
      <td id="td_Sabado_21-22" onclick="ModalNuevoEvento('Sabado', '21-22')"><center></center></td>
    </tr> 
</table>
</div>


                    <br>
                    
                  </div>
                </div>  
              </div>                           
            </div>




<script>
  function ModalNuevoEvento(dia, hora) {
    
  }
</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make((session("is_admin") == true ? 'layouts.main' : 'layouts.main_docente'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/docente/view_horario.blade.php ENDPATH**/ ?>
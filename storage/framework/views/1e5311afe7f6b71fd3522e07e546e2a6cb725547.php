<?php
    $usuario = \App\Usuario::find(session('id_usuario'));
?>    
<style type="text/css">
    .search{
    line-height: inherit;
    height: 31px;
    background-color: #f2f7f8;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    border-bottom-color: #ddd;
    }
    .search:focus{
       border-bottom-color: black; 
       transition: 2.5s;
    }

    #segundofil{
        display: none;
    }
    #bodytablemiseguimiento tr:hover{
        background-color: #DAF7A6;
        color: black;
       
    }
</style>
<?php $__env->startSection('header_content'); ?>

<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tabla</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Fechas</a></li>
                            <li class="breadcrumb-item active">Plazos extra </li>
                        </ol>
                        
                    </div>
                    
                </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
    .select2-container--default .select2-selection--single{
        font-size: 1.2em;  
    }
    
    .tab_header{
        color: black;
    }
</style>
<?php echo e(Form::open(['route'=>'fechas/plazo_extra_por_docente'])); ?>

<div class="row">
  <div class="col-sm-12">
      <div class="card">
          <div class="card-block">
            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                    
                        <?php
                            $docentes = \App\Tercero::all()->where('id_dominio_tipo_ter', 3)->where('id_licencia', session('id_licencia'));
                        ?>
                    <label style="color: black;"><b>Docente</b></label>
                    <select class="form-control hasDatepicker form-control-line" id="id_tercero" name="id_tercero">
                        <option value="0" disabled selected>Consultar por nombre o identificacion</option>
                        <?php $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id_tercero); ?>"><?php echo e($d->getNameFull()); ?> (<?php echo e($d->cedula); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      
                    </select>
                    <script type="text/javascript">
                    $(document).ready(function() {
                    $("#id_tercero").select2({
                        width : '100%',
                    })
                });
                    </script>
                  </div>
            </div>

            <div class="col-sm-2">
                <br>
                <button type="submit" class="btn btn-info">Consultar</button>
            </div>

                    
            </div>
                  
          </div>
      </div>
  </div>
</div>
<?php echo e(Form::close()); ?>

<style type="text/css">
 .nav-item .active{
    color: blue !important;
 }
</style>
<?php if(isset($docente)): ?>


 <div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">  
                        
                <?php
                $imagen = 'assets/images/users/sin_foto.jpg';
                if ($docente->foto)$imagen = '../../files/'.$docente->cedula.'/'.$docente->foto;
                ?>
                <a> <img id="" target="Ver imagen" src="<?php echo e(asset($imagen)); ?>" class="img-circle" width="50" height="50" /> <b> <?php echo e(strtoupper($docente->getNameFull())); ?></b></a> 
                <br><br>
                <h3>Formatos pendientes</h3>
                <br>
                <div class="table-responsive">
                   <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link tab_header active" id="seg_pendientes-tab" data-toggle="tab" href="#seg_pendientes" role="tab" aria-controls="seg_pendientes"
                            aria-selected="true"><b>Seguimiento de asignatura</b></a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link tab_header" id="des_pendientes-tab" data-toggle="tab" href="#des_pendientes" role="tab" aria-controls="des_pendientes"
                            aria-selected="true"><b>Plan de desarrollo asignatura</b></a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link tab_header" id="tra_pendientes-tab" data-toggle="tab" href="#tra_pendientes" role="tab" aria-controls="tra_pendientes"
                            aria-selected="true"><b>Plan de trabajo</b></a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link tab_header" id="act_pendientes-tab" data-toggle="tab" href="#act_pendientes" role="tab" aria-controls="act_pendientes"
                            aria-selected="true"><b>Actividades complementarias</b></a>
                        </li>

                         <li class="nav-item">
                          <a class="nav-link tab_header" id="acc_pendientes-tab" data-toggle="tab" href="#acc_pendientes" role="tab" aria-controls="acc_pendientes"
                            aria-selected="true"><b>Plan de accion</b></a>
                        </li>
                        
                    </ul>


                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="seg_pendientes" role="tabpanel" aria-labelledby="seg_pendientes-tab">
                        <?php echo e(view('docente.listado_seguimientos_pendientes',compact('docente'))); ?>

                        </div>
                      </div>

                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="des_pendientes" role="tabpanel" aria-labelledby="des_pendientes-tab">
                        </div>
                      </div>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="tra_pendientes" role="tabpanel" aria-labelledby="tra_pendientes-tab">
                        </div>
                      </div>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="act_pendientes" role="tabpanel" aria-labelledby="act_pendientes-tab">
                        </div>
                      </div>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="acc_pendientes" role="tabpanel" aria-labelledby="acc_pendientes-tab">
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>                
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/fechas/plazo_extra_por_docente.blade.php ENDPATH**/ ?>
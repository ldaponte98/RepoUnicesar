<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<style type="text/css">
  .boton_personalizado{
    text-decoration: none;
    padding: 10px !important;
    font-weight: 600 !important;
    font-size: 20px !important;
    color: #ffffff !important;
    background-color: #6ab363 !important;
    border-radius: 6px !important;
    border: 2px solid #3e7541 !important;
    cursor: pointer !important;
  }
  .boton_personalizado:hover{
    color: #3e7541 !important;
    background-color: #ffffff !important;
  }
</style>

<center>
	<br>
	<img src="https://admin.googleusercontent.com/logo-scs-key1559651" height="100px">
	<br>
</center>

<center>
	<br>
	<table>
	<td><img src="https://app.clez.co/images/felicitaciones.gif" height="350px"></div></td>
	<td style="padding-left: 50px !important">
		<b><h1>¡Hola <?php echo e(ucfirst(strtolower($nombre_tercero))); ?>¡</h1></b>
		<p>El jefe de departamento reviso correctamente el informe de: </p>

        <?php if(isset($formato)): ?>
        <b><h3><?php echo e($formato); ?></h3></b>
        <?php endif; ?>
        <?php if(isset($asignatura)): ?>
        <label><b>Asignatura:</b> <?php echo e($asignatura); ?> </label><br>
        <?php endif; ?>
        <?php if(isset($grupo)): ?>
        <label><b>Grupo:</b> <?php echo e($grupo); ?> </label><br>
        <?php endif; ?>
        <?php if(isset($actividades_complementarias)): ?>
        <label><b>Actividades revisadas:</b> <?php echo e($actividades_complementarias); ?> </label><br>
        <?php endif; ?>
        <?php if(isset($corte)): ?>
        <label><b>Corte:</b> <?php echo e($corte); ?> </label><br>
        <?php endif; ?>
        <?php if(isset($periodo_academico)): ?>
        <label><b>Periodo academico:</b> <?php echo e($periodo_academico); ?> </label>
        <?php endif; ?>
		
	</td>
</table>

<a href="http://www2.unicesar.edu.co/unicesar/hermesoft/vortal/miVortal/logueo.jsp" class="boton_personalizado" style="text-decoration: none;
    padding-top: 10px !important;
    padding-bottom:  10px !important;
    padding-left:  70px !important;
    padding-right:  70px !important;
    font-weight: 600 !important;
    font-size: 20px !important;
    color: #ffffff !important;
    background-color: #6ab363 !important;
    border-radius: 6px !important;
    border: 2px solid #3e7541 !important;
    cursor: pointer !important;
    ">Vortal</a>
    <br><br>
</center>


<?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/email/email_formato_revisado.blade.php ENDPATH**/ ?>
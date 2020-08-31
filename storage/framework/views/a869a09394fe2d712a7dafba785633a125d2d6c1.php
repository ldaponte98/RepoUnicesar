<!DOCTYPE html>
<html>
<head>
	<title>Informe Actividades complementarias</title>
	<style>
		.page-break {
		    page-break-after: always;
		}
		*{
			font-family:'Helvetica','Verdana','Monaco',sans-serif;
		}
		
	</style>

</head>
<body>
	<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $pdf->text(430, 85, "$PAGE_NUM de $PAGE_COUNT", $font, 8.5);
        ');
    }
</script>
	   <center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-ACTCOM<?php echo e($actividad_complementaria->plan_trabajo->tercero->id_licencia); ?>-FOR<?php echo e($actividad_complementaria->id_actividad_complementaria); ?></td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 2</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center >
				  	<div style="margin-top: 10px">
				  INFORME DE ACTIVIDADES COMPLEMENTARIAS
				  	</div>
				  </center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;" >Pagina </td>
				 </tr>
			</table>
		</center>

<!--aca comienza la info del registro-->

<style type="text/css">
	div{
		margin-bottom: 10px;
	} 
	p{
		font-weight: bold;
		margin: 3px !important;
	}
	table{
		width: 100%;
	}

	.td_1{
		font-size: 14px;
		width: 1px;
		padding-top: 17px;
		margin-bottom: 0px;

	}
	.td_2{
		font-size: 14px;
		width: 1px;
		padding-top: 9px;
		margin-bottom: 0px;
	}
	.td_3{
		font-size: 14px;
		padding-top: 5px;
		width: 50%
	}
	.pegados_1{
		border-bottom: 0.5px solid #000000;
		margin-top: 8px;
		font-size: 14px;
		width: 100%;
		margin-left: 5px;
		margin-bottom: 0px;
		font-weight: bold;

	}
	.pegados_2{
		border-bottom: 0.5px solid #000000;
		margin-top: 5px;
		font-size: 12px;
		width: 100%;
		margin-left: 5px;
		margin-bottom: 0px;
		font-weight: bold;

	}
	.tabla_1 td{
		padding-left: 10px !important;
		padding-top: 3px !important;
		padding-bottom: 3px !important;
		font-size: 14px;
	}
	.tabla_1 th{
		padding-top: 5px !important;
		padding-bottom: 5px !important;
		font-size: 14px;
	}
	.tabla_4 td{
		padding-top: 3px !important;
		padding-bottom: 3px !important;
		font-size: 12px;
	}

	.tabla_2 td{
		padding-left: 10px !important;
		padding-top: 5px !important;
		padding-bottom: 5px !important;
		font-size: 10px;
	}

	.tabla_3 td{
		padding-top: 8px !important;
		padding-bottom: 8px !important;
		font-size: 10px;
	}

</style>

<br>
<?php
	$licencia = \App\Licencia::find(session('id_licencia'));
?>

<?php
	$corte = "No definido";
	if($actividad_complementaria->corte == 1) $corte = "Primer corte";
	if($actividad_complementaria->corte == 2) $corte = "Segundo corte";
	if($actividad_complementaria->corte == 3) $corte = "Tercer corte";


?>

<div style="text-align: right;"><b style="font-size: 14px;">PERIODO LECTIVO <?php echo e($actividad_complementaria->plan_trabajo->periodo_academico->periodo); ?></b></div>
<table class="tabla_1" border="1" cellpadding="0" cellspacing="0">
	<tr style="background-color: #ccffcc">
		<td colspan="16"><p>APELLIDOS Y NOMBRES: <?php echo e(strtoupper($actividad_complementaria->plan_trabajo->tercero->apellido)); ?> <?php echo e(strtoupper($actividad_complementaria->plan_trabajo->tercero->nombre)); ?> </p></td>
	</tr>
	<tr>
		<td colspan="4" style="width: 25% !important"><b>INFORME NUMERO: </b> </td>
		<td colspan="12"><?php echo e($corte); ?></td>
	</tr>
	<tr>
		<td colspan="4" style="width: 25% !important"><b>FECHA: </b> </td>
		<td colspan="12"><?php echo e($actividad_complementaria->get_ultima_fecha_actualizada($actividad_plan_trabajo->id_dominio_tipo)); ?></td>
	</tr>
	<tr>
		<td colspan="4" style="width: 25% !important"><b>TIPO DE ACTIVIDAD: </b> </td>
		<td colspan="12"><?php echo e($actividad_plan_trabajo->tipo->dominio); ?></td>
	</tr>
	<tr>
		<td colspan="4" style="width: 25% !important"><b>NOMBRE DE LA ACTIVIDAD: </b> </td>
		<td colspan="12"><b><?php echo e(strtoupper($actividad_plan_trabajo->nombre)); ?></b></td>
	</tr>
	<tr style="background-color: #ccffcc">
		<td colspan="16"><b>DESCRIPCION DEL INFORME: </b>(Escriba solo las actividades desarrolladas durante el tiempo correspondientes a este
informe, registrando la respectiva fecha de realización y el tipo de evidencia)</td>
	</tr>
	<tr>
		<th colspan="1"><center><b>N°</b></center></th>
		<th colspan="11"><center><b>Descripción de las acciones realizadas</b></center></th>
		<th colspan="2"><center><b>Evidencia (Anexar)</b></center></th>
		<th colspan="2"><center><b>Fecha</b></center></th>
	</tr>
	<?php
		$cont = 1;
	?>
	<?php $__currentLoopData = $actividad_complementaria->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($detalle->id_actividad_plan_trabajo == $actividad_plan_trabajo->id_actividad_plan_trabajo): ?>
			
			<tr>
				<th colspan="1" style="font-size: 12px;"><center><?php echo e($cont); ?></center></th>
				<td colspan="11"><?php echo e($detalle->descripcion); ?></td>
				<td colspan="2"><center><?php echo e($detalle->evidencia); ?> <?php if($detalle->link_evidencia and $detalle->link_evidencia != ""): ?>
					<br>
					<a  href="<?php echo e($detalle->link_evidencia); ?>"> Anexo </a>
				<?php endif; ?> </center></td>
				<td colspan="2"><center><?php echo e($detalle->fecha_evidencia); ?></center></td>

			</tr>

			<?php
				$cont++;
			?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>

<br><br>
<div style="border: 1px solid #000000; padding: 10px;">
	<table class="tabla_4">
	<tr>
		<td><b>OBSERVACIONES:</b></td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;</td>
	</tr>
</table>
</div>
<br><br><br>
<table border="0">
	<tr>
		<td colspan="2" style="border-top: 1px solid #000000; width: 50% !important"><center> FIRMA DEL PROFESOR </center></td>
		<td colspan="1"><center> &nbsp; </center></td>
		<td colspan="3" style="border-top: 1px solid #000000; width: 50% !important"><center>   DIRECTOR DE DEPARTAMENTO </center></td>
	</tr>
</table>



</body>
</html>
<?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/actividades_complementarias/pdf_actividades_complementarias.blade.php ENDPATH**/ ?>
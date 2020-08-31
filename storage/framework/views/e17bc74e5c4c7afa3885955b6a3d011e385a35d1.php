<!DOCTYPE html>
<html>
<head>
	<title>Informe Seguimiento Asignatura</title>

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
            $pdf->text(458, 83, "$PAGE_NUM de $PAGE_COUNT", $font, 8.5);
        ');
    }
</script>
	   <center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PRO<?php echo e($seguimiento->tercero->id_licencia); ?>-FOR<?php echo e($seguimiento->id_seguimiento); ?></td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 2</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center>
				  SEGUIMIENTO POR CORTE PLAN DESARROLLO DE ASIGNATURA
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
		border-bottom: 0.5px solid #000000;
		margin-top: 14px;
		font-size: 14px;
		width: 100%;
		margin-left: 5px;
		margin-bottom: 0px;
		font-weight: bold;

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
</style>

<br>

<div style="text-align: right;"><b style="font-size: 14px;"><?php echo e($seguimiento->getNameCorte()); ?></b></div>
<div><b style="font-size: 14px; text-decoration: underline;">1. DATOS GENERALES</b></div>
<table><tr><td class="td_1">PROFESOR: </td><td><p><?php echo e($seguimiento->tercero->getNameFull()); ?></p></td></tr></table>

<table><tr><td class="td_1">ASIGNATURA: </td><td colspan="3"><p><?php echo e($seguimiento->asignatura->nombre); ?></p></td>
<td class="td_1">GRUPO: </td><td><p><?php echo e($seguimiento->grupo->codigo); ?></p></td></tr></table>

<?php
	$programas = "";
	foreach ($seguimiento->asignatura->asignatura_programa as $asignatura_programa) {
		$programas .= " ".$asignatura_programa->programa->nombre.",";
	}
	$programas = substr($programas, 0, -1);
?>
<table><tr><td class="td_1" style="width: 240px">PROGRAMAS(S) ACADÊMICOS(S): </td><td><p style="font-size: 11px"><?php echo e($programas); ?></p></td></tr></table>

<table style="width: 70%"><tr><td class="td_1" style="width: 130px;">No. DE CRÉDITOS: </td><td><p style="width: 50px;"><?php echo e($seguimiento->asignatura->num_creditos); ?></p></td>
<td class="td_1" style="width: 160px; margin-left: 10px;">No. DE ESTUDIANTES: </td><td><p style="width: 50px;"><?php echo e($seguimiento->num_estudiantes); ?></td></tr></table>

<table><tr><td class="td_1">UNIDADES PROGRAMADAS DE LA ASIGNATURA (TODAS): </td></tr></table>
<?php if(count($seguimiento->unidades_programadas) > 0): ?>
	<table style="width: 100%">
		<?php
			$contador = 0;
			$is_impar_total = count($seguimiento->unidades_programadas);
			($is_impar_total%2==0) ? $is_impar_total = false : $is_impar_total = true;
		?>
		<?php $__currentLoopData = $seguimiento->unidades_programadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad_programada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
			$contador++;
				if ($contador%2!=0) {//es impar i lo pone a mano izquierda
					$fila = "<tr><td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 12px; width: 95%;'>".ucfirst(strtolower($unidad_programada->unidad_asignatura->nombre))."</p></td>";
				}else{
					$fila.= "<td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 12px'>".ucfirst(strtolower($unidad_programada->unidad_asignatura->nombre))."</p></td></tr>";
					echo $fila;
				}
				
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php
			if ($is_impar_total == true) echo $fila."</tr>";
		?>
	</table>
<?php endif; ?>
<br>

<div><b style="font-size: 14px; text-decoration: underline;">2. DESARROLLO DE ASIGNATURA</b></div>

<table><tr><td class="td_1">EJES TEMATICOS DESARROLLADOS: </td></tr></table>
<?php if(count($seguimiento->ejes_tematicos_desarrollados) > 0): ?>
	<table style="width: 100%">
		<?php
			$contador = 0;
			$is_impar_total = count($seguimiento->ejes_tematicos_desarrollados);
			($is_impar_total%2==0) ? $is_impar_total = false : $is_impar_total = true;
		?>
		<?php $__currentLoopData = $seguimiento->ejes_tematicos_desarrollados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eje_desarrollado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
			$contador++;
				if ($contador%2!=0) {//es impar i lo pone a mano izquierda
					$fila = "<tr><td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 11px; width: 95%;'>".ucfirst(strtolower($eje_desarrollado->eje_tematico->nombre))."</p></td>";
				}else{
					$fila.= "<td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 11px'>".ucfirst(strtolower($eje_desarrollado->eje_tematico->nombre))."</p></td></tr>";
					echo $fila;
				}
				
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php
			if ($is_impar_total == true) echo $fila."</tr>";
		?>
	</table>
<?php endif; ?>

<table><tr><td class="td_1">2.1. PORCENTAJE REAL DE DESARROLLO HASTA EL CORTE: A = <b><?php echo e($seguimiento->porcentaje_desarrollo); ?></b> </td></tr></table>
<table><tr><td class="td_1">2.2. PORCENTAJE IDEAL DE DESARROLLO A LA FECHA: B = <b><?php echo e($seguimiento->porcentaje_ideal); ?></b> </td></tr></table>
<table><tr><td class="td_1">2.3. RELACION ENTRE LO REAL Y LO IDEAL: R = <b><?php echo e($seguimiento->relacion_ideal_real); ?></b> </td></tr></table>


<div class="page-break"></div>
	   <center>
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				 <tr>
				  <td rowspan="3"><center><img width="50px" height="50px" src="Imagenes/iconoupc.png"></center></td>
				  <td rowspan="2" colspan="4" style="padding-top: 8px; padding-bottom: 8px;"><center><b>UNIVERSIDAD POPULAR DEL CESAR</b></center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">CODIGO: 201-300-PRO05-FOR<?php echo e($seguimiento->id_seguimiento); ?></td>
				 </tr>
				 <tr>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;">VERSIÓN: 2</td> 
				 </tr>
				 <tr>
				  <td rowspan="1" colspan="4" style="font-size: 14px">
				  <center>
				  SEGUIMIENTO POR CORTE PLAN DESARROLLO DE ASIGNATURA
				  </center></td>
				  <td rowspan="1" style="font-size: 11px; padding-left: 5px;" >Pagina</td>
				 </tr>
			</table>
		</center>



<table><tr><td class="td_1">2.3.1. SI NO SE CUBRIÓ EL TOTAL DE LOS CONTENIDOS PROGRAMADOS, INDIQUE CAUSAS </td></tr></table>
<?php if(count($seguimiento->causas) > 0): ?>
	<table style="width: 100%">
		<?php
			$contador = 0;
			$is_impar_total = count($seguimiento->causas);
			($is_impar_total%2==0) ? $is_impar_total = false : $is_impar_total = true;
		?>
		<?php $__currentLoopData = $seguimiento->causas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $causas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
			$contador++;
				if ($contador%2!=0) {//es impar i lo pone a mano izquierda
					$fila = "<tr><td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 11px; width: 95%;'>".ucfirst(strtolower($causas->causa))."</p></td>";
				}else{
					$fila.= "<td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 11px'>".ucfirst(strtolower($causas->causa))."</p></td></tr>";
					echo $fila;
				}
				
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php
			if ($is_impar_total == true) echo $fila."</tr>";
		?>
	</table>
<?php endif; ?>
<br>

<div><b style="font-size: 14px; text-decoration: underline;">3. EFICIENCIA ACADEMICA DE LOS ESTUDIANTES</b></div>
<table style="width: 42%"><tr><td class="td_2" style="width: 245px;">PROMEDIO DE NOTAS OBTENIDAS: </td><td><p class='pegados_2' style="text-align: center;"><?php echo e($seguimiento->prom_notas); ?></p></td></tr></table>
<table style="width: 42%"><tr><td class="td_2" style="width: 248px;">No. DE ESTUDIANTES APROBADOS:</td><td><p class='pegados_2' style="text-align: center;"><?php echo e($seguimiento->aprobados); ?></p></td></tr></table>
<table style="width: 42%"><tr><td class="td_2" style="width: 255px;">No. DE ESTUDIANTES REPROBADOS:</td><td><p class='pegados_2' style="text-align: center;"><?php echo e($seguimiento->reprobados); ?></p></td></tr></table>



<table style="width: 70%"><tr><td class="td_2" style="width: 284px;">PORCENTAJE DE EFICIENCIA: Aprobados: </td><td><center><p class='pegados_2' style="width: 45px;"><?php if($seguimiento->num_estudiantes > 0): ?>
	<?php echo e(round(($seguimiento->aprobados/$seguimiento->num_estudiantes)*100)); ?>%
<?php endif; ?></p></center></td>
<td class="td_2" style="width: 80px; margin-left: 10px;">Reprobados: </td><td><center><p class='pegados_2' style="width: 45px;"><?php if($seguimiento->num_estudiantes > 0): ?>
	<?php echo e(round(($seguimiento->reprobados/$seguimiento->num_estudiantes)*100)); ?>%
<?php endif; ?></p></center></td></tr></table>


<table><tr><td class="td_1">ANÁLISIS CUALITATIVO DEL COMPORTAMIENTO ACADÉMICO DE LOS ESTUDIANTES: </td></tr></table>
<?php if(count($seguimiento->analisis_cualitativo) > 0): ?>
	<table style="width: 100%">
		<?php
			$contador = 0;
			$is_impar_total = count($seguimiento->analisis_cualitativo);
			($is_impar_total%2==0) ? $is_impar_total = false : $is_impar_total = true;
		?>
		<?php $__currentLoopData = $seguimiento->analisis_cualitativo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
			$contador++;
				if ($contador%2!=0) {//es impar i lo pone a mano izquierda
					$fila = "<tr><td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 11px; width: 95%;'>".ucfirst(strtolower($analisis->analisis))."</p></td>";
				}else{
					$fila.= "<td class='td_2'>".$contador.". </td><td><p class='pegados_1' style='font-size: 11px'>".ucfirst(strtolower($analisis->analisis))."</p></td></tr>";
					echo $fila;
				}
				
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php
			if ($is_impar_total == true) echo $fila."</tr>";
		?>
	</table>
<?php endif; ?>
<table><tr><td class="td_2">ESTRATEGIAS DIDÁCTICAS EXITOSAS QUE DESEE COMPARTIR CON SUS COLEGAS: </td></tr></table>
<table><tr><p class='pegados_2' style="width: 100%; margin-left:0px;  margin-top: 0px;"><?php echo e($seguimiento->estrategias_didacticas); ?></p></tr></table>
<table><tr><td class="td_2">ESTRATEGIAS EVALUATIVAS EXITOSAS QUE DESEE COMPARTIR CON SUS COLEGAS: </td></tr></table>
<table><tr><p class='pegados_2' style="width: 100%; margin-left:0px; margin-top: 0px;"><?php echo e($seguimiento->estrategias_evaluativas); ?></p></tr></table>
<br>
<div><b style="font-size: 14px; text-decoration: underline;">4. COMPROMISOS</b></div>

<table><tr><td class="td_2">EN EL CASO QUE R MENOR A 100%.ESTRATEGIAS PARA DESARROLLAR RACIONALMENTE, EL 100%
DEL CONTENIDO PROGRAMATICO. </td></tr></table>
<table><tr><p class='pegados_2' style="width: 100%; margin-left:0px;  margin-top: 0px;"><?php echo e($seguimiento->estrategias_desa_cont_programatico); ?></p></tr></table>
<table><tr><td class="td_2">SI EL PORCENTAJE DE EFICIENCIA ES “CRITICO”. ESTRATEGIAS (NO REDUCIR RIGOR
ACADEMICO NI CIENTIFICO) PARA MEJOR EFICIENCIA ACADEMICA. </td></tr></table>
<table><tr><p class='pegados_2' style="width: 100%; margin-left:0px; margin-top: 0px;"><?php echo e($seguimiento->si_porc_efi_critico); ?></p></tr></table>
<table><tr><td class="td_2">SUGERENCIAS U OBSERVACIONES GENERALES: </td></tr></table>
<table><tr><p class='pegados_2' style="width: 100%; margin-left:0px; margin-top: 0px;"><?php echo e($seguimiento->sugerencias); ?></p></tr></table>

<br><br>


<br><br>
<table>
	<tr>
		<td colspan="2" style="border-top: 1px solid #000000; width: 50% !important"><center> DIRECTOR DE DEPARTAMENTO </center></td>
		<td colspan="1"><center> &nbsp; </center></td>
		<td colspan="3" style="border-top: 1px solid #000000; width: 50% !important"><center>   DOCENTE </center></td>
	</tr>
</table>
	<br>
<table><tr><td class="td_1">FECHA: </td><td><p style="width: 200px;"><?php echo e(date('d-m-Y',strtotime($seguimiento->fecha))); ?></p></td></tr></table>



</body>
</html><?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/seguimiento_asignatura/pdf_seguimiento.blade.php ENDPATH**/ ?>
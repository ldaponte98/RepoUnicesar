<?php
require 'fpdf/fpdf.php';
require("../Paginas/cnx.php");
session_start();
$cod = $_POST['x'];
$cl = new cnx();
$conn = $cl->conexion();
$consulta1 = "SELECT * ,DATE_FORMAT(fecha, '%d/%m/%Y') AS fechaok FROM seguimiento_asignatura WHERE cod = '$cod' ";
$resultado1 = $conn->query($consulta1);
$seguimiento = $resultado1->fetch_assoc();
$porcAprobados =($seguimiento['aprobados']/$seguimiento['num_estudiantes']) * 100;
$porcAprobados = round($porcAprobados, 1);
$porcReprobados =($seguimiento['reprobados']/$seguimiento['num_estudiantes']) * 100;
$porcReprobados = round($porcReprobados, 1);
$consulta2 = mysqli_query($conn,"SELECT *,DATE_FORMAT(fechafinal1, '%d-%m-%Y') as f1,DATE_FORMAT(fechafinal2, '%d-%m-%Y') as f2,DATE_FORMAT(fechafinal3, '%d-%m-%Y') as f3 FROM periodo_academico p, grupo g where p.cod=g.periodo_academico and g.id ='$seguimiento[grupo]'");
$fechas = $consulta2->fetch_assoc();
$corteval = $seguimiento['corte'];
if ($corteval=='1') {
    $cortever = 'PRIMER CORTE';
    $fechacierre = $fechas['f1'];
}elseif ($corteval=='2') {
    $cortever = 'SEGUNDO CORTE';
    $fechacierre = $fechas['f2'];
}elseif ($corteval=='3') {
    $cortever = 'TERCER CORTE';
    $fechacierre = $fechas['f3'];
}

$consulta3 =  "SELECT * FROM asignatura where cod = '$seguimiento[asignatura]'";
$resultado3 = $conn->query($consulta3);
$asignatura = $resultado3->fetch_assoc();


$consulta4 =  "SELECT * from docente where cedula = '$seguimiento[cedula]' ";
$resultado4 = $conn->query($consulta4);       
$docente = $resultado4->fetch_assoc();

$consulta5 =  "SELECT codigo FROM grupo WHERE id='$seguimiento[grupo]' ";
$resultado5 = $conn->query($consulta5); 
$result = $resultado5->fetch_assoc();

$consulta6 =  "SELECT p.nombre as programa from int_pro_asi ipa, programa p where ipa.cod_asi = '$seguimiento[asignatura]' and ipa.cod_pro = p.cod ";
$resultado6 = $conn->query($consulta6); 
$bandera = mysqli_num_rows($resultado6);
$cont1 = 1;  
$programas='';    
while ($row = $resultado6->fetch_assoc()) {                    
if ($cont1==$bandera) {
 $programas .= utf8_decode($row['programa']. '. ');
}else{
 $programas .= utf8_decode($row['programa']. ', ');
$cont1++;
}                                           
 }
                                

 $consulta7 =  "SELECT u.unidad FROM unidades_programadas_seg_asig ud, unidadesmateria u WHERE ud.cod_seg_asig = '$cod' and u.cod = ud.unidad";
$resultado7 = $conn->query($consulta7);
$numUnidades = mysqli_num_rows($resultado7);                                     

$consulta8 =  "SELECT * FROM eje_tematico_desarrollado WHERE cod_seg_asig = '$cod'";
$resultado8 = $conn->query($consulta8);

$consulta9 =  "SELECT * FROM causas_seg_asig WHERE cod_seg_asig = '$cod'";
$resultado9 = $conn->query($consulta9);

$consulta10 =  "SELECT * FROM analisis_cualitativo WHERE cod_seg = '$cod'";
$resultado10 = $conn->query($consulta10);

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->SetLeftMargin(20);

$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Image("iconoupc.png",24,13.5,17,17);
$pdf->Cell(25, 25, "", 1, 0, 'C');
$pdf->Cell(100, 15, "UNIVERSIDAD POPULAR DEL CESAR", 1, 1, 'C');
$pdf->SetX(45);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(100, 5, "SEGUIMIENTO POR CORTE PLAN
DESARROLLO DE ASIGNATURA", 1, 'C',0);
$pdf->SetY(10);
$pdf->SetX(145);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(45, 8, "CODIGO: 201-FOR0".$seguimiento['cod'], 1,'L',0);
$pdf->SetY(18);
$pdf->SetX(145);
$pdf->MultiCell(45, 7, 'VERSION: 1', 1,'L',0);
$pdf->SetY(25);
$pdf->SetX(145);
$pdf->MultiCell(45, 10, 'PAGINA: '.$pdf->PageNo(), 1,'L',0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(171, 15, "$cortever"."  $fechas[periodo]", 0, 1, 'R');
$pdf->SetFont('Arial','UB',10);
$pdf->Cell(171, 10, "1. DATOS GENERALES", 0, 1, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(25, 3, "PROFESOR: ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(140, 3, $docente['Nombre'] . " " . $docente['Apellido'], 'B', 1, 'L');
$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(27, 3, "ASIGNATURA: ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(100, 3, $asignatura['cod'] ." - ". $asignatura['nombre'], 'B', 0, 'L');
$pdf->Cell(18, 3, "GRUPO: ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20, 3, $result['codigo'] , 'B', 1, 'L');
$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->Cell(57, 3, "PROGRAMA(S) ACADEMICO(S): ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);

$pdf->MultiCell(108, 3, $programas, 'B','L',0 );
$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->Cell(35, 3, utf8_decode("No. DE CRÉDITOS: "), 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['num_creditos'], 'B', 0, 'C');
$pdf->Cell(6, 5, "", 0, 0, 'C');
$pdf->Cell(41, 3, utf8_decode("No. DE ESTUDIANTES: "), 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['num_estudiantes'], 'B', 1, 'C');
$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->Cell(63, 3, utf8_decode("No. DE UNIDADES PROGRAMADAS: "), 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $numUnidades, 'B', 0, 'C');
$pdf->Cell(6, 10, "", 0, 1, 'C');
$pdf->Cell(57, 3, "UNIDADES PROGRAMADAS:", 0, 1, 'L');
$pdf->Cell(6, 5, "", 0, 1, 'C');
$i1=1;
while ($row = $resultado7->fetch_assoc()) {

$unidad = utf8_encode($row['unidad']);
$pdf->Cell(5, 3, $i1.". ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
if ($i1%2==0) {
$pdf->Cell(78, 3, $unidad, 'B', 1,'L');
$pdf->Cell(5, 2, "", 0, 1, 'C');
}else{
$pdf->Cell(70, 3, $unidad, 'B', 0, 'L');
$pdf->Cell(6, 3, "", 0, 0, 'C');
}
     $i1++;
 }



$pdf->Cell(5, 10, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(57, 3, "EJES TEMATICOS DESARROLLADOS:", 0, 1, 'L');
$pdf->Cell(6, 5, "", 0, 1, 'C');
$i=1;
while ($row = $resultado8->fetch_assoc()) {
$eje = utf8_decode($row['eje']);
$pdf->Cell(5, 3, $i.". ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(110, 3, $eje, 'B','L',0);
$pdf->Cell(5, 5, "", 0, 1, 'C');
 
$i++;                                        
}

$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(97, 3, "PORCENTAJE DE DESARROLLO A LA ASIGNATURA (A):", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['porcentaje_desarrollo'], 'B', 0, 'C');

$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(97, 3, "PORCENTAJE IDEAL DE DESARROLLO A LA FECHA (B):", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['porcentaje_ideal'], 'B', 0, 'C');
$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(80, 3, "RELACION ENTRE LO REAL Y LO IDEAL (A/B):", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['relacion_ideal_real'], 'B', 0, 'C');

$pdf->Cell(5, 10, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(105, 3, utf8_decode("SI NO SE CUBRIÓ EL TOTAL DE LOS CONTENIDOS PROGRAMADOS,INDIQUE CAUSAS:"), 0, 1, 'L');
$pdf->Cell(6, 3, "", 0, 1, 'C');
$i=1;
if (mysqli_num_rows($resultado9)=='0') {
$pdf->Cell(5, 3, "Ninguna", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
}else{
while ($row = $resultado9->fetch_assoc()) {
$causa = utf8_encode($row['causa']);
$pdf->Cell(5, 3, $i.". ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
if ($i%2==0) {
$pdf->Cell(78, 3, $causa, 'B', 1,'L');
$pdf->Cell(5, 2, "", 0, 1, 'C');
}else{
$pdf->Cell(70, 3, $causa, 'B', 0, 'L');
$pdf->Cell(6, 3, "", 0, 0, 'C');
}
$i++;
 }
 }

$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->SetFont('Arial','UB',10);
$pdf->Cell(171, 10, "3.  EFICIENCIA ACADEMICA DE LOS ESTUDIANTES", 0, 1, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(73, 3, "PROMEDIO DE NOTAS OBTENIDAS:", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['prom_notas'], 'B', 1, 'C');
$pdf->Cell(5, 2, "", 0, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(86, 3, "PORCENTAJE DE EFICIENCIA: Aprobados (".$porcAprobados."%) :  ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['aprobados'], 'B', 0, 'C');
$pdf->Cell(5, 2, "", 0, 0, 'C');
$pdf->Cell(37, 3, "Reprobados (".$porcReprobados."%) :  ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(15, 3, $seguimiento['reprobados'], 'B', 1, 'C');
$pdf->Cell(5, 5, "", 0, 1, 'C');
$pdf->Cell(171, 10, utf8_decode("ANÁLISIS CUALITATIVO DEL COMPORTAMIENTO ACADÉMICO DE LOS ESTUDIANTES:
"), 0, 1, 'L');
$i=1;
while ($row = $resultado10->fetch_assoc()) {
$ana = utf8_decode($row['analisis']);
$pdf->Cell(5, 3, $i.". ", 0, 0, 'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(110, 3, $ana, 'B','L',0);
$pdf->Cell(5, 5, "", 0, 1, 'C');
 
$i++;                                        
}

$pdf->Cell(5, 6, "", 0, 1, 'C');
$pdf->Cell(171, 10, utf8_decode("ESTRATEGIAS DIDÁCTICAS EXITOSAS QUE DESEE COMPARTIR CON SUS COLEGAS:
"), 0, 1, 'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(171, 4, utf8_decode($seguimiento['estrategias_didacticas']), 'B', 'L',0 );

$pdf->Cell(5, 6, "", 0, 1, 'C');
$pdf->Cell(171, 10, utf8_decode("ESTRATEGIAS EVALUATIVAS EXITOSAS QUE DESEE COMPARTIR CON SUS COLEGAS:
"), 0, 1, 'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(171, 4, utf8_decode($seguimiento['estrategias_evaluativas']), 'B', 'L',0 );

$pdf->Cell(5, 6, "", 0, 1, 'C');
$pdf->SetFont('Arial','UB',10);
$pdf->Cell(171, 10, "4. COMPROMISOS", 0, 1, 'L');
$pdf->SetFont('Arial','',10);

$pdf->Cell(5, 6, "", 0, 1, 'C');
$pdf->MultiCell(171, 5, utf8_decode("EN EL CASO QUE R<1. ESTRATEGIAS PARA DESARROLLAR RACIONALMENTE, EL 100%
DEL CONTENIDO PROGRAMATICO.
"), 0,'L',0 );
$pdf->SetFont('Arial','',10);
$pdf->Cell(5, 3, "", 0, 1, 'C');
$pdf->MultiCell(171, 5, utf8_decode($seguimiento['estrategias_desa_cont_programatico']), 'B', 'L',0 );

$pdf->Cell(5, 6, "", 0, 1, 'C');
$pdf->MultiCell(171, 5, utf8_decode("SI EL PORCENTAJE DE EFICIENCIA ES 'CRITICO'. ESTRATEGIAS (NO REDUCIR RIGOR
ACADEMICO NI CIENTIFICO) PARA MEJOR EFICIENCIA ACADEMICA.
"), 0,'L',0 );
$pdf->SetFont('Arial','',10);
$pdf->Cell(5, 3, "", 0, 1, 'C');
$pdf->MultiCell(171, 5, utf8_decode($seguimiento['si_porc_efi_critico']), 'B', 'L',0 );

$pdf->Cell(5, 6, "", 0, 1, 'C');
$pdf->MultiCell(171, 5, utf8_decode("SUGERENCIAS U OBSERVACIONES GENERALES: "), 0,'L',0 );
$pdf->SetFont('Arial','',10);
$pdf->Cell(5, 3, "", 0, 1, 'C');
$pdf->MultiCell(171, 5, utf8_decode($seguimiento['sugerencias']), 'B', 'L',0 );

$pdf->Cell(5, 30, "", 0, 1, 'C');
$pdf->Cell(10, 3, "", '', 0, 'C');
$pdf->Cell(55, 3, "", 'B', 0, 'C');
$pdf->Cell(40, 3, "", '', 0, 'C');
$pdf->Cell(55, 3, "", 'B', 1, 'C');
$pdf->Cell(10, 3, "", '', 0, 'C');
$pdf->Cell(55, 5, "DOCENTE", '', 0, 'C');
$pdf->Cell(41, 3, "", '', 0, 'C');
$pdf->Cell(55, 5, "DIRECTOR DE DEPARTAMENTO
", '', 1, 'C');
$pdf->Cell(5, 10, "", 0, 1, 'C');
$pdf->Cell(15, 5, "FECHA:", 0, 0, 'L');
$pdf->Cell(55, 5, $seguimiento['fechaok'], 'B', 1, '');
$pdf->Cell(5, 20, "", 0, 1, 'C');
$pdf->Cell(171, 2, "", 'B', 1, 'C');

$pdf->Cell(171, 1, "", 'B', 0, 'C');
$pdf->Output();
?>
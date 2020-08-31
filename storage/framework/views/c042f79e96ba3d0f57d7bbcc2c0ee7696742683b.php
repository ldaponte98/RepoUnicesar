

<!DOCTYPE html>
<html>
<head>
	<title>Repositorio Unicesar</title>
    <link rel="icon" type="image/png" sizes="30x30" href="<?php echo e(asset("Imagenes/iconoupc.png")); ?>">
    <title>Repositorio-Unicesar</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
	function imprimir(){
		document.title = 'Imprimir';
		
		$("#btnimp").fadeOut();
		window.print()
		$("#btnimp").fadeIn();
		$("#panel1").fadeIn();
		document.title = 'Imprimir';
	}
</script>

	<style type="text/css">

		@media  print {
    
    @page  { margin: 0; }
}

		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed,
		figure, figcaption, footer, header, hgroup,
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}

		html {
			line-height: 1;
		}

		ol, ul {
			list-style: none;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		caption, th, td {
			text-align: left;
			font-weight: normal;
			vertical-align: middle;
		}

		q, blockquote {
			quotes: none;
		}
		q:before, q:after, blockquote:before, blockquote:after {
			content: "";
			content: none;
		}

		a img {
			border: none;
		}

		article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
			display: block;
		}

		body {
			font-family: 'Source Sans Pro', sans-serif;
			font-weight: 300;
			font-size: 18px;
			margin: 0;
			padding: 0;
		}
		body a {
			text-decoration: none;
			color: inherit;
		}
		body a:hover {
			color: inherit;
			opacity: 0.7;
		}
		body .container {
			min-width: 500px;
			margin: 0 auto;
			padding: 0 20px;
		}
		body .clearfix:after {
			content: "";
			display: table;
			clear: both;
		}
		body .left {
			float: left;
		}
		body .right {
			float: right;
		}
		body .helper {
			display: inline-block;
			height: 100%;
			vertical-align: middle;
		}
		body .no-break {
			page-break-inside: avoid;
		}

		header {
			margin-top: 20px;
			margin-bottom: 50px;
		}
		header figure {
			float: left;
			width: 60px;
			height: 60px;
			margin-right: 10px;
			background-color: white;
			border-radius: 50%;
			text-align: center;
		}
		header figure img {
			margin-top: 13px;
		}
		header .company-address {
			float: left;
			max-width: 150px;
			line-height: 1.7em;
		}
		header .company-address .title {
			color: #8BC34A;
			font-weight: 400;
			font-size: 1.5em;
			text-transform: uppercase;
		}
		header .company-contact {
			float: right;
			height: 60px;
			padding: 0 10px;
			background-color: #8BC34A;
			color: white;
		}
		header .company-contact span {
			display: inline-block;
			vertical-align: middle;
		}
		header .company-contact .circle {
			width: 20px;
			height: 20px;
			background-color: white;
			border-radius: 50%;
			text-align: center;
		}
		header .company-contact .circle img {
			vertical-align: middle;
		}
		header .company-contact .phone {
			height: 100%;
			margin-right: 20px;
		}
		header .company-contact .email {
			height: 100%;
			min-width: 100px;
			text-align: right;
		}

		section .details {
			margin-bottom: 55px;
		}
		section .details .client {
			width: 50%;
			line-height: 20px;
		}
		section .details .client .name {
			color: #8BC34A;
		}
		section .details .data {
			width: 50%;
			text-align: right;
		}
		section .details .title {
			margin-bottom: 15px;
			color: #8BC34A;
			font-size: 3em;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: 0.9166em;
		}
		section table .qty, section table .unit, section table .total {
			width: 15%;
		}
		section table .desc {
			width: 35%;
		}
		section table thead {
			display: table-header-group;
			vertical-align: middle;
			border-color: inherit;
		}
		section table thead th {
			padding: 5px 10px;
			background: #8BC34A;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #FFFFFF;
			text-align: right;
			color: white;
			font-weight: 900;
			text-transform: uppercase;
		}
		section table thead th:last-child {
			border-right: none;
		}
		section table thead .desc {
			text-align: left;
		}
		section table thead .qty {
			text-align: center;
		}
		section table tbody td {
			padding: 10px;
			background: #E8F3DB;
			color: #777777;
			text-align: right;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #E8F3DB;
		}
		section table tbody td:last-child {
			border-right: none;
		}
		section table tbody h3 {
			margin-bottom: 5px;
			color: #8BC34A;
			font-weight: 600;
		}
		section table tbody .desc {
			text-align: left;
		}
		section table tbody .qty {
			text-align: center;
		}
		section table.grand-total {
			margin-bottom: 45px;
		}
		section table.grand-total td {
			padding: 5px 10px;
			border: none;
			color: #777777;
			text-align: right;
		}
		section table.grand-total .desc {
			background-color: transparent;
		}
		section table.grand-total tr:last-child td {
			font-weight: 600;
			color: #8BC34A;
			font-size: 1.18181818181818em;
		}

		footer {
			margin-bottom: 20px;
		}
		footer .thanks {
			margin-bottom: 40px;
			color: #8BC34A;
			font-size: 1.16666666666667em;
			font-weight: 600;
		}
		footer .notice {
			margin-bottom: 25px;
		}
		footer .end {
			padding-top: 5px;
			border-top: 2px solid #8BC34A;
			text-align: center;
		}
	</style>
</head>

<body>
	<header class="clearfix">
		<div class="container">
			<figure>
				<img class="logo"  width="40" height="40" src="<?php echo e(asset('Imagenes/iconoupc.png')); ?>" alt="">
			</figure>
			<div class="company-address">
				<h2 class="title">Universidad Popular Del Cesar</h2>
				<p>
					<br>
					Departamento de Matematicas y Estadisticas
				</p>
			</div>
			<div id="panel1">
			<div class="company-contact">
				<div class="phone left">
					<span class="circle"><img src="data:image/svg+xml;charset=utf-8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zOnNrZXRjaD0iaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoL25zIg0KCSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjkuNzYycHgiIGhlaWdodD0iOS45NThweCINCgkgdmlld0JveD0iLTQuOTkyIDAuNTE5IDkuNzYyIDkuOTU4IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IC00Ljk5MiAwLjUxOSA5Ljc2MiA5Ljk1OCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8dGl0bGU+RmlsbCAxPC90aXRsZT4NCjxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPg0KPGcgaWQ9IlBhZ2UtMSIgc2tldGNoOnR5cGU9Ik1TUGFnZSI+DQoJPGcgaWQ9IklOVk9JQ0UtMSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTMwMS4wMDAwMDAsIC01NC4wMDAwMDApIiBza2V0Y2g6dHlwZT0iTVNBcnRib2FyZEdyb3VwIj4NCgkJPGcgaWQ9IlpBR0xBVkxKRSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMzAuMDAwMDAwLCAxNS4wMDAwMDApIiBza2V0Y2g6dHlwZT0iTVNMYXllckdyb3VwIj4NCgkJCTxnIGlkPSJLT05UQUtUSSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjY3LjAwMDAwMCwgMzUuMDAwMDAwKSIgc2tldGNoOnR5cGU9Ik1TU2hhcGVHcm91cCI+DQoJCQkJPGcgaWQ9Ik92YWwtMS1feDJCXy1GaWxsLTEiPg0KCQkJCQk8cGF0aCBpZD0iRmlsbC0xIiBmaWxsPSIjOEJDMzRBIiBkPSJNOC43NjUsMTIuMzc1YzAuMDIsMC4xNjItMC4wMjgsMC4zMDMtMC4xNDMsMC40MjJMNy4yNDYsMTQuMTkNCgkJCQkJCWMtMC4wNjIsMC4wNy0wLjE0MywwLjEzMy0wLjI0MywwLjE4MmMtMC4xMDEsMC4wNDktMC4xOTcsMC4wOC0wLjI5NSwwLjA5NGMtMC4wMDcsMC0wLjAyOCwwLTAuMDYyLDAuMDA0DQoJCQkJCQljLTAuMDM0LDAuMDA1LTAuMDgsMC4wMDgtMC4xMzQsMC4wMDhjLTAuMTMxLDAtMC4zNDMtMC4wMjMtMC42MzUtMC4wNjhjLTAuMjkzLTAuMDQ1LTAuNjUxLTAuMTU4LTEuMDc2LTAuMzM2DQoJCQkJCQljLTAuNDI0LTAuMTgyLTAuOTA0LTAuNDUxLTEuNDQyLTAuODA5Yy0wLjUzNi0wLjM1Ny0xLjEwOS0wLjg1Mi0xLjcxNi0xLjQ3OWMtMC40ODEtMC40ODQtMC44OC0wLjk1LTEuMTk4LTEuMzkzDQoJCQkJCQlDMC4xMjgsOS45NS0wLjEyNSw5LjU0MS0wLjMxOSw5LjE2NGMtMC4xOTMtMC4zNzYtMC4zMzgtMC43MTctMC40MzQtMS4wMjNjLTAuMDk3LTAuMzA2LTAuMTYxLTAuNTctMC4xOTUtMC43OTINCgkJCQkJCWMtMC4wMzUtMC4yMjEtMC4wNS0wLjM5NC0wLjA0Mi0wLjUyMWMwLjAwNy0wLjEyNiwwLjAxLTAuMTk3LDAuMDEtMC4yMTFjMC4wMTQtMC4wOTksMC4wNDQtMC4xOTgsMC4wOTMtMC4zMDENCgkJCQkJCWMwLjA0OS0wLjEwMSwwLjEwOC0wLjE4NCwwLjE3Ni0wLjI0N2wxLjM3NS0xLjQwM2MwLjA5Ny0wLjA5OCwwLjIwNi0wLjE0NywwLjMzLTAuMTQ3YzAuMDksMCwwLjE2OSwwLjAyNiwwLjIzOCwwLjA3OQ0KCQkJCQkJQzEuMyw0LjY0OCwxLjM1OSw0LjcxNCwxLjQwNiw0Ljc5MWwxLjEwNiwyLjE0MWMwLjA2MiwwLjExNCwwLjA4LDAuMjM1LDAuMDUyLDAuMzdDMi41MzgsNy40MzYsMi40NzgsNy41NDgsMi4zODksNy42NA0KCQkJCQkJTDEuODgzLDguMTU3QzEuODY5LDguMTcxLDEuODU2LDguMTk0LDEuODQ2LDguMjI2QzEuODM1LDguMjU2LDEuODMsOC4yODMsMS44Myw4LjMwNGMwLjAyNywwLjE0NywwLjA5LDAuMzE3LDAuMTg3LDAuNTA3DQoJCQkJCQljMC4wODIsMC4xNjksMC4yMSwwLjM3NSwwLjM4MiwwLjYxOGMwLjE3MiwwLjI0MywwLjQxNywwLjUyMSwwLjczNCwwLjgzOWMwLjMxMSwwLjMyMiwwLjU4NSwwLjU3NCwwLjgyOCwwLjc1NQ0KCQkJCQkJYzAuMjQsMC4xNzgsMC40NDMsMC4zMDksMC42MDQsMC4zOTVjMC4xNjIsMC4wODUsMC4yODYsMC4xMzUsMC4zNzIsMC4xNTRsMC4xMjgsMC4wMjRjMC4wMTUsMCwwLjAzOC0wLjAwNiwwLjA2Ny0wLjAxNg0KCQkJCQkJYzAuMDMyLTAuMDEsMC4wNTQtMC4wMjEsMC4wNjctMC4wMzdsMC41ODgtMC42MTJjMC4xMjUtMC4xMTIsMC4yNy0wLjE2OCwwLjQzNi0wLjE2OGMwLjExNywwLDAuMjA3LDAuMDIxLDAuMjc3LDAuMDYxaDAuMDENCgkJCQkJCWwxLjk5NSwxLjIwM0M4LjY1MSwxMi4xMiw4LjczNywxMi4yMzQsOC43NjUsMTIuMzc1TDguNzY1LDEyLjM3NXoiLz4NCgkJCQk8L2c+DQoJCQk8L2c+DQoJCTwvZz4NCgk8L2c+DQo8L2c+DQo8L3N2Zz4NCg==" alt=""><span class="helper"></span></span>
					<?php
						$licencia = \App\Licencia::find(session('id_licencia'));
					?>
					<a href="tel:5849309">(+57) <?php echo e($licencia->telefono); ?></a>
					<span class="helper"></span>
				</div>
				<div class="email right">
					<span class="circle"><img src="data:image/svg+xml;charset=utf-8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zOnNrZXRjaD0iaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoL25zIg0KCSB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE0LjE3M3B4Ig0KCSBoZWlnaHQ9IjE0LjE3M3B4IiB2aWV3Qm94PSIwLjM1NCAtMi4yNzIgMTQuMTczIDE0LjE3MyIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwLjM1NCAtMi4yNzIgMTQuMTczIDE0LjE3MyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSINCgk+DQo8dGl0bGU+ZW1haWwxOTwvdGl0bGU+DQo8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4NCjxnIGlkPSJQYWdlLTEiIHNrZXRjaDp0eXBlPSJNU1BhZ2UiPg0KCTxnIGlkPSJJTlZPSUNFLTEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC00MTcuMDAwMDAwLCAtNTUuMDAwMDAwKSIgc2tldGNoOnR5cGU9Ik1TQXJ0Ym9hcmRHcm91cCI+DQoJCTxnIGlkPSJaQUdMQVZMSkUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMwLjAwMDAwMCwgMTUuMDAwMDAwKSIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCI+DQoJCQk8ZyBpZD0iS09OVEFLVEkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDI2Ny4wMDAwMDAsIDM1LjAwMDAwMCkiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPg0KCQkJCTxnIGlkPSJPdmFsLTEtX3gyQl8tZW1haWwxOSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTE3LjAwMDAwMCwgMC4wMDAwMDApIj4NCgkJCQkJPHBhdGggaWQ9ImVtYWlsMTkiIGZpbGw9IiM4QkMzNEEiIGQ9Ik0zLjM1NCwxNC4yODFoMTQuMTczVjUuMzQ2SDMuMzU0VjE0LjI4MXogTTEwLjQ0LDEwLjg2M0w0LjYyNyw2LjAwOGgxMS42MjZMMTAuNDQsMTAuODYzDQoJCQkJCQl6IE04LjEyNSw5LjgxMkw0LjA1LDEzLjIxN1Y2LjQwOUw4LjEyNSw5LjgxMnogTTguNjUzLDEwLjI1M2wxLjc4OCwxLjQ5M2wxLjc4Ny0xLjQ5M2w0LjAyOSwzLjM2Nkg0LjYyNEw4LjY1MywxMC4yNTN6DQoJCQkJCQkgTTEyLjc1NSw5LjgxMmw0LjA3NS0zLjQwM3Y2LjgwOEwxMi43NTUsOS44MTJ6Ii8+DQoJCQkJPC9nPg0KCQkJPC9nPg0KCQk8L2c+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo=" alt=""><span class="helper"></span></span>
					<a ><?php echo e($licencia->email); ?></a>
					<span class="helper"></span>
				</div>
			</div>
			</div>
		</div>
	</header>

	<section>
		<div class="container">
			<div class="details clearfix">
				<div class="client left">
					<p>REPORTE DE: </p>
					<p class="name"><?php echo e($seguimiento->tercero->getnameFull()); ?> </p>
					<p>Tipo de vinculacion: <?php echo e($seguimiento->tercero->servicio); ?></p>
					<a href="https://accounts.google.com/signin/v2/identifier?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin"><?php echo e($seguimiento->tercero->email); ?></a>
				</div>
				<div class="data right">
					<div class="title">Seguimiento de grupo</div>
					<div class="date">
						Fecha de envio: <?php echo e($seguimiento->fecha); ?><br>
						Fecha de cierre: <?php
							if($seguimiento->corte == 1) echo $fechas->fechafinal1;
							if($seguimiento->corte == 2) echo $fechas->fechafinal2;
							if($seguimiento->corte == 3) echo $fechas->fechafinal3;
						?>
					</div>
				</div>
			</div><br>
			<br>
			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<th class="desc"><b><h1>DATOS GENERALES</h1></b></th>
						
				</thead>
			</table>
			<table border="0" cellspacing="0" cellpadding="0">
			
				<tbody>
					<tr>
						<td class="desc"><h3>Corte</h3><?php
							if($seguimiento->corte == 1) echo "Primer corte";
							if($seguimiento->corte == 2) echo "Segundo corte";
							if($seguimiento->corte == 3) echo "Tercer corte";
						?></td>
						<td class="desc"><h3>Periodo academico</h3><?php echo e($seguimiento->grupo->periodo_academico->periodo); ?></td>
						<td class="desc"></td>
						<td class="desc"></td>
						<td class="desc"></td>
					</tr>
					<tr>
						<td class="desc"><h3>Asignatura</h3><?php echo e($seguimiento->asignatura->nombre); ?></td>
						<td class="desc"><h3>Programas Academicos</h3>
						<?php
							$lista_programas = "";
							$lista_facultades = "";
							foreach ($seguimiento->asignatura->asignatura_programa as $intersecto) {
								$lista_programas .= $intersecto->programa->nombre.", ";
								$lista_facultades .= $intersecto->programa->facultad->nombre.", ";
							}
							$lista_programas[strlen($lista_programas) -2] = ".";
							$lista_facultades[strlen($lista_facultades) -2] = ".";
							echo $lista_programas;
						?>
						</td>
						<td class="desc"><h3>Facultades</h3>
						<?php
							echo $lista_facultades;
						?>
						</td>
						<td class="desc"></td>
						<td class="desc"></td>
					</tr>
					<tr>
						<td class="desc"><h3>Numero de creditos</h3><?php echo e($seguimiento->asignatura->num_creditos); ?></td>
						<td class="desc"><h3>Numero de estudiantes</h3><?php echo e($seguimiento->num_estudiantes); ?></td>
						<td class="desc"><h3>Grupo</h3>
							<?php echo e($seguimiento->grupo->codigo); ?>

							<td>
						<td class="desc"></td>
					</tr>
					<tr>
						<td class="desc" colspan="2"><h3>Unidades Programadas</h3>
							<?php $__currentLoopData = $seguimiento->unidades_programadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidad_programada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($unidad_programada->unidad_asignatura->nombre); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
						<td class="desc"></td>
						<td class="desc"></td>
						<td class="desc"></td>
					</tr>
										
				</tbody>
			</table>

			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<th class="desc"><b><h1>DESARROLLO DE LA ASIGNATURA</h1></b></th>				
				</thead>

			</table>

			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
						<td class="desc"><h3>Ejes tematicos desarrollados</h3>
							<?php $__currentLoopData = $seguimiento->ejes_tematicos_desarrollados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eje_tematico_desarrollado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($eje_tematico_desarrollado->eje_tematico->nombre); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
						<td class="desc"></td>
						<td class="desc"></td>
						<td class="desc"></td>
				</tr>
				
				<tr>
						<td class="desc"><h3>Porcentaje de desarrollo a la asigntura</h3>
							<?php echo e($seguimiento->porcentaje_desarrollo); ?></td>
						<td class="desc"><h3>Porcentaje ideal de desarrollo a la fecha</h3>
							<?php echo e($seguimiento->porcentaje_ideal); ?></td>
						<td class="desc"><h3>Relacion entre lo ideal y lo real</h3>
							<?php echo e($seguimiento->relacion_ideal_real); ?></td>
						<td class="desc"></td>
				</tr>
				<tr>
						<td class="desc"><h3>Causas por las cuales no se cumplio los contenidos programados</h3>
							<?php $__currentLoopData = $seguimiento->causas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $causa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($causa->causa); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
						<td class="desc"></td>
						<td class="desc"></td>
						<td class="desc"></td>
				</tr>
				<tr>
						<td class="desc"><h3>Promedio de notas obtenidas</h3>
							<?php echo e($seguimiento->prom_notas); ?></td>
						<td class="desc"><h3>Aprobados</h3>
							<?php echo e($seguimiento->aprobados); ?></td>
						<td class="desc"><h3>Reprobados</h3>
							<?php echo e($seguimiento->reprobados); ?></td>
						<td class="desc"></td>
				</tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
						<td style="width: 50%" class="desc"><h3>N° de estudiantes que superan el promedio</h3>
							<?php echo e($seguimiento->num_est_sup_promedio); ?></td>
						<td style="width: 50%" class="desc"><h3>N° de estudiantes que estan por debjao del promedio</h3>
							<?php echo e($seguimiento->num_est_no_sup_promedio); ?></td>
					</tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
						<td class="desc"><h3>Analisis cualitativo del comportamiento academico de los estudiantes</h3>
							<?php $__currentLoopData = $seguimiento->analisis_cualitativo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analisis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($analisis->analisis); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
						<td class="desc"><h3>Estrategias didacticas exitosas que desee compartir con sus COLEGAS</h3>
							<?php echo e($seguimiento->estrategias_didacticas); ?></td>
						<td class="desc"><h3>Estrategias evaluativas exitosas que desee compartir con sus colegas</h3>
							<?php echo e($seguimiento->estrategias_evaluativas); ?></td>
						<td class="desc"></td>
				</tr>
			</table>	

			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<th class="desc"><b><h1>COMPROMISOS</h1></b></th>				
				</thead>
			</table>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
						<td class="desc"><h3>Estrategiar para desarrollar racionalmente, el 100% del contenido programado</h3>
							<?php echo e($seguimiento->estrategias_desa_cont_programatico); ?></td>
						<td class="desc"><h3>Si el porcentaje de eficiencia es "critico". Estrategias para mejor eficiencia academica</h3>
							<?php echo e($seguimiento->si_porc_efi_critico); ?></td>
						<td class="desc"><h3>Observaciones o sugerencias</h3>
							<?php echo e($seguimiento->sugerencias); ?></td>
						<td class="desc"></td>
				</tr>
				
			</table>
		</div>


	</section>
   <br><br><br><br><br>
	<footer>
		<div class="container">
			<!--
<table width="100%">
	<tr>
		<td width="50%" align="center" >
			<div class="thanks" align="center">
			<b><hr width="70%" align="center"  style="background-color: black;"></b>Docente </div>
		</td>
		<td width="50%" align="center">
		
			<div class="thanks" align="center"><b><hr width="70%" align="center" style="background-color: black;">Director de departamento </b></div>

		</td>
	</tr>
</table>
-->
	<div align="center">
		<input  type="hidden" name="x" value="<?php echo e($seguimiento->id_asignatura); ?>">
		<a href="<?php echo e(route('seguimiento/imprimir', $seguimiento->id_seguimiento)); ?>" class="btn  btn-success" style="color: white; width: 90px;" target="_blank">   Imprimir  </a>
		<a  id="btnimp" href="javascript:history.back(1)" class="btn  btn-danger" style="color: white; width: 90px;">   Volver  </a>
		
            </div>
			<br><br><br><br>
			<div class="end">Universidad Popuar del Cesar - Departamento de matematicas y estadisticas</div>
		</div>
	</footer>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\RepoUnicesar\resources\views/seguimiento_asignatura/view.blade.php ENDPATH**/ ?>
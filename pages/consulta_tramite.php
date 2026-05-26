<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIAT</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link href="../css/tabler.min.css" rel="stylesheet">
	<link href="../css/tabler-flags.min.css" rel="stylesheet">
	<link href="../css/tabler-payments.min.css" rel="stylesheet">
	<link href="../css/tabler-vendors.min.css" rel="stylesheet">
	<link href="../css/demo.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../js/semantic.js"></script>
	<link rel="stylesheet" href="../css/semantic.min.css">
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
	<style type="text/css">
		header .overlay {
			width: 100%;
			height: 20%;
			padding: 50px;
			color: #FFF;
			text-shadow: 1px 1px 1px #333;
			background-image: linear-gradient(135deg, #9f05ff69 10%, #fd5e086b 100%);
		}

		.clockdate-wrapper {
			background-color: #333;
			padding: 5px;
			max-width: 450px;
			width: 100%;
			text-align: center;
			border-radius: 5px;
			margin: 0 auto;
			margin-top: 1%;
		}

		#clock {
			background-color: #fff;
			border-radius: 4px;
			font-family: sans-serif;
			font-size: 25px;
			text-shadow: 0px 0px 1px #fff;
			color: #000;
		}

		#clock span {
			color: #000;
			text-shadow: 0px 0px 1px #333;
			font-size: 10px;
			position: relative;
			top: -27px;
			left: -10px;
		}

		#date {
			background-color: #fff;
			border-radius: 4px;
			font-size: 25px;
			font-family: arial, sans-serif, italic;
			color: #000;
		}

		header {
			/* background: url('http://www.autodatz.com/wp-content/uploads/2017/05/Old-Car-Wallpapers-Hd-36-with-Old-Car-Wallpapers-Hd.jpg'); */
			text-align: center;
			width: 100%;
			height: auto;
			background-size: cover;
			background-attachment: fixed;
			position: relative;
			overflow: hidden;
			border-radius: 0 0 85% 85% / 30%;
		}



		.container-portada {
			width: 100%;
			height: 160px;
			position: relative;
			background-image: url('../img/alcaldia.jpeg');
			background-size: 100%;
			animation: movimiento 20s infinite linear alternate;
		}


		.capa-gradient {
			width: 100%;
			height: 100%;
			position: absolute;
			background: -webkit-linear-gradient(left, black, #0672d0);
			opacity: 0.5;
		}

		.container-details {
			width: 100%;
			max-width: 1200px;
			position: relative;
			margin: auto;
		}

		.details {
			width: 100%;
			max-width: 1100px;
			position: relative;
			top: 10px;
			color: white;
		}

		.details h1 {
			font-size: 40px;
			font-weight: 100;
			margin-left: 10px;
		}

		.details p {
			margin-top: 10px;
			font-size: 20px;
			font-weight: 100;
			margin-left: 10px;
		}

		.details button:hover {
			background: white;
			color: black;
		}

		.titulo {
			color: white;
			font-size: 280%;
			text-align: center;
			text-shadow: 0 0 0.2em #87F, 0 0 0.2em #87F, 0 0 0.2em #87F
		}

		.fuente {
			font-size: 0.975rem !important;
		}

		.imageniz {
			width: 22%;
		}

		.imagende {
			width: 40%
		}

		.divimageniz {
			width: 25%;
			margin-top: 1px;
		}

		.divcentro {

			width: 100%;
			text-align: center;
		}

		.divimagende {
			width: 25%;
			margin-top: 1px;
		}

		@keyframes movimiento {
			from {
				background-position: bottom left;
			}

			to {
				background-position: top right;
			}
		}



		@media screen and (max-width: 600px) {
			.container-portada {
				width: 100%;
				height: 80px;
				position: relative;
				background-image: url('../img/alcaldia.jpeg');
				background-size: 100%;
				animation: movimiento 20s infinite linear alternate;
			}

			.col {
				width: 100%;
			}

			.titulo {
				color: white;
				font-size: 120%;
				text-align: center;
				text-shadow: 0 0 0.2em #87F, 0 0 0.2em #87F, 0 0 0.2em #87F
			}

			.h1Titulo {
				font-size: 1.1rem;
			}

			.BotonBuscar {
				font-size: 1rem;
			}

			.h1Titulo2 {
				font-size: 0.5rem;
			}

			.h5Titulo {
				font-size: 1.15rem;
			}

			.etiquetaTitulo {
				font-size: 1.2rem;
				padding-left: 8px;
			}

			.etiquetaDatos {
				font-size: 0.9rem;
			}

			.ContentDatos {
				border-radius: 20px;
				border: 1px solid #17A2B8;
				width: 90%;
				margin: 0 auto;
			}

			.imageniz {
				width: 60%;
			}

			.imagende {
				width: 80%
			}

			.divimageniz {
				width: 25%;
				margin-top: 5px;
			}

			.divcentro {

				width: 100%;
				text-align: center;
			}

			.divimagende {
				width: 25%;
				margin-top: 5px;
			}
		}

		@media screen and (min-width: 600px) and (max-width: 700px) {
			.container-portada {
				width: 100%;
				height: 100px;
				position: relative;
				background-image: url('../img/alcaldia.jpeg');
				background-size: 100%;
				animation: movimiento 20s infinite linear alternate;
			}

			.col {
				width: 100%;
			}

			.titulo {
				color: white;
				font-size: 120%;
				text-align: center;
				text-shadow: 0 0 0.2em #87F, 0 0 0.2em #87F, 0 0 0.2em #87F
			}

			.h1Titulo {
				font-size: 1.1rem;
			}

			.imageniz {
				width: 40%;
			}

			.imagende {
				width: 70%
			}

			.divimageniz {
				width: 25%;
				margin-top: 20px;
			}

			.divcentro {

				width: 100%;
				text-align: center;
				/* margin-top: 30px; */
			}

			.divimagende {
				width: 25%;
				margin-top: 15px;
			}
		}


		/* ------END FECHA  Y HORA----- */


		/* Para Teclado de numeros */
		body {
			/* background-image: url("../img/fondo_consulta_tramite.jpg"); */
			background-image: url("../img/backgroundlogin.jpg");


			min-width: 200px;
			/* Background image is centered vertically and horizontally at all times */
			background-position: center center;

			/* Background image doesn't tile */
			background-repeat: no-repeat;

			/* Background image is fixed in the viewport so that it doesn't move when  the content's height is greater than the image's height */
			background-attachment: fixed;

			/* This is what makes the background image rescale based on the container's size */
			background-size: cover;

			/* Set a background color that will be displayed while the background image is loading */
			background-color: #464646;

		}

		#Principal {
			width: 100%;
			/* height: 100%; */
			height: auto;
			display: flex;
			justify-content: center;
			/* align-items: center; */
			/* padding-top: 5px; */
		}

		#Calculadora {
			/* background-color: #d7d7d7;
			opacity: 0.9; */

			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
		}

		#Pantalla {
			background: white;
			background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
			font-size: 20px;
			height: 100px;
			width: 100%;
			border: 0;
			margin: 0;
			text-align: right;
			padding: 10px;
			color: white;
			font-family: 'Roboto Condensed', sans-serif;
		}

		#Teclado {
			background: #ffffff;
			opacity: 0.8;
		}

		#Teclado .button {
			font-size: 2rem;
		}

		.button {
			background: #e3e3e3;
			opacity: 0.8;
			font-family: 'Roboto Condensed', sans-serif;
			font-size: 20px;
			margin: 0;
			padding: 15px;
			border: 0;
			color: #202031;
			width: 100px;
			height: 100px;
			min-width: 10px;
			min-height: 10px;
			transition: all .2s ease-in-out;
			-webkit-transition: all .2s ease-in-out;
			-moz-transition: all .2s ease-in-out;
		}

		.button:hover {
			transform: scale(1.1);
			background: #fae4e4;
			border-radius: 5px;
			opacity: 0.7;
			color: #101018;
			-webkit-transform: scale(1.1);
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.2);
		}

		.button:active {
			transform: scale(1);
		}
	</style>
</head>

<body onload="startTime()" class="theme-light">

	<div style="background: #f2f9ff; width: 50%; height: auto; opacity: 0.9 ; padding: 1rem 1rem 3rem 1rem; border-radius: 3rem; ">

		<div class="divcentro">
			<img style="max-height: 7rem; width:auto; opacity: 0.8 !important; " src="../img/logo_gamealt.png" class="imagende">
		</div>
		<div>
			<center>
				<h2 class="h1Titulo2" style="color:#d7d7d7; margin-bottom:10px;">
					<p>SEGUIMIENTO A SU TRÁMITE</p>
				</h2>
			</center>
		</div>
		<div id="Principal">
			<div id="Calculadora">
				<div class="col-auto ms-auto d-print-none">
					<form class="ui form" id="form_search" method="GET">
						<div class="d-flex">
							<!-- <div class="me-6">--><input type="text" value="" id="dtm_value" name="dtm_value" class="form-control" style="margin-top: 8px;  width:auto; margin-left:15px; margin-right:10px; " placeholder="Introduzca Nro. de tramite"><select class="custom-select form-control-sm fuente" id="gestion" name="gestion" style="height: auto; margin-top: 8px; width:100%; margin-right:15px; padding:3; border-radius:5px;" aria-invalid="false">
								<option value="2023">2023</option>
								<option value="2024" selected="selected">2024</option>
							</select>
							<!-- </div>-->
						</div><button type="submit" class="btn btn-primary" id="submit_dtm" style="margin-top: 8px; margin-left:13px; margin-right:13px;  width:90%;"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<circle cx="10" cy="10" r="7"></circle>
								<line x1="21" y1="21" x2="15" y2="15"></line>
							</svg>BUSCAR </button>
					</form>
				</div>
				<div id="Teclado" class="buttons">
					<button class="button" value="7">7</button><button class="button" value="8">8</button><button class="button" value="9">9</button><br>
					<button class="button" value="4">4</button><button class="button" value="5">5</button><button class="button" value="6">6</button><br>
					<button class="button" value="1">1</button><button class="button" value="2">2</button><button class="button" value="3">3</button><br>
					<button class="button" value="">&nbsp;</button><button class="button" value="0">0</button><button class="button" value="CE"><--< /button>
				</div>
				<!-- <button type="submit" class=" BotonBuscar btn btn-primary btn-lg btn-block p-3" id="search" name="search" style="margin-top: 1.666667%;"><i class="fas fa-search"></i><span class="BotonBuscar">BUSCAR</span></button>-->
			</div>
		</div>
		<div class="page-body" id="BodyContainer" style="display: none;">
			<div class="container-xl">
				<div class="row row-deck row-cards">
					<div class="col-12">
						<div class="card card-md">
							<div class="card-stamp card-stamp-lg">
								<div class="card-stamp-icon bg-primary"><img class="ui small image" src="../img/consulta_tramite/v_2.png"></div>
							</div>
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-12">
										<h1 class="h2">RESULTADO DE BUSQUEDA </h1>
										<div class="table-responsive">
											<table class="table table-vcenter card-table">
												<tbody>
													<tr>
														<td><img src="../img/consulta_tramite/folder.svg" width="21"><b>NRO. DTM:</b></td>
														<td class="text-muted" id="nro_dtm"></td>
													</tr>
													<tr>
														<td><img src="../img/consulta_tramite/home.svg" width="21"><b>UNIDAD EJECUTORA:</b></td>
														<td class="text-muted" id="uni_ejec"></td>
													</tr>
													<tr>
														<td><img src="../img/consulta_tramite/user.svg" width="21"><b>DESTINATARIO:</b></td>
														<td class="text-muted" id="destinatario"></td>
													</tr>
													<tr>
														<td><img src="../img/consulta_tramite/proceso.svg" width="21"><b>ESTADO:</b></td>
														<td class="text-muted" id="estado"></td>
													</tr>
													<tr>
														<td><img src="../img/consulta_tramite/documento.svg" width="21"><b>INSTRUCCION:<b></b></b></td>
														<td class="text-muted" id="instruccion"></td>
													</tr>
													<tr>
														<td><img src="../img/consulta_tramite/documento_rojo.svg" width="21"><b>OBSERVACIONES:<b></b></b></td>
														<td class="text-muted" id="obser"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<center>
								<div><button type="submit" class="btn btn-primary" id="ButtonRegresar" onclick="CerrarDatosConsulta()"><img src="../img/consulta_tramite/close2.png" alt="">CERRAR </button></div><br>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<script src="../js/tabler.min.js"></script>
	<script src="../js/demo.min.js"></script>
	<script>
		var ans = "";
		var clear = false;
		var calc = "";

		$(function() {
			divBody = document.getElementById('BodyContainer');
			divTeclado = document.getElementById('Principal');
			divBody.style.display = 'none';
			TxtBuscar = document.getElementById("dtm_value");
			TxtBuscar.focus();
		});
		var ans = "";
		var clear = false;
		var calc = "";

		$(document).ready(function() {
			$("button").click(function() {
				var text = $(this).attr("value");

				if (parseInt(text, 10) == text || text === "." || text === "/" || text === "*" || text === "-" || text === "+" || text === "%") {
					if (clear === false) {
						calc += text;
						$("#dtm_value").val(calc);
					} else {
						calc = text;
						$("#dtm_value").val(calc);
						clear = false;
					}
				} else if (text === "CE") {
					calc = calc.slice(0, -1);
					$("#dtm_value").val(calc);
				}
			});
		});

		function Limpiar() {
			calc = "";
			$("#dtm_value").val("");
			$('select#gestion option[value="2023"]').prop('selected', true);
		}

		$("#form_search").submit(function() {

			var dtm = $("#dtm_value").val();
			var gest = $("#gestion").val();
			var gestionComplemento = gest;
			event.preventDefault();
			console.log(gest);

			switch (gest) {
				case "2022":
					console.log("Esto es 2022");

					$.ajax({

						url: "http://siget.elalto.gob.bo/android/consultarDtm2022.php?cod_dtm=" + dtm,
						type: "GET",
						dataType: "JSON",
						beforeSend: function() {
								$('#submit_dtm').prop('disabled', true);
								$(".test").modal('show');
								divBody.style.display = 'none';
							}

							,
						success: function(obj) {
								data = JSON.parse(obj);

								if (data[0] == null) {
									alertify.alert('SIGET', 'El Numero DTM que busca de NO Existe!', function() {
										alertify.success('OK');
									});
									Limpiar();
									$("#nro_dtm").text('NINGUNO');
									$("#uni_ejec").text('NINGUNO');
									$("#destinatario").text('NINGUNO');
									$("#estado").text('NINGUNO');
									$("#instruccion").text('NINGUNO');
									$("#obser").text('NINGUNO');
								} else {
									divBody.style.display = 'block';
									divTeclado.style.display = 'none';
									Limpiar();
									$("#nro_dtm").text(data[0] + " - " + gestionComplemento);
									$("#uni_ejec").text(data[8]);
									$("#destinatario").html("<b>" + data[2] + "</b>");
									$("#estado").html(data[5] + "&nbsp; &nbsp; " + data[3] + "<br>" + "<b>" + data[7] + "</b>");
									$("#instruccion").text(data[4]);
									$("#obser").text(data[6]);
								}
							}

							,
						error: function(xhr) {
								alertify.alert('SIGET', 'Error de conexion al Servidor!', function() {
									alertify.success('OK');
								});
								Limpiar();
								$("#nro_dtm").text('NINGUNO');
								$("#uni_ejec").text('NINGUNO');
								$("#destinatario").html('NINGUNO');
								$("#estado").html('NINGUNO');
								$("#instruccion").text('NINGUNO');
								$("#obser").text('NINGUNO');
								$('#form_search')[0].reset();
								$('#submit_dtm').prop('disabled', false);
								divBody.style.display = 'none';
							}

							,
						complete: function() {
								$(".test").modal('hide');
								$('#submit_dtm').prop('disabled', false);
							}

							,
						dataType: 'html'
					});
					break;
				case "2023":
					console.log("Esto es 2023");

					$.ajax({

						url: "http://siget.elalto.gob.bo/android/consultarDtm2023.php?cod_dtm=" + dtm,
						type: "GET",
						dataType: "JSON",
						beforeSend: function() {
								$('#submit_dtm').prop('disabled', true);
								$(".test").modal('show');
								divBody.style.display = 'none';
							}

							,
						success: function(obj) {
								data = JSON.parse(obj);

								if (data[0] == null) {
									alertify.alert('SIGET', 'El Numero DTM que busca de NO Existe!', function() {
										alertify.success('OK');
									});
									Limpiar();
									$("#nro_dtm").text('NINGUNO');
									$("#uni_ejec").text('NINGUNO');
									$("#destinatario").text('NINGUNO');
									$("#estado").text('NINGUNO');
									$("#instruccion").text('NINGUNO');
									$("#obser").text('NINGUNO');
								} else {
									divBody.style.display = 'block';
									divTeclado.style.display = 'none';

									Limpiar();
									$("#nro_dtm").text(data[0] + " - " + gestionComplemento);
									$("#uni_ejec").text(data[8]);
									$("#destinatario").html("<b>" + data[2] + "</b>");
									$("#estado").html(data[5] + "&nbsp; &nbsp; " + data[3] + "<br>" + "<b>" + data[7] + "</b>");
									$("#instruccion").text(data[4]);
									$("#obser").text(data[6]);
								}
							}

							,
						error: function(xhr) {
								alertify.alert('SIGET', 'Error de conexion al Servidor!', function() {
									alertify.success('OK');
								});
								Limpiar();
								$("#nro_dtm").text('NINGUNO');
								$("#uni_ejec").text('NINGUNO');
								$("#destinatario").html('NINGUNO');
								$("#estado").html('NINGUNO');
								$("#instruccion").text('NINGUNO');
								$("#obser").text('NINGUNO');
								$('#form_search')[0].reset();
								$('#submit_dtm').prop('disabled', false);
								divBody.style.display = 'none';
							}

							,
						complete: function() {
								$(".test").modal('hide');
								$('#submit_dtm').prop('disabled', false);
							}

							,
						dataType: 'html'
					});
					break;
				case "2024":
					console.log("Esto es 2024");

					$.ajax({

						url: "http://siget.elalto.gob.bo/android/consultarDtm2024.php?cod_dtm=" + dtm,
						type: "GET",
						dataType: "JSON",
						beforeSend: function() {
								$('#submit_dtm').prop('disabled', true);
								$(".test").modal('show');
								divBody.style.display = 'none';
							}

							,
						success: function(obj) {
								data = JSON.parse(obj);

								if (data[0] == null) {
									alertify.alert('SIGET', 'El Numero DTM que busca de NO Existe!', function() {
										alertify.success('OK');
									});
									Limpiar();
									$("#nro_dtm").text('NINGUNO');
									$("#uni_ejec").text('NINGUNO');
									$("#destinatario").text('NINGUNO');
									$("#estado").text('NINGUNO');
									$("#instruccion").text('NINGUNO');
									$("#obser").text('NINGUNO');
								} else {
									divBody.style.display = 'block';
									divTeclado.style.display = 'none';

									Limpiar();
									$("#nro_dtm").text(data[0] + " - " + gestionComplemento);
									$("#uni_ejec").text(data[8]);
									$("#destinatario").html("<b>" + data[2] + "</b>");
									$("#estado").html(data[5] + "&nbsp; &nbsp; " + data[3] + "<br>" + "<b>" + data[7] + "</b>");
									$("#instruccion").text(data[4]);
									$("#obser").text(data[6]);
								}
							}

							,
						error: function(xhr) {
								alertify.alert('SIGET', 'Error de conexion al Servidor!', function() {
									alertify.success('OK');
								});
								Limpiar();
								$("#nro_dtm").text('NINGUNO');
								$("#uni_ejec").text('NINGUNO');
								$("#destinatario").html('NINGUNO');
								$("#estado").html('NINGUNO');
								$("#instruccion").text('NINGUNO');
								$("#obser").text('NINGUNO');
								$('#form_search')[0].reset();
								$('#submit_dtm').prop('disabled', false);
								divBody.style.display = 'none';
							}

							,
						complete: function() {
								$(".test").modal('hide');
								$('#submit_dtm').prop('disabled', false);
							}

							,
						dataType: 'html'
					});
					break;

				default:
					console.log("Error en la Seleccion de la Gestion");
					break;
			}

		});

		function CerrarDatosConsulta() {
			divBody.style.display = 'none';
			divTeclado.style.display = 'block';
			divTeclado.style.display = 'flex';
		}

		function startTime() {
			var today = new Date();
			var hr = today.getHours();
			var min = today.getMinutes();
			var sec = today.getSeconds();
			ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
			hr = (hr == 0) ? 12 : hr;
			hr = (hr > 12) ? hr - 12 : hr;
			//Add a zero in front of numbers<10
			hr = checkTime(hr);
			min = checkTime(min);
			sec = checkTime(sec);
			document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
			var months = ['Enero',
				'Febrero',
				'Marzo',
				'Abril',
				'Mayo',
				'Junio',
				'Julio',
				'Agosto',
				'Septiembre',
				'Octubre',
				'Noviembre',
				'Diciembre'
			];
			var days = ['Domingo',
				'Lunes',
				'Martes',
				'Miercoles',
				'Jueves',
				'Viernes',
				'Sabado'
			];
			var curWeekDay = days[today.getDay()];
			var curDay = today.getDate();
			var curMonth = months[today.getMonth()];
			var curYear = today.getFullYear();
			var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
			document.getElementById("date").innerHTML = date;

			var time = setTimeout(function() {
					startTime()
				}

				, 500);
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}

			return i;
		}
	</script>
</body>

</html>
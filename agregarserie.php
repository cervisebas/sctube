<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agregar Video</title>
	<style type="text/css">
		div {
			text-align: center;
			background: #01DF3A;
		}
		form {
			margin-left: auto;
			margin-right: auto;
			width: 60%;
			text-align: center;
			margin-top: 15px;
		}
		input {
			display: block;
			margin-left: auto;
			margin-right: auto;
			margin-top: 15px;
			/*margin-bottom: 15px;*/
			width: 90%;
			height: auto;
			text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid #fff;
			color: #000;
			background: #fff;
			height: 30px;
		}
		button {
			display: block;
			margin-left: auto;
			margin-right: auto;
			margin-top: 15px;
			/*margin-bottom: 15px;*/
			width: 10%;
			height: auto;
			/*text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid #fff;
			color: #000;
			background: #fff;*/
			height: 30px;
			color: #fff;
			background: blue;
			text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid blue;
		}
		#button {
			color: #fff;
		}
		h1 {
			margin: 30px;
		}
		* {
			font-family: arial;
		}
		.espacio {
			width: 100%;
			height: 15px;
		}
		#seleccion {
			color: #000 !important;
		}
		@media only screen and (orientation:portrait) {
			form { width: 100%; }
		  	input { width: 90%; }
		  	button { width: 70%; }
		}
		@media only screen and (orientation:landscape) {

		}
	</style>
	<script type="text/javascript">
        var temp = setInterval(compatibilidad, 25);
        function compatibilidad(argument) {
            var dispositivo = navigator.userAgent.toLowerCase();        
            if( dispositivo.search(/iphone|ipod|ipad|android|blackberry|windows phone/) > -1 ) {
                document.getElementById('form').style.width = "100%";
                document.getElementsByTagName('input')[0].style.width = "90%";
				document.getElementsByTagName('input')[1].style.width = "90%";
				document.getElementsByTagName('input')[2].style.width = "90%";
				document.getElementsByTagName('input')[3].style.width = "90%";
				document.getElementsByTagName('input')[4].style.width = "90%";
				document.getElementsByTagName('input')[5].style.width = "90%";
				document.getElementById('button').style.width = "70%";
            } else { 
                document.getElementById('form').style.width = "60%";
                document.getElementsByTagName('input')[0].style.width = "90%";
				document.getElementsByTagName('input')[1].style.width = "90%";
				document.getElementsByTagName('input')[2].style.width = "90%";
				document.getElementsByTagName('input')[3].style.width = "90%";
				document.getElementsByTagName('input')[4].style.width = "90%";
				document.getElementsByTagName('input')[5].style.width = "90%";
				document.getElementById('button').style.width = "10%";
            }
        }
    </script>
</head>
<body>
	<div id="contenido">
		<h1>Subir serie</h1>
		<form enctype="multipart/form-data" action="verificarserie.php" method="POST" id="form">
			<input id="seleccion" list="listaseries" name="seleccion" placeholder="Selecciona Serie o Agrega una">
			<datalist id="listaseries">
				<?php
					include "nom_listas.php";
					for ($i=0; $i < count($listassv); $i++) { 
						echo "<option value='".$listassv[$i]."'>";
					}
				?>
			</datalist>
		</form>
		<div class="espacio"></div>
		<button id="button" onclick="document.getElementById('form').submit(); subir();">Enviar</button>
		<center><h3 id="progreso"> </h3></center>
		<script type="text/javascript">
			function subir() {
				document.getElementById('progreso').innerHTML = "Procesando... Porfavor espere...";
			}
		</script>
		<div class="espacio"></div>
	</div>
	<script type="text/javascript" src="js/mododark.js"></script>
</body>
</html>
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
				document.getElementById('button').style.width = "70%";
            } else { 
                document.getElementById('form').style.width = "60%";
                document.getElementsByTagName('input')[0].style.width = "90%";
				document.getElementsByTagName('input')[1].style.width = "90%";
				document.getElementsByTagName('input')[2].style.width = "90%";
				document.getElementsByTagName('input')[3].style.width = "90%";
				document.getElementById('button').style.width = "10%";
            }
        }
    </script>
</head>
<body>
	<div id="contenido">
		<h1>Subir Serie</h1>
		<form enctype="multipart/form-data" method="POST" id="form">
			<input type="text" name="tipo" style="display: none;" id="tipo" value="">
			<?php
				$seleccion = $_POST['seleccion'];
				$directorio = "series/".$seleccion;
				if (is_dir($directorio)) {
					echo "<h2>Agregar capitulos a ".$seleccion."</h2>";
					echo "<input type='file' accept='video/*,' name='archivo'>";
					echo "<input type='text' style='display: none;' name='elegido' value='".$seleccion."'>";
					echo "<script> document.getElementById('tipo').value = '1'; </script>";
				} else {
					echo "<h2>Agregar nuevo a ".$seleccion."</h2>";
					echo "<input type='text' name='nombre' placeholder='Nombre'>";
					echo "<input type='file' accept='image/*' name='portada'>";
					echo "<input type='text' name='descripcion' placeholder='Descripcion'>";
					echo "<input type='text' name='prioridad' placeholder='Prioridad'>";
					echo "<script> document.getElementById('tipo').value = '2'; </script>";
				}
			?>
		</form>
		<div class="espacio"></div>
		<center><h3 id="progreso" style="display: none;"> </h3></center><br>
		<center><progress id="progressBar" value="0" max="100" style="width: 50%; display: none;"></progress></center>
		<div class="espacio"></div>
		<button id="button" onclick="uploadFile(); mostrarprogreso();">Subir</button>
		<script type="text/javascript">
			function _(el){
				return document.getElementById(el);
			}
			function uploadFile(){
				var form = document.getElementById('form');
				if (window.XMLHttpRequest) {
					var ajax = new XMLHttpRequest();
				} else {
					var ajax = new ActiveXObject("Microsoft.XMLHTTP");
				}
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.addEventListener("load", completeHandler, false);
				ajax.open("POST", "subirserie.php");
				ajax.send(new FormData(form));
			}
			function progressHandler(event){
				var percent = (event.loaded / event.total) * 100;
				_("progressBar").value = Math.round(percent);
				_("progreso").innerHTML = "Subiendo: "+Math.round(percent)+"%";
			}
			function completeHandler() {
				localStorage.setItem('nopermitido', 'si');
                if (_("tipo").value == '1') {
					localStorage.setItem('mensaje', 'El contenido se ah subido y agregado correctamente en la lista seleccionada');
				} else {
					if (_("tipo").value == '2') {
						localStorage.setItem('mensaje', 'La lista se ah agregado correctamente');
					}
				}
				_("form").reset();
				_("progressBar").value = 0;
				_("progreso").innerHTML = "";
				_("progreso").style.display = "none";
				_("progressBar").style.display = "none";
			}
			function mostrarprogreso() {
				_("progreso").style.display = "inline";
				_("progressBar").style.display = "inline";
			}
		</script>
		<div class="espacio"></div>
	</div>
	<script type="text/javascript" src="js/mododark.js"></script>
</body>
</html>
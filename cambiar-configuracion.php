<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		* {
			font-family: arial;
		}
		#principal {
			text-align: center;
		}
		#contenido {
			width: 80%;
			height: auto;
			background: #01DF3A;
			text-align: center;
			margin-left: auto;
			margin-right: auto;
			border-radius: 30px 30px 30px 30px;
		}
		#form input {
			margin: 10px;
			width: 60%;
			height: 50px;
			background: #fff;
			border-radius: 60px 60px 60px 60px;
			border: 2px solid black;
			text-align: center;
			transition: opacity 1s ease-out;
		}
		#form {
			text-align: center;
			margin-right: auto;
			margin-left: auto;
		}
		button {
			margin: 10px;
			width: 60%;
			height: 50px;
			background: blue;
			border-radius: 60px 60px 60px 60px;
			border: 2px solid #fff;
			font-weight: bold;
			color: #fff;
			transition: opacity 1s ease-out;
		}
		#info {
			width: 100%;
			height: auto;
			text-align: center;
		}
		#info img {
			width: 250px;
			height: 250px;
			border-radius: 50%;
			border: 5px solid #000;
			-webkit-clip-path: url(50% at 50% 50%);
			clip-path: url(50% at 50% 50%);
			object-fit: cover;
		}
		@media only screen and (orientation:portrait) {
		  	#form input { width: 90%; }
		  	button { width: 90%; }
		}
		@media only screen and (orientation:landscape) {

		}
	</style>
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad(argument) {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				for (var i = 0; i < document.getElementsByTagName('input').length; i++) {
					document.getElementsByTagName('input')[i].style.width = "90%";
				}
				for (var i = 0; i < document.getElementsByTagName('button').length; i++) {
					document.getElementsByTagName('button')[i].style.width = "90%";
				}
			} else { 
				for (var i = 0; i < document.getElementsByTagName('input').length; i++) {
					document.getElementsByTagName('input')[i].style.width = "60%";
				}
				for (var i = 0; i < document.getElementsByTagName('button').length; i++) {
					document.getElementsByTagName('button')[i].style.width = "60%";
				}
			}
		}
	</script>
	<script type="text/javascript" src="js/mododark.js"></script>
</head>
<body>
	<div id="principal">
		<div id="contenido">
			<br>
			<div id="info">
				<?php
					include 'nom_perfiles.php';
					$u = $_COOKIE["id_usuario"];
					for ($i=0; $i < count($id); $i++) { 
						if ($u === $id[$i]) {
							$id_obtenida = $u;
							$num_parte = $i;
							$usuario_encontrado = 1;
						}
					}
					if ($usuario_encontrado == 1) {
						include 'extensiones.php';
						$siimagen = 0;
			            for ($i=0; $i < count($extimg); $i++) {
			                $comprobar = "img/user_".$id_obtenida.".".$extimg[$i];
			                if (file_exists($comprobar)) {
			                    echo "<img id='perfilimagen' class='perfiles-img' src='".$comprobar."?".rand()."'>";
			                    $siimagen = 1;
			            	}
			            }
			            if ($siimagen == 0) {
			            	echo "<img id='perfilimagen' class='perfiles-img' src='img/usuario.jpg'>";
			            }
			            echo "<h1>".$nombre[$num_parte]."</h1>";
			            echo "<p>#".$usuario[$num_parte]."_".$u.".".$num_parte."</p>";
			        }
				?>
			</div>
			<form enctype="multipart/form-data" method="POST" id="form" style="display: none;">
				<input type="text" name="" id="nombre" placeholder="Nombre" style="display: none;"><br>
				<input type="text" name="" id="user" placeholder="Usuario" style="display: none;"><br>
				<input type="password" name="" id="password" placeholder="Contraseña" style="display: none;"><br>
				<input type="file" accept="image/*" name="" id="foto" style="display: none"><br>
			</form>
			<button id="enviar" onclick="uploadFile()" style="display: none;">Enviar</button>
			<button id="atras" onclick="volver()" style="display: none;">Volver</button>

			<button id="nombre2" onclick="nombre()">Cambiar nombre</button><br>
			<button id="user2" onclick="user()">Cambiar usuario</button><br>
			<button id="password2" onclick="password()">Cambiar contraseña</button><br>
			<button id="foto2" onclick="foto()">Cambiar Imagen</button><br>
		</div>
	</div>
	<script type="text/javascript">
		function uploadFile(){
			var form = document.getElementById('form');
			if (window.XMLHttpRequest) {
				var ajax = new XMLHttpRequest();
			} else {
				var ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", actualizar_contenido, false);
			ajax.open("POST", "introducir-configuracion.php");
			ajax.send(new FormData(form));
		}

		function progressHandler(event){
			var percent = (event.loaded / event.total) * 100;
			_("progressBar").value = Math.round(percent);
			_("progreso").innerHTML = "Subiendo: "+Math.round(percent)+"%";
		}
		function actualizar_contenido(argument) {
			if (window.XMLHttpRequest) {
				var ajax = new XMLHttpRequest();
			} else {
				var ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					document.getElementById('info').innerHTML = ajax.responseText;
				}
			}
			ajax.open("POST", "ver_mi_perfil.php");
			ajax.send();
			volver();
		}
		function nombre() {
			document.getElementById('form').style.display = "inline";
			document.getElementById('atras').style.display = "inline-block";
			document.getElementById('enviar').style.display = "inline-block";

			document.getElementById('user2').style.display = "none";
			document.getElementById('password2').style.display = "none";
			document.getElementById('nombre2').style.display = "none";
			document.getElementById('foto2').style.display = "none";
			document.getElementById('nombre').style.display = "inline-block";
			document.getElementById('nombre').name = "nombre";
		}
		function user() {
			document.getElementById('form').style.display = "inline";
			document.getElementById('atras').style.display = "inline-block";
			document.getElementById('enviar').style.display = "inline-block";

			document.getElementById('user2').style.display = "none";
			document.getElementById('password2').style.display = "none";
			document.getElementById('nombre2').style.display = "none";
			document.getElementById('foto2').style.display = "none";
			document.getElementById('user').style.display = "inline-block";
			document.getElementById('user').name = "user";
		}
		function password() {
			document.getElementById('form').style.display = "inline";
			document.getElementById('atras').style.display = "inline-block";
			document.getElementById('enviar').style.display = "inline-block";

			document.getElementById('user2').style.display = "none";
			document.getElementById('password2').style.display = "none";
			document.getElementById('nombre2').style.display = "none";
			document.getElementById('foto2').style.display = "none";
			document.getElementById('password').style.display = "inline-block";
			document.getElementById('password').name = "password";
		}
		function foto() {
			document.getElementById('form').style.display = "inline";
			document.getElementById('atras').style.display = "inline-block";
			document.getElementById('enviar').style.display = "inline-block";

			document.getElementById('user2').style.display = "none";
			document.getElementById('password2').style.display = "none";
			document.getElementById('nombre2').style.display = "none";
			document.getElementById('foto2').style.display = "none";
			document.getElementById('foto').style.display = "inline-block";
			document.getElementById('foto').name = "imagen";
		}
		function volver() {
			document.getElementById('form').style.display = "none";
			document.getElementById('atras').style.display = "none";
			document.getElementById('enviar').style.display = "none";

			document.getElementById('user2').style.display = "inline-block";
			document.getElementById('password2').style.display = "inline-block";
			document.getElementById('nombre2').style.display = "inline-block";
			document.getElementById('foto2').style.display = "inline-block";

			document.getElementById('nombre').style.display = "none";
			document.getElementById('foto').style.display = "none";
			document.getElementById('password').style.display = "none";
			document.getElementById('user').style.display = "none";

			document.getElementById('nombre').name = "";
			document.getElementById('foto').name = "";
			document.getElementById('password').name = "";
			document.getElementById('user').name = "";
		}
	</script>
</body>
</html>
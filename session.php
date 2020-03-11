<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8">
	<style type="text/css">
		#contenido {
			position: absolute;
			width: 60%;
			height: calc(100% - 60px);
			background: #01DF3A;
			border-radius: 15px 15px 15px 15px;
			text-align: center;
			left: 20%;
			right: 20%;
			display: table;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		#iniciar {
			display: table-cell;
			vertical-align: middle;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		#registrar h3 {
			font-family: arial;
			margin-right: auto;
			margin-left: auto;
			margin-top: 0;
			margin-bottom: 0;
		}
		#registrar {
			display: table-cell;
			vertical-align: middle;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		#resultado {
			display: table-cell;
			vertical-align: middle;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		#resultado img {
			width: 220px;
			height: 220px;
			border-radius: 50%;
			border: 5px solid #000;
			-webkit-clip-path: url(50% at 50% 50%);
			clip-path: url(50% at 50% 50%);
			object-fit: cover;
		}
		#resultado h2 {
			font-size: 32px;
			font-family: arial;
			color: #000;
		}
		#resultado h4 {
			margin-top: -20px;
			font-size: 16px;
			font-family: arial;
			color: #000;
		}
		form {
			text-align: center;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		form input {
			width: 80%;
			height: 30px;
			margin-top: 10px;
			margin-bottom: 10px;
			text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid #fff;
			color: #000;
			margin-left: auto;
			margin-right: auto;
		}
		button {
			width: 50%;
			height: 30px;
			background: blue;
			text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid blue;
			color: #fff;
			margin-left: auto;
			margin-right: auto;
			margin-top: 15px;
		}
		p {
			user-select: none;
			font-family: arial;
			font-size: 16px;
			font-weight: bold;
		}
		p:hover {
			color: red;
		}
		h1 {
			font-family: arial;
			text-decoration: underline;
		}
		.verno {
			display: none !important;
		}
		@keyframes desaparecer {
			0% {
				opacity: 1;
			}
			100% {
				opacity: 0;
			}
		}
		@keyframes aparecer {
			0% {
				opacity: 0;
			}
			100% {
				opacity: 1;
			}
		}

		/* Barra de carga */
		.loader {
		  font-size: 10px;
		  margin-top: 30px;
		  margin-bottom: 30px;
		  margin-left: auto;
		  margin-right: auto;
		  text-indent: -9999em;
		  width: 6em;
		  height: 6em;
		  border-radius: 50%;
		  background: #ffffff;
		  background: -moz-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: -webkit-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: -o-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: -ms-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: linear-gradient(to right, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  position: relative;
		  -webkit-animation: load3 1.4s infinite linear;
		  animation: load3 1.4s infinite linear;
		}
		.loader:before {
		  width: 50%;
		  height: 50%;
		  background: #FFF;
		  border-radius: 100% 0 0 0;
		  position: absolute;
		  top: 0;
		  left: 0;
		  content: '';
		}
		.loader:after {
		  background: #01DF3A;
		  width: 75%;
		  height: 75%;
		  border-radius: 50%;
		  content: '';
		  margin: auto;
		  position: absolute;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		}
		.loader_dark {
		  font-size: 10px;
		  margin-top: 30px;
		  margin-bottom: 30px;
		  margin-left: auto;
		  margin-right: auto;
		  text-indent: -9999em;
		  width: 6em;
		  height: 6em;
		  border-radius: 50%;
		  background: #ffffff;
		  background: -moz-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: -webkit-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: -o-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: -ms-linear-gradient(left, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  background: linear-gradient(to right, #ffffff 10%, rgba(255, 255, 255, 0) 42%);
		  position: relative;
		  -webkit-animation: load3 1.4s infinite linear;
		  animation: load3 1.4s infinite linear;
		}
		.loader_dark:before {
		  width: 50%;
		  height: 50%;
		  background: #FFF;
		  border-radius: 100% 0 0 0;
		  position: absolute;
		  top: 0;
		  left: 0;
		  content: '';
		}
		.loader_dark:after {
		  background: rgb(49, 49, 49);
		  width: 75%;
		  height: 75%;
		  border-radius: 50%;
		  content: '';
		  margin: auto;
		  position: absolute;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		}
		@-webkit-keyframes load3 {
		  0% {
		    -webkit-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@keyframes load3 {
		  0% {
		    -webkit-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}

		/* Segun orientacion */

		@media only screen and (orientation:portrait) {
		  	#contenido { width: calc(100% - 30px); left: 15px; }
		  	.loader { margin-top: 15px;  margin-bottom: 15px; }
		}
		@media only screen and (orientation:landscape) {
			
		}
	</style>
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad() {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				if($("#loader").length) { document.getElementById("loader").style.marginTop = '15px'; document.getElementById("loader").style.marginBottom = '15px'; }
				document.getElementById('contenido').style.width = "calc(100% - 30px)";
				document.getElementById('contenido').style.left = "15px";
			} else {
				if($("#loader").length) { document.getElementById("loader").style.marginTop = '30px'; document.getElementById("loader").style.marginBottom = '30px'; }
				document.getElementById('contenido').style.width = "60%";
				document.getElementById('contenido').style.left = "20%";
			}
		}
	</script>
</head>
<body>
	<div id="contenido">
		<div id="iniciar">
			<h1>Iniciar Sesion</h1>
			<form id="session_iniciar" method="POST">
				<input type="text" name="ingresar_usuario" placeholder="Usuario">
				<input type="password" name="ingresar_password" placeholder="Cotraseña">
			</form>
			<button onclick="acceder()">Acceder</button>
			<p onclick="registrar()">Registrarse</p>
		</div>
		<div id="registrar" class="verno">
			<h1>Registrarse</h1>
			<form id="session_registrar" method="POST">
				<input type="text" name="registrar_nombre" placeholder="Nombre">
				<input type="text" name="registrar_usuario" placeholder="Usuario">
				<input type="password" name="registrar_password" placeholder="Cotraseña">
				<h3>Foto de perfil</h3>
				<input type="file" accept="image/*" name="registrar_foto">
			</form>
			<button onclick="crear()">Registrar</button>
			<p onclick="iniciar_sesion()">Iniciar Sesion</p>
		</div>
		<div id="resultado" class="verno">
			
		</div>
		<script type="text/javascript">
			function _(el){
				return document.getElementById(el);
			}
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					document.getElementById('resultado').innerHTML = ajax.responseText;
				}
			}
			function volver_registrar() {
				document.getElementById('resultado').style.animation = 'desaparecer 2s';
				setTimeout("document.getElementById('resultado').classList.add('verno')", 2000);
				document.getElementById('registrar').style.animation = 'aparecer 2s';
				setTimeout("document.getElementById('registrar').classList.remove('verno');", 2000);
			}
			function volver_acceder() {
				document.getElementById('resultado').style.animation = 'desaparecer 2s';
				setTimeout("document.getElementById('resultado').classList.add('verno')", 2000);
				document.getElementById('iniciar').style.animation = 'aparecer 2s';
				setTimeout("document.getElementById('iniciar').classList.remove('verno');", 2000);
			}
			var guardar_redireccionar = setInterval(function () { 
					if($("#loader").length) {
						localStorage.setItem("nombre_sctube", nombre_usuario_escrito.innerHTML);
						clearInterval(guardar_redireccionar);
						setTimeout("document.location = 'inicio';", 5000);
					} 
				}, 50);
			function acceder() {
				var form = document.getElementById('session_iniciar');
				ajax.open("POST", "conexion.php");
				ajax.send(new FormData(form));
				document.getElementById('iniciar').style.animation = 'desaparecer 2s';
				setTimeout("document.getElementById('iniciar').classList.add('verno')", 2000);
				document.getElementById('resultado').style.animation = 'aparecer 2s';
				setTimeout("document.getElementById('resultado').classList.remove('verno');", 2000);
			}
			function crear() {
				var form = document.getElementById('session_registrar');
				ajax.open("POST", "conexion.php");
				ajax.send(new FormData(form));
				document.getElementById('registrar').style.animation = 'desaparecer 2s';
				setTimeout("document.getElementById('registrar').classList.add('verno')", 2000);
				document.getElementById('resultado').style.animation = 'aparecer 2s';
				setTimeout("document.getElementById('resultado').classList.remove('verno');", 2000);
			}
			function registrar() {
				document.getElementById('iniciar').style.animation = 'desaparecer 2s';
				setTimeout("document.getElementById('iniciar').classList.add('verno')", 2000);
				document.getElementById('registrar').style.animation = 'aparecer 2s';
				setTimeout("document.getElementById('registrar').classList.remove('verno');", 2000);
			}
			function iniciar_sesion() {
				document.getElementById('registrar').style.animation = 'desaparecer 2s';
				setTimeout("document.getElementById('registrar').classList.add('verno');", 2000);
				document.getElementById('iniciar').style.animation = 'aparecer 2s';
				setTimeout("document.getElementById('iniciar').classList.remove('verno')", 2000);
			}
			function inicio_completo(a) {
				setTimeout('document.location = "inicio.php";',5000);
				localStorage.setItem('nombre_sctube', a);
			}
		</script>
	</div>
</body>
<script type="text/javascript" src="js/mododark.js"></script>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>SCTube</title>
	<link rel="shortcut icon" href="ico/icono.ico">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad(argument) {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				document.getElementById('opcuenta').style.width = "90%";
				document.getElementById('opcuenta').style.marginLeft = "5px";
				document.getElementById('asdf').style.textAlign = "right";
				document.getElementById('asdf').style.marginRight = "-15px";
				document.getElementById('logo').style.width = "auto";
				document.getElementById('logo').style.height = "80%";
				document.getElementById('logo').style.top = "11%";
				document.getElementById('barramenu').style.display = "none";
				document.getElementsByClassName('solocelopcuenta')[0].style.display = "block";
				document.getElementsByClassName('solocelopcuenta')[1].style.display = "block";
				document.getElementsByClassName('solocelopcuenta')[2].style.display = "block";
				document.getElementById("mensaje").style.right = "0px";
			} else { 
				document.getElementById('opcuenta').style.width = "20%";
				document.getElementById('opcuenta').style.right = "15px";
				document.getElementById('asdf').style.textAlign = "center";
				document.getElementById('asdf').style.marginRight = "none";
				document.getElementById('logo').style.width = "auto";
				document.getElementById('logo').style.height = "100%";
				document.getElementById('logo').style.top = "0";
				document.getElementById('barramenu').style.display = "block";
				document.getElementsByClassName('solocelopcuenta')[0].style.display = "none";
				document.getElementsByClassName('solocelopcuenta')[1].style.display = "none";
				document.getElementsByClassName('solocelopcuenta')[2].style.display = "none";
				document.getElementById("mensaje").style.right = "20px";
			}
		}
		var cambioURL_var = setInterval(cambioURL, 50);
		function cambioURL() {
			if (localStorage.getItem("cambioURL") == "si") {
				var url_obtenida = localStorage.getItem("URL_Enviada");
				history.pushState({ path: url_obtenida }, url_obtenida, url_obtenida);
				clearInterval(cambioURL_var);
				localStorage.setItem("cambioURL", "no");
				setInterval(cambioURL, 50);
			}
		}
	</script>
	<?php
		if (!isset($_COOKIE['id_usuario'])) {
			setcookie("id_usuario", "0", time() + 30879000);
		}
		if (!isset($_COOKIE['nombre_usuario'])) {
			setcookie("nombre_usuario", "default", time() + 30879000);
		}
		if (!isset($_COOKIE['user_usuario'])) {
			setcookie("user_usuario", "0", time() + 30879000);
		}
		if (!isset($_COOKIE['prioridad_usuario'])) {
			setcookie("prioridad_usuario", "0", time() + 30879000);
		}
		if (!isset($_COOKIE['darkmode'])) {
			setcookie("darkmode", "0", time() + 30879000);
		}
		if (!isset($_COOKIE['qweasdzxcrfvtgbnmjhyuikmloñlkijhytgfrdecb'])) {
			setcookie("qweasdzxcrfvtgbnmjhyuikmloñlkijhytgfrdecb", "0", time() + 30879000);
		}
		if (isset($_COOKIE['id_usuario']) && isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['user_usuario']) && isset($_COOKIE['prioridad_usuario']) && isset($_COOKIE['qweasdzxcrfvtgbnmjhyuikmloñlkijhytgfrdecb'])) {
			include 'comprobar-usuario.php';	
		} else {
			echo "<script>
					document.cookie = 'id_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					document.cookie = 'nombre_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					document.cookie = 'user_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					document.cookie = 'prioridad_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					localStorage.setItem('nombre_sctube', 'default');
				</script>";
		}
	?>
</head>
<body>
	<section>
		<?php
			if (isset($_REQUEST['v'])) {
				$v = $_REQUEST['v'];
				echo '<script> document.getElementById("paginas").src = "video.php?v='.$v."&t=".$v.'"; console.log("Exite V='.$v.'");</script>';
			}
			function verificarURLPHP() {
				if(isset($_REQUEST['v'])) {
					return 'video?v='.$_REQUEST['v'];
				} else if (isset($_REQUEST['s']) && isset($_REQUEST['i']) && isset($_REQUEST['t'])) {
					return 'video-serie?s='.$_REQUEST['s'].'&v='.$_REQUEST['i'].'&t='.$_REQUEST['t'];
				} else if (isset($_REQUEST['l'])) {
					return 'lista?l='.$_REQUEST['l'];
				} else if (isset($_REQUEST['u'])) {
					return 'perfil-ver?u='.$_REQUEST['u'];
				} else {
					return 'inicio';
				}
			}
		?>
		<iframe src="<?php echo verificarURLPHP(); ?>" id="paginas" onload="console.log(document.getElementById('paginas').contentWindow.location.href);" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" oallowfullscreen="true" msallowfullscreen="true"></iframe>
	</section>
	<div id="mensaje"><h2 id="h2mensaje">El video/contenido no es permitido para su usuario</h2></div>
	<div id="barramenu">
		<div id="menub">
			<button class="botones" onclick="document.getElementById('paginas').src = 'inicio';">Inicio</button>
			<button class="botones" onclick="document.getElementById('paginas').src = 'listas';">Listas</button>
			<button class="botones" onclick="document.getElementById('paginas').src = 'historial';">Historial</button>
			<button class="botones" onclick="document.getElementById('paginas').src = 'perfiles-biblioteca';">Perfiles</button>
			<script type="text/javascript" src="js/sctube_ir.js"></script>
		</div>
		<script type="text/javascript">
			var tmp = setInterval(verificar, 25);
			var iframe = document.getElementById('paginas');
			function verificar() {
				if (/inicio/.test(iframe.contentWindow.location.href) == true) {
					document.getElementById('barramenu').style.width = "18%";				
				} else {
					document.getElementById('barramenu').style.width = "0px";
				}
			}
			var verificarusuario = setInterval(function () {
				var usuarioguardado = (document.cookie.indexOf('id_usuario=') === -1 ? '' : ("; " + document.cookie).split('; id_usuario=')[1].split(';')[0]);
				if (usuarioguardado != '0') {
					clearInterval(verificarusuario);
				} else {
					document.getElementById('paginas').src = "session";
					clearInterval(verificarusuario);
				}
			},150);
			var verificar_user = setInterval(
				function usuarioverificar() {
					if (localStorage.getItem("nopermitido") == "si") {
						var mensaje = localStorage.getItem("mensaje");
						document.getElementById("mensaje").style.bottom = "15px";
						document.getElementById('h2mensaje').innerHTML = mensaje;
						clearInterval(verificar_user);
						setTimeout('localStorage.setItem("nopermitido", "no"); document.getElementById("mensaje").style.bottom = "-100px"; verificar_user = setInterval(usuarioverificar, 50);',5000);
					}
					var id = (document.cookie.indexOf('id_usuario=') === -1 ? '' : ("; " + document.cookie).split('; id_usuario=')[1].split(';')[0]);
					if (id <= 0 && /session/.test(iframe.contentWindow.location.href) != true && /conexion/.test(iframe.contentWindow.location.href) != true && /registrarse/.test(iframe.contentWindow.location.href) != true) {
						document.getElementById('paginas').src = "session";
					}
					if (!id <= 0) {
						document.getElementById('cuentasi').style.display = "block";
					} else {
						document.getElementById('cuentasi').style.display = "none";
					}
				}, 50);
		</script>
	</div>
	<header>
		<div id="opcuenta">
			<p for="darkmode">Modo Oscuro <input id="darkmode" type="checkbox"></p>
			<p class="solocelopcuenta" onclick="document.getElementById('paginas').src = 'listas';">Listas</p>
			<p class="solocelopcuenta" onclick="document.getElementById('paginas').src = 'historial';">Historial</p>
			<p class="solocelopcuenta" onclick="document.getElementById('paginas').src = 'perfiles-biblioteca';">Perfiles</p>
			<p id="cuentasi" onclick="document.getElementById('paginas').src = 'cambiar-configuracion';">Configurar Cuenta</p>
			<p style="display: none;" id="soloadmin" onclick="menu_ir(2004)">Agregar video</p>
			<p onclick="cerrar_sesion()"><b id="cuenta"></b> Cerrar Sesion</p>
		</div>
		<div id="superior">
			<img id="logo" src="img/logo.png" onclick="irpagina('inicio'); localStorage.setItem('cambioURL', 'si'); localStorage.setItem('URL_Enviada', 'index');">
			<div id="asdf">
				<input type="search" value="" placeholder="Buscar" id="search" onkeyup="buscar()">
				<input type="button" value="Ir" id="boton-buscar" onclick="buscarclick()">
				<button class="botones" onclick="opcuenta()">Cuenta</button>
			</div>
		</div>
	</header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
	<div id="cargapagina"></div>
	<script type="text/javascript">
		var iframe = document.getElementById('paginas');
		var urltiemporealiframe = iframe.contentWindow.location.href;
		var srctiemporealiframe = iframe.src;
		function _(el){
			return document.getElementById(el);
		}
		$('#paginas').load(function(){
		    _('cargapagina').style.animation = "cargasi 0.5s";
		    urltiemporealiframe = iframe.contentWindow.location.href;
		    srctiemporealiframe = iframe.src;
		});
		var cpc = setInterval(function () {
			if (!$('iframe').contents().find('body').children().length > 0 || urltiemporealiframe != iframe.contentWindow.location.href || srctiemporealiframe != iframe.src) {
			    _('cargapagina').style.animation = "carga 40s";
			}
		}, 50);
	</script>
	<script type="text/javascript">
		var darkmode = document.getElementById('darkmode');
		darkmode.addEventListener("change", activar, false);
		var veces = 0;
		function activar() {
			var checked = darkmode.checked;
			var body = document.getElementsByTagName("body");
			var botones = document.getElementsByClassName('botones');
			if(checked){
				localStorage.setItem("darkmode", "si");
				document.cookie = "darkmode = 1; max-age = 30879000";
	          	body[0].style.background = "#000";
	            document.getElementById('barramenu').style.background = "#313131";
	          	document.getElementById('superior').style.background = "#313131";
	            document.getElementById('opcuenta').style.background = "#313131";
	          	document.getElementById('opcuenta').style.color = "#FFF";
	          	document.getElementById('mensaje').style.background = "#313131";
	          	document.getElementById('mensaje').style.boxShadow = "0px 0px 15px 1px rgba(255,255,255,1)";
				document.getElementById('h2mensaje').style.color = "#FFF";
	          	for (var i = 0; i < botones.length; i++) {
	          		botones[i].style.color = "#fff";
	          	}
	        } else {
	        	localStorage.setItem("darkmode", "no");
	            body[0].style.background = "#fff";
	            document.cookie = "darkmode = 0; max-age = 30879000";
	            document.getElementById('barramenu').style.background = "#01DF3A";
	            document.getElementById('superior').style.background = "#01DF3A";
	            document.getElementById('opcuenta').style.background = "#01DF3A";
	            document.getElementById('opcuenta').style.color = "#000";
	            document.getElementById('mensaje').style.background = "#01DF3A";
	          	document.getElementById('mensaje').style.boxShadow = "0px 0px 15px 1px rgba(0,0,0,0.75)";
				document.getElementById('h2mensaje').style.color = "#000";
	            for (var i = 0; i < botones.length; i++) {
	             	botones[i].style.color = "#000";
	            }
	        }
		}
		function cerrar_sesion() {
			//eliminar cookies
			document.cookie = "id_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "nombre_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "user_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
			document.cookie = "prioridad_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
			localStorage.setItem("nombre_sctube", 'default');

			document.getElementById('cuenta').innerHTML = localStorage.getItem('nombre_sctube');
			irpagina("session.php");
		}
		function opcuenta() {
			var op = document.getElementById('opcuenta');
			if (veces == 0) {
				op.style.height = "auto";
				op.style.top = "65px";
				veces = 1;
			} else if (veces == 1) {
				op.style.height = "0";
				op.style.top = 0;
				veces = 0;
			}
		}
		var recargar = setInterval(cargadarkon, 50);
		function cargadarkon(argument) {
			var cargadark = localStorage.getItem("darkmode");
			if (cargadark == "si") {
				darkmode.checked = 1;
				activar();
			} else {
				if (cargadark == "no") {
					darkmode.checked = 0;
					activar();
				}
			}
			document.getElementById('cuenta').innerHTML = localStorage.getItem('nombre_sctube');
		}
		var cargadarkinicio = localStorage.getItem("darkmode");
			if (cargadarkinicio == "si") {
				darkmode.checked = 1;
				activar();
			} else {
				if (cargadarkinicio == "no") {
					darkmode.checked = 0;
					activar();
				}
			}
		var agregar = setInterval(function () {
			var prioridad = (document.cookie.indexOf('prioridad_usuario=') === -1 ? '' : ("; " + document.cookie).split('; prioridad_usuario=')[1].split(';')[0]);
			if (prioridad == 5) {
				document.getElementById('soloadmin').style.display = "block";
			} else {
				document.getElementById('soloadmin').style.display = "none";
			}
		}, 25);
	</script>
</body>
<script type="text/javascript" src="js/index.js"></script>
</html>
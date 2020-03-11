<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/inicio.css">
		<script type="text/javascript">
			var cambioURL = setInterval( function () { localStorage.setItem('cambioURL', 'si'); localStorage.setItem('URL_Enviada', 'index');}, 25);
		    setTimeout('clearInterval(cambioURL)', 100);
			var temp = setInterval(compatibilidad, 25);
			function compatibilidad(argument) {
				var dispositivo = navigator.userAgent.toLowerCase();        
				if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
					document.getElementById('ventanacontenido').style.left = "0%";
					for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
						document.getElementsByClassName('contenidos')[i].style.width = "160px";
						document.getElementsByClassName('contenidos')[i].style.padding = "5px";
					}
				} else { 
					document.getElementById('ventanacontenido').style.left = "19%";
					for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
						document.getElementsByClassName('contenidos')[i].style.width = "160px";
						document.getElementsByClassName('contenidos')[i].style.padding = "10px";
					}
				}
			}
		</script>
		<script type="text/javascript" src="js/mododark.js"></script>
	</head>
	<body>
		<div id="ventanacontenido">
			<?php
				include "version.php";
				include "extensiones.php";
				include "nom_videos.php";
				$archivo = 0;
				$num = 0;

				for ($i=0; $i < count($nombresv); $i++) {
					for ($a=0; $a < count($extimg); $a++) {
			            $comprobar = "img/".$i.".".$extimg[$a];
			            if (file_exists($comprobar)) {
			            	$comilla = "'";
			                $archivo = $comprobar;
			                echo '<div class="contenidos" onclick="document.location = '."'".'video?v='.base64_encode($i).'&t='.base64_encode($i)."'".';"><img src="'.$archivo.'?v='.$version.'" class="imagenes"><br><p class="titulos">'.$nombresv[$i].'</p></div>';
			            }
			        }
				}
			?>
		</div>
	</body>
</html>	

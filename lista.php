<!DOCTYPE html>
<html>
<head>
	<title>Prueva</title>
	<link rel="stylesheet" type="text/css" href="css/inicio.css">
	<script type="text/javascript" src="js/mododark.js"></script>
	<style type="text/css">
		@media only screen and (orientation:portrait) {
		  	#caratula { text-align: center; }
		  	#ventanacontenido { top: 300px; }
		  	#sinopsis { display: none; }
		}
		@media only screen and (orientation:landscape) {
			#ventanacontenido { left: 190px; }
		}
	</style>
</head>
<body>
	<div id="ventanacontenido">
		<?php
			include "version.php";
			include "nom_listas.php";
			include "extensiones.php";
			$archivo = 0;
			$num = 0;
			$l = $_REQUEST["l"];
			for ($i=0; $i < 1024; $i++) { 
				$archivo= "series/".$listassv[$l]."/Capitulo ".$i.".mp4";
				//$archivoimg= "series/".$listassv[$l]."/Capitulo ".$i.".png";
				$archivoimg;
		        for ($a=0; $a < count($extimg); $a++) {
		            $comprobar = "series/".$listassv[$l]."/Capitulo ".$i.".".$extimg[$a];
		            if (file_exists($comprobar)) {
		                $archivoimg = $comprobar;
		            }
		        }
				$cd = "'";
				$fff = "document.location = 'video-serie?s=".base64_encode($listassv[$l])."&v=".base64_encode('Capitulo '.$i)."&t=".base64_encode($prioridad[$l])."';";
				if (file_exists($archivo)) {
					echo '<div class="contenidos" onclick="'.$fff.'" title="'."Capitulo ".$i.'"><img src="'.$archivoimg.'?v='.$version.'" class="imagenes"><br><p class="titulos">'."Capitulo ".$i.'</p></div>';
				}	
			}
		?>
	</div>
	<script type="text/javascript">
		<?php 
			echo " var cambioURL = setInterval( function () { localStorage.setItem('cambioURL', 'si'); localStorage.setItem('URL_Enviada', 'index?l=".$l."');}, 25);
            setTimeout('clearInterval(cambioURL)', 100);";
		?>
		var prioridad = (document.cookie.indexOf('prioridad_usuario=') === -1 ? '' : ("; " + document.cookie).split('; prioridad_usuario=')[1].split(';')[0]);
		if (prioridad >= <?php echo $prioridad[$l]; ?> || prioridad == <?php echo $prioridad[$l]; ?>) {
            console.log("Permitido");
            localStorage.setItem("nopermitido", "no");
        } else {
            localStorage.setItem("nopermitido", "si");
            localStorage.setItem("mensaje", "Esta lista no esta permitida para su usuario");
            for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
            	document.getElementsByClassName('contenidos')[i].style.display = "none";
            }
            document.location = "inicio.php";
        }
        </script>
	<div id="caratula">
		<?php
		for ($a=0; $a < count($extimg); $a++) {
		    $comprobar = "series/".$listassv[$l]."/portada.".$extimg[$a];
		    if (file_exists($comprobar)) {
				$archivoimg = $comprobar;
				echo '<div class="contenidos" title="'.$listassv[$l].'"><img src="'.$archivoimg.'?v='.$version.'" class="imagenes"><br><p class="titulos">'.$listassv[$l].'</p><a id=sinopsis>'.$descripcion[$l].'</a></div>';
			}
		}
		?>
	</div>
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad(argument) {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				document.getElementById('caratula').style.textAlign = "center";
				document.getElementById('ventanacontenido').style.top = "300px";
				document.getElementById('ventanacontenido').style.left = "0";
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "5px";
				}
				document.getElementById('sinopsis').style.display = "none";
			} else { 
				document.getElementById('caratula').style.textAlign = "left";
				document.getElementById('ventanacontenido').style.top = "15px";
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "10px";
				}
				document.getElementById('sinopsis').style.display = "block";
			}
		}
	</script>
</body>
<script type='text/javascript' src="js/sctube_ir.js"></script>
</html>
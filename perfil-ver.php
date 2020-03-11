<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="js/mododark.js"></script>
	<link rel="stylesheet" type="text/css" href="css/perfil-ver.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script type="text/javascript">
		<?php
			$u = $_REQUEST["u"];
            echo " var cambioURL = setInterval( function () { localStorage.setItem('cambioURL', 'si'); localStorage.setItem('URL_Enviada', 'index?u=".$u."');}, 25);
            setTimeout('clearInterval(cambioURL)', 100);";
        ?>
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad() {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				document.getElementById('perfilimagen').style.width = "200px";
				document.getElementById('perfilimagen').style.height = "200px";
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "5px";
				}
			} else { 
				document.getElementById('perfilimagen').style.width = "250px";
				document.getElementById('perfilimagen').style.height = "250px";
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "10px";
				}
			}
		}
	</script>
</head>
<body>
	<div id="info">
		<?php
			include 'nom_perfiles.php';
			$u = $_REQUEST["u"];
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
		?>
	</div>
	<br>
	<div id="contenido">
		<h3>Videos subidos:</h3>
		<?php
			include "version.php";
			include "extensiones.php";
			include "nom_videos.php";
			$archivo = 0;
			$num = 0;

			for ($i=0; $i < count($nombresv); $i++) {
				for ($a=0; $a < count($extimg); $a++) {
		            $comprobar = "img/".$i.".".$extimg[$a];
		            if (file_exists($comprobar) && $id_usuario[$i] == $id_obtenida) {
		            	$comilla = "'";
		                $archivo = $comprobar;
		                echo '<div class="contenidos" onclick="document.location = '."'".'video.php?v='.$i.'&t='.$i."'".';" title="'.$nombresv[$i].'"><img src="'.$archivo.'?v='.$version.'" class="imagenes"><br><p class="titulos">'.$nombresv[$i].'</p></div>';
		            }
		        }
			}
		?>
	</div>
	<?php } else {
			echo "<script>
				localStorage.setItem('nopermitido', 'si'); 
                localStorage.setItem('mensaje', 'Ah ocurrido un error');
                document.getElementsByTagName('body')[0].style.display = 'none';
                document.location = 'inicio.php';
			</script>";
		}?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/historial.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8">
	<script type="text/javascript" src="js/mododark.js"></script>
</head>
<body>
	<div id="titulo">
		<h1 id="nomlist">Historial:</h1>
		<button id="borrar" onclick="borrar();">Borrar</button>
	</div>
	<div id="ventanacontenido">
		<?php
			include "version.php";
			include "extensiones.php";
			include "nom_videos.php";
			$archivo = 0;

			for ($i=0; $i < count($nombresv); $i++) {
				for ($a=0; $a < count($extimg); $a++) {
		            $comprobar = "img/".$i.".".$extimg[$a];
		            if (file_exists($comprobar)) {
		                $archivo = $comprobar;
		                $b = "'".$nombresv[$i]."'";
		                echo '<div style="display: none;" class="contenidos" onclick="document.location = '."'".'video?v='.base64_encode($i).'&t='.base64_encode($i)."'".';" title="'.$nombresv[$i].'"><img src="'.$archivo.'?v='.$version.'" class="imagenes"><br><p class="titulos">'.$nombresv[$i].'</p></div>';
		            }
		        }
			}

			include "nom_listas.php";
            for ($r=0; $r < count($listassv); $r++) {
            	for ($i=0; $i < 1024; $i++) { 
					$archivo= "series/".$listassv[$r]."/Capitulo ".$i.".mp4";
					$archivoimg;
					$cd = '"';
					for ($a=0; $a < count($extimg); $a++) {
			            $comprobar2 = "series/".$listassv[$r]."/Capitulo ".$i.".".$extimg[$a];
			            if (file_exists($comprobar2)) {
			                $archivoimg = $comprobar2;
			                echo "
		    			  		<tr class='contsearch'>
				                    <div style='display: none;' class='contenidos ".$listassv[$r]."' onclick='sctube_irserie(".$cd.$listassv[$r].$cd.",".$cd."Capitulo ".$i.$cd.")' title='".'Capitulo '.$i."'><img src='".$archivoimg."?v=".$version."' class='imagenes'><p class='titulos'>".$listassv[$r]." - Capitulo ".$i."</p></div>
				                </tr>
		                	";
			            }
			        }	
				}
            }
		?>
	</div>
	<?php echo "
	<script>
		var contenidos = document.getElementsByClassName('contenidos');
		for (var i = 0; i < contenidos.length; i++) {
			var qwe = 'scv'+i;
			qwe = String(qwe);
			if(localStorage.getItem(qwe) == 'si') {
				contenidos[i].style.display = 'inline-table';
			} else {
				contenidos[i].style.display = 'none';
			}
		}

		function borrar() {
			for (var i = 0; i < contenidos.length; i++) {
				var qwe = 'scv'+i;
				qwe = String(qwe);
				localStorage.setItem(qwe, 'no');
				recargar();
			}
			borrarparalistas();
		}

		function recargar() {
			for (var i = 0; i < contenidos.length; i++) {
				var qwe = 'scv'+i;
				qwe = String(qwe);
				if(localStorage.getItem(qwe) == 'si') {
					contenidos[i].style.display = 'inline-table';
				} else {
					contenidos[i].style.display = 'none';
				}
				console.log(localStorage.getItem(qwe));
			}
		}
	</script>
	";
	echo "<script>";
	for ($i=0; $i < count($listassv); $i++) { 
		echo "
			var ds = document.getElementsByClassName('".$listassv[$i]."');
			for (var i = 0; i < ds.length; i++) {
				var qwet = 'scv'+'".$listassv[$i]."Capitulo '+i;
				qwet = String(qwet);
				if (localStorage.getItem(qwet) == 'si') {
					ds[i-1].style.display = 'inline-table';
				} else {
					ds[i].style.display = 'none';
				}
				console.log(localStorage.getItem(qwet));
			}
		";
	}
	echo "function borrarparalistas() {";
	for ($i=0; $i < count($listassv); $i++) { 
		echo "
			var ds = document.getElementsByClassName('".$listassv[$i]."');
			for (var i = 0; i < ds.length; i++) {
				var qwet = 'scv'+'".$listassv[$i]."Capitulo '+i;
				qwet = String(qwet);
				localStorage.setItem(qwet, 'no');
			}
		";
	}
	echo "}";
	echo "</script>";
	?>
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad(argument) {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				for (var i =  0; i < document.getElementsByClassName('imagenes').length; i++) {
					document.getElementsByClassName('imagenes')[i].style.width = "150px";
				}
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.width = "160px";
					document.getElementsByClassName('contenidos')[i].style.padding = "5px";
				}
				for (var i = 0; i < document.getElementsByClassName('titulos').length; i++) {
					document.getElementsByClassName('titulos')[i].style.width = "160px";
					document.getElementsByClassName('titulos')[i].style.fontSize = "12px";
				}
				document.getElementById('nomlist').style.fontSize = "18px";
				document.getElementById('borrar').style.height = "28px";
			} else { 
				for (var i =  0; i < document.getElementsByClassName('imagenes').length; i++) {
					document.getElementsByClassName('imagenes')[i].style.width = "150px";
				}
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.width = "160px";
					document.getElementsByClassName('contenidos')[i].style.padding = "10px";
				}
				for (var i = 0; i < document.getElementsByClassName('titulos').length; i++) {
					document.getElementsByClassName('titulos')[i].style.width = "160px";
					document.getElementsByClassName('titulos')[i].style.fontSize = "14px";
				}
				document.getElementById('nomlist').style.fontSize = "24px";
				document.getElementById('borrar').style.height = "30px";
			}
		}
	</script>
</body>
<script type='text/javascript' src="js/sctube_ir.js"></script>
</html>
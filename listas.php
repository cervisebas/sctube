<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		* {
			font-family: arial;
		}
		.imagenes {
			padding: 5px;
			width: 150px;
			display: inline-table;
			margin-left: 0.1px;
		}
		.contenidos {
			display: inline-block;
			text-align: center;
			width: 160px;
			height: auto;
			padding: 10px;
			margin-top: 0.1px;
		}
		.contenidos p {
			font-size: 14px;
			width: 160px;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}
		.contenidos:hover {
			background: rgba(0,0,0,0.5);
		}
		@media only screen and (orientation:portrait) {
		  	.contenidos { padding: 5px; }
		}
		@media only screen and (orientation:landscape) {

		}
	</style>
	<script type="text/javascript" src="js/mododark.js"></script>
</head>
<body>
	<div id="ventanacontenido">
		<?php
			include "version.php";
			include "extensiones.php";
			include "nom_listas.php";
			$num = 0;
			$archivoimg;
			for ($i=0; $i < count($listassv); $i++) {
				for ($a=0; $a < count($extimg); $a++) {
			        $comprobar = "series/".$listassv[$i]."/portada.".$extimg[$a];
			        if (file_exists($comprobar)) {
			            $archivoimg = $comprobar;
			        }
			    }
				echo '<div class="contenidos" onclick="sctube_listas('.$i.');" title="'.$listassv[$i].'"><img src="'.$archivoimg.'?v='.$version.'" class="imagenes"><br><p class="titulos">'.$listassv[$i].'</p></div>';	
			}
		?>
	</div>
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad(argument) {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "5px";
				}
			} else { 
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "10px";
				}
			}
		}
	</script>
</body>
<script type='text/javascript' src="js/sctube_ir.js"></script>
</html>
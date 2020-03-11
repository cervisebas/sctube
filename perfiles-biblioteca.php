<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		* {
			font-family: arial;
		}
		.perfiles-img {
			width: 150px;
			height: 150px;
			display: inline-table;
			user-select: none;
			border-radius: 50%;
			border: 3px solid #000;
			-webkit-clip-path: url(50% at 50% 50%);
			clip-path: url(50% at 50% 50%);
			object-fit: cover;
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
			font-size: 16px;
			width: 160px;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}
		.contenidos:hover {
			background: rgba(0,0,0,0.5);
		}
		/* Segun orientacion */

		@media only screen and (orientation:portrait) {
			.imagenes { width: 120px; height: 120px; }
		  	.contenidos { padding: 5px; }
		}
		@media only screen and (orientation:landscape) {

		}
	</style>
	<script type="text/javascript">
		var temp = setInterval(compatibilidad, 25);
		function compatibilidad(argument) {
			var dispositivo = navigator.userAgent.toLowerCase();        
			if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
				for (var i = 0; i < document.getElementsByClassName('perfiles-img').length; i++) {
					document.getElementsByClassName('perfiles-img')[i].style.width = "120px";
					document.getElementsByClassName('perfiles-img')[i].style.height = "120px";
				}
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "5px";
				}
			} else { 
				for (var i = 0; i < document.getElementsByClassName('perfiles-img').length; i++) {
					document.getElementsByClassName('perfiles-img')[i].style.width = "150px";
					document.getElementsByClassName('perfiles-img')[i].style.height = "150px";
				}
				for (var i = 0; i < document.getElementsByClassName('contenidos').length; i++) {
					document.getElementsByClassName('contenidos')[i].style.padding = "10px";
				}
			}
		}
	</script>
</head>
<body>
	<div id="contenido">
		<?php
			include "version.php";
			include "extensiones.php";
			include "nom_perfiles.php";
			$archivo = "img/usuario.jpg";

			for ($i=0; $i < count($id); $i++) {
				for ($a=0; $a < count($extimg); $a++) {
				    $comprobar = "img/user_".$id[$i].".".$extimg[$a];
				    if (file_exists($comprobar)) {
				        $archivo = $comprobar;
				    }
				}
				echo '<div class="contenidos" onclick="document.location = '."'"."perfil-ver.php?u=".$id[$i]."'".'" title="'.$nombre[$i].'"><img src="'.$archivo.'?'."?".rand().'" class="perfiles-img"><br><p class="titulos">'.$nombre[$i].'</p></div>';
				$archivo = "img/usuario.jpg";
			}
		?>
	</div>
</body>
<script type="text/javascript" src="js/mododark.js"></script>
</html>



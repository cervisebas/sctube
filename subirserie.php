<?php
	$tipo = $_POST['tipo'];

	if ($tipo == '1') {
		$archivo = $_FILES['archivo'];
		$elegido = $_POST['elegido'];
		$directorioinsertar = "series/".$elegido;
		if (isset($_FILES['archivo'])) {
			for ($i=1; $i < 2048; $i++) { 
				$verificar = $directorioinsertar."/Capitulo ".$i.".mp4";
				$verificar_imagen = $directorioinsertar."/Capitulo ".$i.".png";
				if (!file_exists($verificar)) {
					copy($_FILES['archivo']['tmp_name'], $verificar);
					echo "<p>Archivo Capitulo ".$i.".mp4 se guardo correctamente en ".$verificar.".</p> <br>";
					$i = 2049;
				}
			}
			for ($i=1; $i < 2048; $i++) {

				$currentPath = $_FILES['archivo']['tmp_name'];
				set_time_limit(3600);

				exec("ffprobe.exe");
				exec('ffprobe -i '.$currentPath.' -v quiet -print_format json -show_format -show_streams -hide_banner', $out, $res);
				$info = json_decode(implode($out));
				$time = $info->format->duration;

				$segundos_de_captura = round(($time/6), 0);
				$comprobar_numeros = strval($segundos_de_captura);
				$comprobar_numeros = strlen($comprobar_numeros);
				if ($comprobar_numeros == 1) { $segundos_de_captura = 0 . $segundos_de_captura; }
				for ($i=0; $i < 2; $i++) {
					if ($comprobar_numeros >= 3) {
						$segundos_de_captura = round(($segundos_de_captura / 6), 0);
						$comprobar_numeros = strval($segundos_de_captura);
						$comprobar_numeros = strlen($comprobar_numeros);
						$i = 0;
					} else {
						$i = 1;
					}
				}
				if ($comprobar_numeros == 1) { $segundos_de_captura = 0 . round(($time / 2), 0); }
				$minutos_captura = '00:00:' . $segundos_de_captura . "<br>";
				echo $minutos_captura;

				exec("ffmpeg.exe");
				exec("ffmpeg -i ".$currentPath."  -t ".$segundos_de_captura." -ss ".$segundos_de_captura." -vframes 1 temp.png", $out, $res);
				if($res==1){
					echo 'Error al crear imagen'; 
				} else {
					echo 'imagen creada correctamente';
					$convertir = imagecreatetruecolor(320, 180);
					$captura = imagecreatefrompng("temp.png");
					$AnchoOriginal = imagesx($captura);
					$AltoOriginal = imagesy($captura);
					imagecopyresampled( $convertir, $captura, 0,0,0,0, 320, 180 , $AnchoOriginal, $AltoOriginal);
					unlink("temp.png");
				}
				imagepng($convertir, $verificar_imagen, 9);
				$i = 2049;
			}
		}
	} else {
		if ($tipo == '2') {
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];
			$prioridad = $_POST['prioridad'];
			$portada = $_FILES['portada'];
			//Guardar en base de datos
			include "db.php";
			$acentos = $conexion->query("SET NAMES 'utf8'");
			$consulta = "INSERT INTO `sctube_users`.`lista_series` (`id`, `nombre`, `descripcion`, `prioridad`) VALUES (NULL, '".$nombre."', '".$descripcion."', '".$prioridad."');";
			$ejecutar = $conexion->query($consulta);
			echo "Lista ".$nombre." Guardada correctamente. <br>";
			$directorionuevo = "series/".$nombre;
			$crearnuevo = mkdir($directorionuevo, 0777, true);
			if ($crearnuevo) {
				echo "<p>Directorio ".$nombre." se creo correctamente.</p><br>";
			} else {
				echo "<p>Directorio ".$nombre." no se pudo crear.</p><br>";
			}
			$guardarimagen = $directorionuevo."/portada.png";
			copy($_FILES['portada']['tmp_name'], $guardarimagen);
			if (file_exists($guardarimagen)) {
				echo "<p>Archivo portada.png se guardo correctamente en el directorio ".$guardarimagen.".</p><br>";
			}
		}
	}
?>
<script type="text/javascript" src="js/mododark.js"></script>
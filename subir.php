<?php
	echo "<!DOCTYPE html><html>";
	echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><head>';

	$nombre;
	$prioridad;
	$genero;
	$cuenta;
	$id_usuario = $_COOKIE['id_usuario'];
	$fecha_subida = date("d")."/".date("m")."/".date("Y");
	$hora_subida = date("H").":".date("i")." ".date("A");

	if (isset($_POST['titulo']) && isset($_POST['cuenta']) &&  isset($_POST['genero'])) {
		$nombre = $_POST['titulo'];
		$genero = $_POST['genero'];
		$cuenta = $_POST['cuenta'];
		$id_usuario = $_COOKIE['id_usuario'];
		if (isset($_POST['prioridad'])) {
			if ($_POST['prioridad'] <= 5) {
				echo "<script> localStorage.setItem('mensaje', 'La prioridad asignada no es valida.'); localStorage.setItem('nopermitido', 'si'); </script>";
			} else {
				$prioridad = $_POST['prioridad'];
			}
		} else {
			$prioridad = 0;
		}

		if ($_FILES['archivo']['tmp_name']) {
			include 'db.php';
			$id = [];
			$consulta = "SELECT * FROM `lista_videos` ORDER BY `id` ASC";
			$ejecutar = $conexion->query($consulta);
			$contador=0;
			while($fila = $ejecutar->fetch_array()) : 
				$id[$contador] = $fila['id'];
				$contador = $contador + 1;
			endwhile;
			$cantidad = count($id);
			$ObtenerID = $contador;
			SubirDatos($ObtenerID);
			//Guardar en base de datos
			include "db.php";
			$acentos = $conexion->query("SET NAMES 'utf8'");
			$consulta = "INSERT INTO `lista_videos`(`id`, `nombre`, `prioridad`, `usuario`, `id_usuario`, `tipo`, `descripcion`, `fecha_subida`, `hora_subida`) VALUES (NULL, '".$nombre."', '".$prioridad."', '".$cuenta."', '".$id_usuario."', '".$genero."', NULL, '".$fecha_subida."', '".$hora_subida."');";
			$ejecutar = $conexion->query($consulta);
			echo "<script> localStorage.setItem('mensaje', 'El contenido ".$nombre." se agrego correctamente'); localStorage.setItem('nopermitido', 'si'); </script>";
			echo '<script type="text/javascript" src="mododark.js"></script>';
		}
	} else {
		echo "<script> alert('Los datos ingresados no estaban completos'); </script>";
	}


	function SubirDatos($id) {
		if ($_FILES['archivo']['tmp_name']) {
			$nombreDelArchivoVideo = $_FILES['archivo']['name'];
			$extensionvideo = pathinfo($nombreDelArchivoVideo, PATHINFO_EXTENSION);
			$destinovideo;
			$comprovar = "mp4/".$id.".".$extensionvideo;
			if (!file_exists($comprovar)) {
				$destinovideo = $comprovar;
			}
			copy($_FILES['archivo']['tmp_name'], $destinovideo);
		}
		if ($_FILES['imagen']['tmp_name']) {
			$imagenoriginal = $_FILES['imagen']['tmp_name'];
			$nombreDelArchivoImagen = $_FILES['imagen']['name'];
			$extensionimagen = pathinfo($nombreDelArchivoImagen, PATHINFO_EXTENSION);
			$destinoimagen;
			switch ($extensionimagen) {
				case 'jpeg':
					$ImagenSubida = imagecreatefromjpeg($imagenoriginal);
					break;
				case 'png':
					$ImagenSubida = imagecreatefrompng($imagenoriginal);
					break;
				case 'jpg':
					$ImagenSubida = imagecreatefromjpeg($imagenoriginal);
					break;
				case 'gif':
					$ImagenSubida = imagecreatefromgif($imagenoriginal);
					break;
				case 'wbmp':
					$ImagenSubida = imagecreatefromwbmp($imagenoriginal);
					break;
			}
			$AnchoOriginal = imagesx($ImagenSubida);
			$AltoOriginal = imagesy($ImagenSubida);
			$convertir = imagecreatetruecolor(320, 180);
			imagecopyresampled( $convertir, $ImagenSubida, 0,0,0,0, 320, 180 , $AnchoOriginal, $AltoOriginal);
			$comprovar = "img/".$id.".".$extensionimagen;
			if (file_exists($comprovar)) {
				echo "Procesando...";
			} else {
				$destinoimagen = $comprovar;
			}
			imagepng($convertir, $destinoimagen, 9);
		} else {
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
			if ($comprobar_numeros == 2) { $segundos_de_captura = round(($time / 2), 0); }
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
				imagepng($convertir, "img/".$id.".png", 9);

				imagedestroy($captura);
				unlink("temp.png");
			}
		}
	}
?>
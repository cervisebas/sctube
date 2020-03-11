<?php
	include 'db.php';
	$nombresv = [];
	$lista_inicio = [];
	$tipo = [];
	$usuario = [];
	$prioridad = [];
	$id = [];
	$descripcion = [];
	$id_usuario = [];
	$fecha_subida = [];
	$hora_subida = [];
	$consulta = "SELECT * FROM `lista_videos` ORDER BY `id` ASC";
	$ejecutar = $conexion->query($consulta);
	$contador=0;
	while($fila = $ejecutar->fetch_array()) :
		$nombresv[$contador] = $fila['nombre'];
		$tipo[$contador] = $fila['tipo'];
		$usuario[$contador] = $fila['usuario'];
		$prioridad[$contador] = $fila['prioridad'];
		$id[$contador] = $fila['id'];
		$descripcion[$contador] = $fila['descripcion'];
		$id_usuario[$contador] = $fila['id_usuario'];
		$fecha_subida[$contador] = $fila['fecha_subida'];
		$hora_subida[$contador] = $fila['hora_subida'];
		$contador = $contador + 1;
	endwhile;
	/*for ($i=0; $i < $contador; $i++) { 
		echo "Nombre: ".$nombresv[$i]." Tipo: ".$tipo[$i]." Usuario: ".$usuario[$i]." Prioridad: ".$prioridad[$i]." Id: ".$id[$i]."<br>";
	}*/
?>
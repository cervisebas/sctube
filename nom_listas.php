<?php
	include 'db.php';
	$listassv = [];
	$prioridad = [];
	$descripcion = [];
	$id = [];
	$consulta = "SELECT * FROM `lista_series` ORDER BY `id` ASC";
	$ejecutar = $conexion->query($consulta);
	$contador=0;
	while($fila = $ejecutar->fetch_array()) :
		$listassv[$contador] = $fila['nombre'];
		$prioridad[$contador] = $fila['prioridad'];
		$descripcion[$contador] = $fila['descripcion'];
		$id[$contador] = $fila['id'];
		$contador = $contador + 1;
	endwhile;
?>
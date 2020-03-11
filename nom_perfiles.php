<?php
	include 'db.php';
	$id = [];
	$usuario = [];
	$nombre = [];
	$prioridad = [];
	$consulta = "SELECT * FROM `usuarios` ORDER BY `id` ASC";
	$ejecutar = $conexion->query($consulta);
	$contador=0;
	while($fila = $ejecutar->fetch_array()) :
		$id[$contador] = $fila['id'];
		$usuario[$contador] = $fila['user'];
		$nombre[$contador] = $fila['nombre'];
		$prioridad[$contador] = $fila['prioridad'];
		$contador = $contador + 1;
	endwhile;
	/*for ($i=0; $i < $contador; $i++) { 
		echo "Nombre: ".$nombresv[$i]." Tipo: ".$tipo[$i]." Usuario: ".$usuario[$i]." Prioridad: ".$prioridad[$i]." Id: ".$id[$i]."<br>";
	}*/
?>
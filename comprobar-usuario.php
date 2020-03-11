<?php
	include 'db.php';
	//$nombresv = utf8_decode($_COOKIE['nombre_usuario']);
	$id = $_COOKIE['id_usuario'];
	$usuario = $_COOKIE['user_usuario'];
	$contracena = $_COOKIE['qweasdzxcrfvtgbnmjhyuikmloñlkijhytgfrdecb'];

	include "db.php";
	$consulta = "SELECT `id`, `user`, `password`, `nombre`, `prioridad` FROM `usuarios` WHERE id=".$id;
	$ejecutar = $conexion->query($consulta);
	while($fila = $ejecutar->fetch_array()) : 
		if ($id === $fila['id'] && $usuario === $fila['user'] && $contracena === $fila['password']) {
			echo "<script>  </script>";
		} else {
			echo "<script>
					document.cookie = 'id_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					document.cookie = 'nombre_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					document.cookie = 'user_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					document.cookie = 'prioridad_usuario= ; expires = Thu, 01 Jan 1970 00:00:00 GMT';
					localStorage.setItem('nombre_sctube', 'default');
				</script>";
		}
		/*echo "<script> console.log('".$fila['nombre']."'); </script>";
		echo "<script> console.log('".$fila['id']."'); </script>";
		echo "<script> console.log('".$fila['user']."'); </script>";
		echo "<script> console.log('".$fila['password']."'); </script>";

		echo "<script> console.log('Guardado: ".$nombresv."'); </script>";
		echo "<script> console.log('Guardado: ".$id."'); </script>";
		echo "<script> console.log('Guardado: ".$usuario."'); </script>";
		echo "<script> console.log('Guardado: ".$contracena."'); </script>";*/
	endwhile;
	//SELECT * FROM `usuarios` WHERE 1
?>
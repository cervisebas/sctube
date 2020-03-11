<?php
	if (isset($_POST['ingresar_usuario']) && isset($_POST['ingresar_password'])) {
		include "db.php";
		$consulta = "SELECT `id`, `user`, `password`, `nombre`, `prioridad` FROM `usuarios` WHERE `usuarios`.`user` = '".$_POST['ingresar_usuario']."'";
		$ejecutar = $conexion->query($consulta);
		$fila = $ejecutar->fetch_array();
		$id = $fila['id'];
		$user = $fila['user'];
		$password = $fila['password'];
		$nombre = $fila['nombre'];
		$prioridad = $fila['prioridad'];
		if ($id == NULL) {
			echo "<h2> El usuario al que intenta acceder no existe </h2> <br> <p onclick='volver_acceder()'> Volver a intentar </p>";
		} else {
			if ($_POST['ingresar_password'] === $password) {
				echo "<h1 onload='hola()'> Bienvenido </h1>";
				include 'extensiones.php';
				$siimagen = 0;
			    for ($i=0; $i < count($extimg); $i++) {
			        $comprobar = "img/user_".$id.".".$extimg[$i];
			        if (file_exists($comprobar)) {
			            echo "<img id='perfilimagen' class='perfiles-img' src='".$comprobar."?".rand()."'>";
			            $siimagen = 1;
			    	}
			    }
			    if ($siimagen == 0) {
			    	echo "<img id='perfilimagen' class='perfiles-img' src='img/usuario.jpg'>";
			    }
			    echo "<h2 id='nombre_usuario_escrito'>".$nombre."</h2>";
			    echo "<h4>#".$user."_".$id."</h4>";
			    echo "<div id='contenedor'> <div class='loader' id='loader'>Loading...</div> </div>";
			    setcookie("id_usuario", $id, time() + 30879000);
				setcookie("nombre_usuario", $nombre, time() + 30879000);
				setcookie("user_usuario", $user, time() + 30879000);
				setcookie("prioridad_usuario", $prioridad, time() + 30879000);
				setcookie("qweasdzxcrfvtgbnmjhyuikmloñlkijhytgfrdecb", $password, time() + 30879000);
			} else {
				echo "<h2> La contraseña ingresada es incorrecta </h2>  <br> <p onclick='volver_acceder()'> Volver a intentar </p>";
			}
		}
	}
	if (isset($_POST['registrar_nombre']) && isset($_POST['registrar_usuario']) && isset($_POST['registrar_password'])) {
		include "db.php";
		$consulta = "SELECT `id`, `user`, `password`, `nombre`, `prioridad` FROM `usuarios` WHERE `usuarios`.`user` = '".$_POST['registrar_usuario']."'";
		$ejecutar = $conexion->query($consulta);
		$fila = $ejecutar->fetch_array();
		$id = $fila['id'];
		$nombre = $fila['nombre'];
		if (!$id == NULL || $_POST['registrar_nombre'] == $nombre) {
			echo "<h2> El usuario ya existe </h2> <br> <p onclick='volver_registrar()'> Volver </p>";
		} else {
			include "db.php";
			$usuario = $_POST['registrar_usuario'];
			$contra = $_POST['registrar_password'];
			$nombre = $_POST['registrar_nombre'];
			$consulta = "INSERT INTO `sctube_users`.`usuarios` (`id`, `user`, `password`, `nombre`, `prioridad`) VALUES (NULL, '".$usuario."', '".$contra."', '".$nombre."', '1');";
			$ejecutar = $conexion->query($consulta);
			if (isset($_FILES['registrar_foto'])) {
				$consulta = "SELECT `id`, `user`, `password`, `nombre`, `prioridad` FROM `usuarios` WHERE `usuarios`.`user` = '".$usuario."'";
				$ejecutar = $conexion->query($consulta);
				$fila = $ejecutar->fetch_array();
				$id = $fila['id'];
				$nombreDelArchivoImagen = $_FILES['registrar_foto']['name'];
				$extensionimagen = pathinfo($nombreDelArchivoImagen, PATHINFO_EXTENSION);
				$destinofoto = "img/user_".$id.".".$extensionimagen;
				copy($_FILES['registrar_foto']['tmp_name'], $destinofoto);
			}
			echo "<h2> Usuario Creado </h2> <br> <p onclick='volver_acceder()'> Iniciar Sesion </p>";
		}
	}
?>
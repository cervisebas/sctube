<?php
	$id_usuario = $_COOKIE['id_usuario'];
	if (isset($_POST['nombre'])) {
		$name = $_POST['nombre'];
		setcookie("nombre_usuario", $name, time() + 30879000);
		include 'db.php';
		$consulta = "UPDATE `sctube_users`.`usuarios` SET `nombre` = '".$name."' WHERE `usuarios`.`id` = ".$id_usuario;
		$ejecutar = $conexion->query($consulta);
		echo "<script> localStorage.setItem('nopermitido', 'si'); localStorage.setItem('mensaje', 'Modificacion exitosa'); </script>";
	}


	if (isset($_POST['user'])) {
		$usuario = $_POST['user'];
		setcookie("nombre_usuario", $usuario, time() + 30879000);
		include 'db.php';
		$consulta = "UPDATE `sctube_users`.`usuarios` SET `user` = '".$usuario."' WHERE `usuarios`.`id` = ".$id_usuario;
		$ejecutar = $conexion->query($consulta);
		echo "<script> localStorage.setItem('nopermitido', 'si'); localStorage.setItem('mensaje', 'Modificacion exitosa'); </script>";
	}


	if (isset($_POST['password'])) {
		$password = $_POST['password'];
		setcookie("nombre_usuario", $password, time() + 30879000);
		include 'db.php';
		$consulta = "UPDATE `sctube_users`.`usuarios` SET `password` = '".$password."' WHERE `usuarios`.`id` = ".$id_usuario;
		$ejecutar = $conexion->query($consulta);
		echo "<script> localStorage.setItem('nopermitido', 'si'); localStorage.setItem('mensaje', 'Modificacion exitosa'); </script>";
	}

	if (isset($_FILES['imagen'])) {

		include 'extensiones.php';
	    for ($i=0; $i < count($extimg); $i++) {
	        $comprobar = "img/user_".$_COOKIE['id_usuario'].".".$extimg[$i];
	        if (file_exists($comprobar)) {
	            unlink($comprobar);
	    	}
	    }

	    $nombreDelArchivoImagen = $_FILES['imagen']['name'];
		$extensionimagen = pathinfo($nombreDelArchivoImagen, PATHINFO_EXTENSION);
		copy($_FILES['imagen']['tmp_name'], "img/user_".$_COOKIE['id_usuario'].".".$extensionimagen);
		echo "<script> localStorage.setItem('nopermitido', 'si'); localStorage.setItem('mensaje', 'Modificacion exitosa'); </script>";
	}
?>
<script type="text/javascript">
	setTimeout('document.location ="inicio.php";',2000);
</script>
<?php
	$user = "root";
	$pass = "";
	$server = "localhost";
	$base_datos = "sctube_users";

	$conexion = new mysqli($server, $user, $pass, $base_datos) or die ("No se pudo conectar");
?>
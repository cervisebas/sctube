<?php
	include 'nom_perfiles.php';
	$u = $_COOKIE["id_usuario"];
	for ($i=0; $i < count($id); $i++) { 
		if ($u === $id[$i]) {
			$id_obtenida = $u;
			$num_parte = $i;
			$usuario_encontrado = 1;
		}
	}
	if ($usuario_encontrado == 1) {
		include 'extensiones.php';
		$siimagen = 0;
	    for ($i=0; $i < count($extimg); $i++) {
	        $comprobar = "img/user_".$id_obtenida.".".$extimg[$i];
	        if (file_exists($comprobar)) {
	            echo "<img id='perfilimagen' class='perfiles-img' src='".$comprobar."?".rand()."'>";
	            $siimagen = 1;
	    	}
	    }
	    if ($siimagen == 0) {
	    	echo "<img id='perfilimagen' class='perfiles-img' src='img/usuario.jpg'>";
	    }
    	echo "<h1>".$nombre[$num_parte]."</h1>";
	    echo "<p>#".$usuario[$num_parte]."_".$u.".".$num_parte."</p>";
    }
?>
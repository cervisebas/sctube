<!DOCTYPE html>
<html>
<head>
	<title>Administracion - SCTube</title>
	<meta charset="utf-8">
	<style type="text/css">
		* {
			font-family: arial;
		}
		table tr td {
			font-size: 14px;
		}
	</style>
</head>
<body>

		<table border="2px">
			<tr>
				<td>ID</td>
				<td>Nombre</td>
				<td>Prioridad</td>
				<td>Usuario</td>
				<td>Tipo</td>
				<td>Descripcion</td>
			</tr>
			<?php
				include 'nom_videos.php';
				for ($i=0; $i < count($id); $i++) { 
					echo "
						<tr>
							<td>".$id[$i]."</td>
							<td>".$nombresv[$i]."</td>
							<td>".$prioridad[$i]."</td>
							<td>".$usuario[$i]."</td>
							<td>".$tipo[$i]."</td>
							<td>".$descripcion[$i]."</td>
						</tr>
					";
				}
			?>
		</table>

</body>
</html>
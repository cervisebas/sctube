<!DOCTYPE html>
<?php
	if (!isset($_REQUEST['search'])) {
		echo '<script> localStorage.setItem("nopermitido", "si"); localStorage.setItem("mensaje", "Ah ocurrido un error"); document.location = "inicio.php"; </script>';
	} else {
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="js/jquery.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <style type="text/css">
    	#input-search{
			/*margin-top: 0.1px;
		    width: 500px;
		    height: 40px;
		    font-size: 20px;
		    text-indent: 10px;
		    margin-left: 220px;*/
		    display: none;
		}

		.content-search{
		    width: 100%;
		    height: 100%;
		    position: absolute;
		    left: 0;
		    top: 0;
		}

		.content-table{
			color: #000;
		    width: 100%;
		    height: 100%;
		    overflow-y: visible;
		    overflow-x: hidden;
		}

		.content-table table{
		    width: 100%;
		}

		tbody tr td a{
			color: #000000;
			font-family: Arial;
		    display: block;
		    padding: 10px;
		    text-decoration: none;
		}

		/*.tbody tr td a:hover{
		    background: rgba(148,167,145,0.3);
		}*/

		#table_length, #table_filter, #table_info, #table_paginate{
		    display: none;
		}


		.tbody tr td a {
			font-size: 15px;
			color: #000;
			text-decoration: none;
		    font-weight: bold;
		    margin-left: 10px;
		    vertical-align: 50px;
			display: inline-table;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}
		.tbody tr {
			box-shadow: 0 0 20px rgba(0,0,0,.1);
		}
		.tbody tr td img {
			margin: 10px;
			height: 100px;
			display: inline-table;
		}
		.tbody tr td img:hover {
			box-shadow: 0 0 20px rgba(106,255,17,0.8);
		}
		.tbody tr td a:hover {
			color: rgba(106,255,17);
			text-decoration: underline;
		}

		@media only screen and (orientation:portrait) {
			.tbody tr td img { margin: 5px; height: 70px; width: 130px; }
			.tbody tr td a { vertical-align: 35px; font-size: 11px; }
		}
		@media only screen and (orientation:landscape) {

		}
    </style>
    <script type="text/javascript" src="js/mododark.js"></script>
</head>
<body>
	
	<?php $search = $_REQUEST["search"]; echo '<input type="search" id="input-search" placeholder="Buscar" value="'.$search.'">'; ?>

    <div class="content-search">
        <div class="content-table">
            <table id="table">
                <thead>
                    <tr>
                        <td></td>
                    </tr>
                </thead>
                
                <tbody class="tbody">
                    <?php 
                    include "version.php";
                    include "nom_videos.php";
            		include "extensiones.php";
                    $cantidadnombres = count($nombresv);
                    for ($i=0; $i < count($nombresv); $i++) {
		                for ($a=0; $a < count($extimg); $a++) {
		                    $comprobar = "img/".$i.".".$extimg[$a];
		                    if (file_exists($comprobar)) {
		                        $archivo = $comprobar;
		                        $b = "'".$nombresv[$i]."'";
		                        echo '
		                        	<tr class="conlatder" onclick="document.location = '."'".'video.php?v='.base64_encode($i)."'".';" title="'.$nombresv[$i].'">
		                        		<td><img src="'.$archivo.'?v='.$version.'" class="imagenes"><a class="titulos">'.$nombresv[$i].'</a></td>
		                        	</tr>
		                        ';
		                    }
		                }
		            }
                    include "nom_listas.php";
                    $cantidadlistas = count($listassv);
                    for ($r=0; $r < $cantidadlistas; $r++) {
                    	for ($i=0; $i < 256; $i++) { 
							$archivo= "series/".$listassv[$r]."/Capitulo ".$i.".mp4";
							$archivoimg= "series/".$listassv[$r]."/Capitulo ".$i.".png";
							$cd = '"';
							if (file_exists($archivo)) {
								echo "
		                    		<tr class='contsearch'>
				                        <td onclick='sctube_irserie(".$cd.$listassv[$r].$cd.",".$cd."Capitulo ".$i.$cd.")' title='".'Capitulo '.$i."'><img src='".$archivoimg."?v=".$version."'><a class='titulos'>".$listassv[$r]." - Capitulo ".$i."</a></td>
				                    </tr>
		                    	";
							}	
						}
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="js/search.js"></script>
</body>
<script type='text/javascript' src="js/sctube_ir.js"></script>
</html>
<?php } ?>
<!DOCTYPE html>
<?php
include 'nom_videos.php';
if (isset($_GET['v'])) {
    include "nom_videos.php";
    if (base64_decode($_GET['v']) > count($nombresv)) {
        echo '<script> localStorage.setItem("nopermitido", "si"); localStorage.setItem("mensaje", "Ah ocurrido un error"); document.location = "inicio.php"; </script>';
    } else if ($_COOKIE['prioridad_usuario'] < $prioridad[base64_decode($_GET['v'])]) {
        echo '<script> localStorage.setItem("nopermitido", "si"); localStorage.setItem("mensaje", "No tienes permitido ver este video"); document.location = "inicio.php"; </script>';
    } else {
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="ico/5.ico">
    <link rel="stylesheet" href="css/video.css">

    <link rel="stylesheet" href="css/video-js.css">
    <script src="js/video.js"></script>
    <link rel="stylesheet" href="css/estilos-js.css">
    <script type="text/javascript" src="js/mododark.js"></script>
    <style type="text/css">
        .video-js {
            outline: none;
        }
        @media only screen and (orientation:portrait) {
            .contenido { width: 100%; height: 75%; margin-left: 0px; margin-top: 5px; }
            main .contenedor { width: 100%; height: 75%; margin-left: 0px; }
            .barra-lateral-derecho { position: static; width: 100%; }
            .perfil { padding: 10px; }
            #repauto input { position: static; top: 0; right: 0; vertical-align: -4px; }
            #repauto h2 { display: inline-flex; }
        }
        @media only screen and (orientation:landscape) {

        }
    </style>
    <script type="text/javascript">
        <?php 
            $v = $_REQUEST["v"];
            $t = $_REQUEST["v"];
            echo " var cambioURL = setInterval( function () { localStorage.setItem('cambioURL', 'si'); localStorage.setItem('URL_Enviada', 'index?v=".$v."');}, 25);
            setTimeout('clearInterval(cambioURL)', 100);";
        ?>
        var temp = setInterval(compatibilidad, 25);
        function compatibilidad() {
            var dispositivo = navigator.userAgent.toLowerCase();        
            if( dispositivo.search(/iphone|ipod|ipad|android|blackberry|windows phone/) > -1 ) {
                document.getElementsByClassName('contenido')[0].style.width = "100%";
                document.getElementsByClassName('contenido')[0].style.height = "75%";
                document.getElementsByClassName('contenido')[0].style.marginLeft = "0px";
                document.getElementsByClassName('contenido')[0].style.marginTop = "5px";

                document.getElementsByClassName('contenedor')[0].style.width = "100%";
                document.getElementsByClassName('contenedor')[0].style.height = "75%";
                document.getElementsByClassName('contenedor')[0].style.marginLeft = "0px";

                document.getElementsByClassName('barra-lateral-derecho')[0].style.width = "100%";
                document.getElementsByClassName('barra-lateral-derecho')[0].style.position = "static";

                document.getElementsByClassName('perfil')[0].style.padding = "10px";

                document.getElementById('reproduauto').style.position = "static";
                document.getElementById('reproduauto').style.top = "0";
                document.getElementById('reproduauto').style.right = "0";
                document.getElementById('reproduauto').style.verticalAlign = "-4px";
                document.getElementById('h2repauto').style.display = "inline-flex";
            } else {
                document.getElementsByClassName('contenido')[0].style.marginLeft = "10px";
                document.getElementsByClassName('contenido')[0].style.marginTop = "15px";

                document.getElementsByClassName('contenedor')[0].style.width = "64%";
                document.getElementsByClassName('contenedor')[0].style.height = "75%";
                document.getElementsByClassName('contenedor')[0].style.marginLeft = "0px";

                document.getElementsByClassName('barra-lateral-derecho')[0].style.width = "34%";
                document.getElementsByClassName('barra-lateral-derecho')[0].style.position = "absolute";

                document.getElementsByClassName('perfil')[0].style.padding = "15px";

                document.getElementById('reproduauto').style.position = "absolute";
                document.getElementById('reproduauto').style.top = "15px";
                document.getElementById('reproduauto').style.right = "15px";
                document.getElementById('h2repauto').style.display = "inline-flex";
            }
        }
    </script>
</head>

<body>
    <main class="contenido">
    	<?php
            include "nom_videos.php";
            include "extensiones.php";
            include "version.php";
    		$v = base64_decode($_REQUEST["v"]);
            $videocext;
            $extguardar;
            for ($i=0; $i < count($extvid); $i++) {
                $comprobar = "mp4/".$v.".".$extvid[$i];
                if (file_exists($comprobar)) {
                    $videocext = $comprobar;
                    $extguardar = $extvid[$i];
                }
            }
    		echo "
    			<div class='contenedor' id='contenedor'>
    		        <video style='outline: none;' class='fm-video video-js vjs-16-9 vjs-big-play-centered' data-setup='{}' controls id='fm-video' poster='img/".$v.".png".'?v='.$version."' autoplay preload='auto' controlsList='nodownload'>
    		            <source id='sourse' src='".$videocext."' type='video/".$extguardar."'>;
                        <p> El video no esta disponible. </p>
    		        </video>
    		    </div>
    		";
    	?>
    </main>
    
    <?php include "nom_videos.php"; echo "<h2 class='titulo' id='titulo'>".$nombresv[$v]."</h2>";?>
    <section class="perfil">
        <table>    
            <tr class="primero" <?php echo "onclick='document.location = ".'"'."perfil-ver?u=".$id_usuario[$v].'"'."';"; ?>>
                <td class="perimg"><a>
                    <?php 
                    include 'nom_videos.php';
                        $siimagen = 0;
                        for ($i=0; $i < count($extimg); $i++) {
                            $comprobar = "img/user_".$id_usuario[$v].".".$extimg[$i];
                            if (file_exists($comprobar)) {
                                echo "<img id='perfilimagen'>";
                                echo '<script type="text/javascript"> document.getElementById("perfilimagen").src = "'.$comprobar.'"; </script>';
                                $siimagen = 1;
                            }
                        }
                        if ($siimagen == 0) {
                            echo "<img src='img/usuario.jpg'>";
                        }
                    ?>
                </a></td>
                <td class="td2"><a class="nom" id="nom_perfil"> <b> 
                <?php 
                    $id_obtenida_usuario = $id_usuario[$v];
                    include "nom_perfiles.php";
                    for ($i=0; $i < count($id); $i++) { 
                        if ($id[$i] == $id_obtenida_usuario) {
                            echo $nombre[$i];
                        }
                    } 
                ?> </b><br> <i class="public"> Publicado <?php echo $fecha_subida[$v]." ".$hora_subida[$v]; ?> </i> </a></td>
            </tr>

            <tr class="descripcion">
                <td></td>
                <td> <b>Categoria:</b> <u><?php echo $tipo[$v]; ?></u> <br> <a href="<?php echo $videocext; ?>" download="<?php echo $nombresv[$v]; ?>"><i>Descargar Video</i></a> </td>
            </tr>
        </table>
    </section>
    <section class="barra-lateral-derecho">
        <table>
            <tr class="conlatder"><td id="repauto"><h2 id="h2repauto">Reproduccion automatica</h2><input id="reproduauto" name="reproduccion" type="checkbox"></td></tr>
            <?php  
                include "nom_videos.php";
                include "version.php";
                include "extensiones.php";
                $cantidad = count($nombresv);

                for ($i=0; $i < count($nombresv); $i++) {
                    for ($a=0; $a < count($extimg); $a++) {
                        $comprobar = "img/".$i.".".$extimg[$a];
                        if (file_exists($comprobar)) {
                            $archivo = $comprobar;
                            $b = "'".$nombresv[$i]."'";
                            echo '<tr class="conlatder" onclick="document.location = '."'".'video?v='.base64_encode($i).'&t='.base64_encode($i)."'".';" title="'.$nombresv[$i].'"><td><a><img src="'.$archivo.'?v='.$version.'" class="imagenes"></a></td> <td><a><h2 class="titulos">'.$nombresv[$i].'</h2></a></td></tr>';
                        }
                    }
                }
            ?>
        </table>
        <script type="text/javascript">
            var checkbox = document.getElementById('reproduauto');
            var autorep = 0;
            var fmvideo = document.getElementById('fm-video');
            var duracion = fmvideo.duration;
            checkbox.addEventListener("change", validaCheckbox, false);

            if (localStorage.getItem('reproduauto') == "si") {
                checkbox.checked = 1;
                validaCheckbox();
            } else {
                checkbox.checked = 0;
                validaCheckbox();
            }

            function validaCheckbox(){
                var checked = checkbox.checked;
                if(checked){
                    autorep = 1;
                    localStorage.setItem('reproduauto', "si");
                } else {
                    autorep = 0;
                    clearInterval(checkbox);
                    localStorage.setItem('reproduauto', "no");
                }
            }
            <?php echo "localStorage.setItem('scv".$v."', 'si');"; ?>
            var tmp = setInterval(siguiente, 25);
            <?php 
                include "nom_videos.php";
                echo "
                    function siguiente() {
                        localStorage.setItem('scv".$v."', 'si');
                        var numero = ".$v.";
                        if (autorep == 1) {
                            var duracion = fmvideo.duration;
                            if (fmvideo.currentTime === duracion && ".$v." < parseInt(".count($nombresv)."-1)) {
                                clearInterval(tmp);
                                var ir = parseInt(".$v."+1);
                                document.location ='video?v='+ir;
                            }
                        }
                    }"; ?>
            /*window.addEventListener("orientationchange", function() { cambiarpantallacompleta(); }, false);
            function cambiarpantallacompleta() {
                var video_pantalla = document.getElementById('fm-video');
                var dispositivo = navigator.userAgent.toLowerCase();
                if (dispositivo.search(/iphone|ipod|ipad|android|blackberry|windows phone/) > -1 && (window.orientation == 90 || window.orientation == -90)) {
                    if(video_pantalla.requestFullscreen) {
                        video_pantalla.requestFullscreen();
                    } else if(video_pantalla.mozRequestFullScreen) {
                        video_pantalla.mozRequestFullScreen();
                    } else if(video_pantalla.webkitRequestFullscreen) {
                        video_pantalla.webkitRequestFullscreen();
                    } else if(video_pantalla.msRequestFullscreen) {
                        video_pantalla.msRequestFullscreen();
                    }
                }
            }*/
        </script>
    </section>
<script type="text/javascript" src="js/sctube_ir.js"></script>
</body>
</html>
<?php 
    }
} else {
    echo '<script> localStorage.setItem("nopermitido", "si"); localStorage.setItem("mensaje", "Ah ocurrido un error"); document.location = "inicio"; </script>';
} ?>
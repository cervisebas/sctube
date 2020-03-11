<!DOCTYPE html>
<?php
if (isset($_GET['v']) && isset($_GET['s']) && isset($_GET['t'])) {
    include 'nom_listas.php';
    if ($_COOKIE['prioridad_usuario'] < $prioridad[base64_decode($_REQUEST['t'])]) {
        echo '<script> localStorage.setItem("nopermitido", "si"); localStorage.setItem("mensaje", "No tienes permitido ver este video"); document.location = "inicio.php"; </script>';
    } else {
?>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
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
        var temp = setInterval(compatibilidad, 25);
        function compatibilidad(argument) {
            var dispositivo = navigator.userAgent.toLowerCase();        
            if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
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
                //document.getElementsByClassName('contenido')[0].style.width = "100%";
                //document.getElementsByClassName('contenido')[0].style.height = "100%";
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
        include "extensiones.php";
        include "version.php";
        $v = base64_decode($_REQUEST["v"]);
        $s =base64_decode($_REQUEST["s"]);
        $videocext;
        $extguardar;
        for ($i=0; $i < count($extvid); $i++) {
            $comprobar = "series/".$s."/".$v.".".$extvid[$i];
            if (file_exists($comprobar)) {
                $videocext = $comprobar;
                $extguardar = $extvid[$i];
            }
        }
        $archivoposter;
        for ($a=0; $a < count($extimg); $a++) {
            $comprobar2 = "series/".$s."/".$v.".".$extimg[$a];
            if (file_exists($comprobar2)) {
                $archivoposter = $comprobar2;
            }
        }
        echo "
            <div class='contenedor'>
                <video class='fm-video video-js vjs-16-9 vjs-big-play-centered' data-setup='{}' controls id='fm-video' poster='".$archivoposter.'?v='.$version."' autoplay>
                    <source src='".$videocext."' type='video/".$extguardar."'>;
                    <p> El video no esta disponible. </p>
                </video>
            </div>
        ";
	?>
</main>

<?php echo "<h2 class='titulo' id='titulo'>".$s.' - '.$v."</h2>"; ?>


<section class="perfil">
    <table>    
        <tr class="primero">
            <td class="perimg"><a><img src="img/usuario.jpg"></a></td>
            <td class="td2"><a class="nom"> <b>Anime</b><br> <i class="public"> Publicado 13/06/2019 18:34 </i> </a></td> 
        </tr>

        <tr class="descripcion">
            <td></td>
            <td> <b>Categoria:</b> <u> Series Anime </u> <br> <a href="<?php echo $videocext; ?>" download="<?php echo $s.' - '.$v; ?>"><i>Descargar Capitulo</i></a> </td>
        </tr>
    </table>
</section>

<section class="barra-lateral-derecho">
    <table>
        <tr class="conlatder"><td id="repauto"><h2 id="h2repauto">Reproduccion automatica</h2><input id="reproduauto" name="reproduccion" type="checkbox"></td></tr>
        <?php
            $t = base64_decode($_REQUEST["t"]);
            $archivo = 0;
            for ($i=0; $i < 256; $i++) { 
                $archivo= "series/".$s."/Capitulo ".$i.".mp4";
                for ($t=0; $t < count($extvid); $t++) {
                    $comprobar = "series/".$s."/Capitulo ".$i.".".$extvid[$t];
                    if (file_exists($comprobar)) {
                        $archivo = $comprobar;
                    }
                }
                $archivoimg;
                for ($a=0; $a < count($extimg); $a++) {
                    $comprobar = "series/".$s."/Capitulo ".$i.".".$extimg[$a];
                    if (file_exists($comprobar)) {
                        $archivoimg = $comprobar;
                    }
                }
                if (file_exists($archivo)) {
                    echo '<tr class="conlatder" onclick="document.location = '."'".'video-serie?s='.$_REQUEST['s'].'&v='.base64_encode('Capitulo '.$i).'&t='.$_REQUEST['t']."'".';" title="'."Capitulo ".$i.'"><td><a><img src="'.$archivoimg.'?v='.$version.'"></a></td> <td><a><h2 class="titulos">'.$s.' - '."Capitulo ".$i.'</h2></a></td></tr>';
                } 
            }
        ?>
    </table>
    <script type="text/javascript">
        <?php include "nom_listas.php"; $t = base64_decode($_REQUEST["t"]); echo "localStorage.setItem('scv".$s.$v."', 'si');"; ?>
        var prioridad = (document.cookie.indexOf('prioridad_usuario=') === -1 ? '' : ("; " + document.cookie).split('; prioridad_usuario=')[1].split(';')[0]);
        <?php
            $v = $_REQUEST['v'];
            $s = $_REQUEST['s'];
            $t = $_REQUEST['t'];
            echo " var cambioURL = setInterval( function () { localStorage.setItem('cambioURL', 'si'); localStorage.setItem('URL_Enviada', 'index?s=".$s."&i=".$v."&t=".$t."');}, 50);
            setTimeout('clearInterval(cambioURL)', 100);";
        ?>
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
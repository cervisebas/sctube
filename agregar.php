<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agregar Video</title>
	<style type="text/css">
		div {
			text-align: center;
			background: #01DF3A;
		}
		form {
			margin-left: auto;
			margin-right: auto;
			width: 60%;
			text-align: center;
			margin-top: 15px;
		}
		input[type="text"], input[type="file"] {
			display: block;
			margin-left: auto;
			margin-right: auto;
			margin-top: 15px;
			/*margin-bottom: 15px;*/
			width: 90%;
			height: auto;
			text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid #fff;
			color: #000;
			background: #fff;
			height: 30px;
		}
		button {
			display: block;
			margin-left: auto;
			margin-right: auto;
			margin-top: 15px;
			/*margin-bottom: 15px;*/
			width: 10%;
			height: auto;
			/*text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid #fff;
			color: #000;
			background: #fff;*/
			height: 30px;
			color: #fff;
			background: blue;
			text-align: center;
			border-radius: 30px 30px 30px 30px;
			border: 2px solid blue;
		}
		#button {
			color: #fff;
		}
		h1 {
			margin: 30px;
		}
		* {
			font-family: arial;
		}
		.espacio {
			width: 100%;
			height: 15px;
		}
		#textoimgauto {
			user-select: none;
			margin-top: 15px;
    		display: block;
    		padding-left: 15px;
    		text-indent: -15px;
		}
		#textoimgauto input {
			width: 13px !important;
    		height: 13px;
    		padding: 0;
    		margin:0;
    		vertical-align: bottom;
    		position: relative;
    		top: -2.6px;
    		overflow: hidden;
		}
		@media only screen and (orientation:portrait) {
			form { width: 100%; }
		  	input { width: 90%; }
		  	button { width: 70%; }
		}
		@media only screen and (orientation:landscape) {

		}
	</style>
	<script type="text/javascript">
        var temp = setInterval(compatibilidad, 25);
        function compatibilidad(argument) {
            var dispositivo = navigator.userAgent.toLowerCase();        
            if( dispositivo.search(/iphone|ipod|ipad|android|blackberry|windows phone/) > -1 ) {
                document.getElementById('form').style.width = "100%";
                document.getElementsByTagName('input')[0].style.width = "90%";
				document.getElementsByTagName('input')[1].style.width = "90%";
				document.getElementsByTagName('input')[2].style.width = "90%";
				document.getElementsByTagName('input')[3].style.width = "90%";
				document.getElementsByTagName('input')[4].style.width = "90%";
				document.getElementsByTagName('input')[5].style.width = "90%";
				document.getElementById('button').style.width = "70%";
            } else { 
                document.getElementById('form').style.width = "60%";
                document.getElementsByTagName('input')[0].style.width = "90%";
				document.getElementsByTagName('input')[1].style.width = "90%";
				document.getElementsByTagName('input')[2].style.width = "90%";
				document.getElementsByTagName('input')[3].style.width = "90%";
				document.getElementsByTagName('input')[4].style.width = "90%";
				document.getElementsByTagName('input')[5].style.width = "90%";
				document.getElementById('button').style.width = "10%";
            }
        }
    </script>
</head>
<body>
	<div id="contenido">
		<h1>Subir video</h1>
		<form enctype="multipart/form-data" method="POST" id="form" action="subir.php">
			<input type="text" name="titulo" placeholder="Titulo del video">
			<p>Archivo video</p>
			<input type="file" accept="video/*," name="archivo" id="archivo">
			<p>Archivo imagen</p>
			<input type="file" accept="image/*" name="imagen" id="imagen">
			<label id="textoimgauto"><input type="checkbox" id="checkbox"> Imagen Automatica</label>
			<input type="text" name="prioridad" placeholder="Prioridad">
			<input type="text" name="genero" placeholder="Genero">
			<input type="text" name="cuenta" id="cuenta" style="display: none;">
		</form>
		<script type="text/javascript">
			document.getElementById('cuenta').value = localStorage.getItem('nombre_sctube');
		</script>
		<div class="espacio"></div>
		<center><h3 id="progreso" style="display: none;"> </h3></center><br>
		<center><progress id="progressBar" value="0" max="100" style="width: 50%; display: none;"></progress></center>
		<div class="espacio" style="display: none;"></div>
		<button id="button" onclick="uploadFile(); mostrarprogreso();">Subir</button>
		<button onclick="document.location = 'agregarserie.php'">Agregar serie</button>
		<script>
			function _(el){
				return document.getElementById(el);
			}
			var checkbox = _('checkbox');
			checkbox.addEventListener("change", function () {
				var checked = checkbox.checked;
				if (checked) {
					_("imagen").disabled = 1;
					_("imagen").style.background = "#727272";
				} else {
					_("imagen").disabled = 0;
					_("imagen").style.background = "#FFF";
				}
			}, false);
			function uploadFile(){
				var form = document.getElementById('form');
				if (window.XMLHttpRequest) {
					var ajax = new XMLHttpRequest();
				} else {
					var ajax = new ActiveXObject("Microsoft.XMLHTTP");
				}
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.addEventListener("load", completeHandler, false);
				ajax.open("POST", "subir.php");
				ajax.send(new FormData(form));
			}
			function progressHandler(event){
				var percent = (event.loaded / event.total) * 100;
				_("progressBar").value = Math.round(percent);
				_("progreso").innerHTML = "Subiendo: "+Math.round(percent)+"%";
			}
			function completeHandler() {
				localStorage.setItem('nopermitido', 'si');
                localStorage.setItem('mensaje', 'El contenido se ah subido y agregado correctamente');
				_("form").reset();
				_("progressBar").value = 0;
				_("progreso").innerHTML = "";
				_("progreso").style.display = "none";
				_("progressBar").style.display = "none";
				document.getElementsByClassName('espacio')[1].style.display = "none";
			}
			function mostrarprogreso() {
				_("progreso").style.display = "inline";
				_("progressBar").style.display = "inline";
				document.getElementsByClassName('espacio')[1].style.display = "block";
			}
		</script>
		<div class="espacio"></div>
	</div>
	<script type="text/javascript" src="js/mododark.js"></script>
</body>
</html>
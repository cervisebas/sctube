function historial(a) {

	var guardar = a;
	var guardados = 1;

	if (guardar == 0) {
		localStorage.setItem('video0', guardados);
	} else {
		if (guardar == 1) {
			localStorage.setItem('video1', guardados);
		} else {
			if (guardar == 2) {
				localStorage.setItem('video2', guardados);
			} else {
				if (guardar == 3) {
					localStorage.setItem('video3', guardados);
				} else {
					if (guardar == 4) {
						localStorage.setItem('video4', guardados);
					} else {
						if (guardar == 5) {
							localStorage.setItem('video5', guardados);
						}
					}
				}
			}
		}
	}
}


window.onload = function ver() {

	if ( localStorage.getItem("video0") == 1) {

		document.getElementById('video0').style.display = 'inline-flex';
		document.getElementById('mensaje').style.display = 'none';
	} else {

		document.getElementById('video0').style.display = 'none';
	}

	if ( localStorage.getItem("video1") == 1) {

		document.getElementById('video1').style.display = 'inline-flex';
		document.getElementById('mensaje').style.display = 'none';
	} else {
		
		document.getElementById('video1').style.display = 'none';
	}

	if ( localStorage.getItem("video2") == 1) {

		document.getElementById('video2').style.display = 'inline-flex';
		document.getElementById('mensaje').style.display = 'none';
	} else {
		
		document.getElementById('video2').style.display = 'none';
	}

	if ( localStorage.getItem("video3") == 1) {

		document.getElementById('video3').style.display = 'inline-flex';
		document.getElementById('mensaje').style.display = 'none';
	} else {
		
		document.getElementById('video3').style.display = 'none';
	}

	if ( localStorage.getItem("video4") == 1) {

		document.getElementById('video4').style.display = 'inline-flex';
		document.getElementById('mensaje').style.display = 'none';
	} else {
		
		document.getElementById('video4').style.display = 'none';
	}

	if ( localStorage.getItem("video5") == 1) {

		document.getElementById('video5').style.display = 'inline-flex';
		document.getElementById('mensaje').style.display = 'none';

	} else {
		
		document.getElementById('video5').style.display = 'none';
	}
}

function borrar() {

	var cero = 0;

	localStorage.setItem('video0', cero);
	localStorage.setItem('video1', cero);
	localStorage.setItem('video2', cero);
	localStorage.setItem('video3', cero);
	localStorage.setItem('video4', cero);
	localStorage.setItem('video5', cero);

	location.reload();
}

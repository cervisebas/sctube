var dispositivo = navigator.userAgent.toLowerCase();
        
if( dispositivo.search(/iphone|ipod|ipad|android|blackberry/) > -1 ) {
	setTimeout('document.location ="celular/inicio.html";',5000);
} else { 
	setTimeout('document.location ="html/inicio.html";',5000);
}
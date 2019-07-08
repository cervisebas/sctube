// Variables.
var color;
var a=document.getElementsByClassName('colores');
var b=document.getElementsByClassName("content-table");
var c=document.getElementsByClassName("botones-color");
var d=document.getElementsByClassName("icono-color");
var elegido;
//color rojo.
function rojo() {
    for (var i=0; i<a.length; i++){ a[i].style.backgroundColor='#FE2E2E'; }
    color = '#FF0000';
    for (var i=0; i<b.length; i++) b[i].style.backgroundColor= 'rgba(255,0,0,0.8)';
    for (var i=0; i<c.length; i++) c[i].style.backgroundColor= color;
    for (var i=0; i<d.length; i++) d[i].style.backgroundColor= color;
    elegido = 'rojo';
    guardar();
}
//color azul
function azul() {
    for (var i=0; i<a.length; i++) a[i].style.backgroundColor='#2E64FE';
    color = '#0404B4';
    for (var i=0; i<b.length; i++) b[i].style.backgroundColor= 'rgba(0,8,255,0.8)';
    for (var i=0; i<c.length; i++) c[i].style.backgroundColor= color;
    for (var i=0; i<d.length; i++) d[i].style.backgroundColor= color;
    elegido = 'azul';
    guardar();
}
//color verde
function original() {
    for (var i=0; i<a.length; i++) a[i].style.backgroundColor='#01DF3A';
    color = '#00FF40';
    for (var i=0; i<b.length; i++) b[i].style.backgroundColor= 'rgba(135,234,82,0.8)';
    for (var i=0; i<c.length; i++) c[i].style.backgroundColor= color;
    for (var i=0; i<d.length; i++) d[i].style.backgroundColor= color;
    elegido = original;
    guardar();
}
//icono de munu mostrar/ocultar.
function ocultar(){
    setTimeout("document.getElementById('icono-color').style.display = 'none';",100);
}
function mostrar(){
    setTimeout("document.getElementById('icono-color').style.display = 'block';",100);
}


//Guarda el color.
function guardar(){
    localStorage.setItem("guardado", elegido);
}

window.onload = function carga(){

    var almacenado = localStorage.getItem("guardado");

    if (almacenado == null) {
        almacenado = [];
    } else {
        if (almacenado == 'rojo') {
            rojo();
        } else {
            if (almacenado == 'azul') {
                azul();
            } else {
                if (almacenado == 'original') {
                    original();
                }
            }
        }
    }
}

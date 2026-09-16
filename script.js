//###################//
//ELEMENTOS/VARIABLES//
//###################//
let botonInicio = document.getElementById("functionInicio");
let botonConocenos = document.getElementById("functionConocenos");
let botonTienda = document.getElementById("functionTienda");
let botonAgenda = document.getElementById("functionAgenda");

let content = document.getElementById("contenido");



//#########//
//FUNCIONES//
//#########//
function limpiar(contenido){
    contenido.style.display = "none";
}

function mostrar(contenido, forma) {
    contenido.style.display = forma;
}

function cargarInicio(contenido){
    fetch('PaginaPrincipal/Inicio/inicio.html')
        .then(function(respuesta){
            return respuesta.text();
        })
        .then(function(html){
            contenido.innerHTML = html;
        })
}

function cargarConocenos(contenido){
    fetch('PaginaPrincipal/Conocenos/conocenos.html')
        .then(function(respuesta){
            return respuesta.text();
        })
        .then(function(html){
            contenido.innerHTML = html;
        })
}

function cargarTienda(contenido){
    fetch('PaginaPrincipal/Tienda/tienda.html')
        .then(function(respuesta){
            return respuesta.text();
        })
        .then(function(html){
            contenido.innerHTML = html;
        })
}

function cargarAgenda(contenido){
    fetch('PaginaPrincipal/Agenda/agenda.html')
        .then(function(respuesta){
            return respuesta.text();
        })
        .then(function(html){
            contenido.innerHTML = html;
        })
}



//#######//
//EVENTOS//
//#######//
botonInicio.addEventListener("click", function(){
    limpiar(content);
    cargarInicio(content);
    mostrar(content, "block");
});

botonConocenos.addEventListener("click", function(){
    limpiar(content);
    cargarConocenos(content);
    mostrar(content, "block");
});

botonTienda.addEventListener("click", function(){
    limpiar(content);
    cargarTienda(content);
    mostrar(content, "block");
});

botonAgenda.addEventListener("click", function(){
    limpiar(content);
    cargarAgenda(content);
    mostrar(content, "block");
});
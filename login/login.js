const formularioLogin = document.getElementById("formularioLogin");
const formularioSignIn = document.getElementById("divSignIn");
const inputEmail = document.getElementById("inputEmail");
const inputPass = document.getElementById("inputPass");
const btnLogIn = document.getElementById("btnLogIn");
const btnSignIn = document.getElementById("btnSignIn");
const resultadoLogin = document.getElementById("resultadoLogin");

mostrar(formularioLogin, "flex");
ocultar(resultadoLogin);

btnLogIn.addEventListener("click", () => {
    tomaDeDatosLogin();
});

btnSignIn.addEventListener("click", () => {
    ocultar(formularioLogin);
    cargarSignIn(formularioSignIn);
    mostrar(formularioSignIn, "block");
});

function ocultar(contenido) {contenido.style.display = "none"}

function mostrar(contenido, forma) {contenido.style.display = forma;}

function tomaDeDatosLogin(){
    let email = inputEmail.value;
    let pass = inputPass.value;
    
    if (email === "" && pass === ""){
        mostrar(resultadoLogin, "block");
        resultadoLogin.style.color = "var(--rojo-warning-texto)";
        inputEmail.style.borderColor = "var(--rojo-warning-input)";
        inputPass.style.borderColor = "var(--rojo-warning-input)";
    } else {
        alert("Gracias por iniciar sesion...");
    }
}

function cargarSignIn(contenido){
    fetch('signIn/signIn.html')
        .then(function(respuesta){
            return respuesta.text();
        })
        .then(function(html){
            contenido.innerHTML = html;
        })
}
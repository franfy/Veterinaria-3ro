const formularioLogin = document.getElementById("containerLogin");
const iframeSignin = document.getElementById("iframeSignin");

const btnSignin = document.getElementById("btnSignin");

formularioLogin.style.display = "block";

btnSignin.addEventListener( "click", () => {
    formularioLogin.style.display = "none";
    iframeSignin.style.display = "block";
});
<?php

$con = mysqli_connect('localhost','root','','VeterinariaElSabia');
//La variable $con guarda el objeto retornado por mysqli_connect()
$con -> set_charset("utf8");
//El operador -> sirve para acceder a un metodo/atributo de un objeto, por eso dice set_charset();

$email = $_POST['inputEmail'];
$pass = $_POST['inputPass'];
//Variables que almacenan el valor ingresado en los input de HTML via metodo POST

$sentencia = "SELECT * FROM usuarios WHERE email = '$email' AND contraseña = '$pass'";
//Script de sql para la base de datos
$rs = mysqli_query($con, $sentencia);
//La variable $rs (ResultSet) prepara la coneccion a la base de datos

if (mysqli_num_rows($rs) == 1) {
    session_start();
    header('Location: panelAdmin.html');
    exit();
} else {
    echo "Papanatas";
}

?>
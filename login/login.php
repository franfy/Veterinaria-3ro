<?php

$con = mysqli_connect('localhost','root','','VeterinariaElSabia');
$con -> set_charset("utf8");

$email = $_POST['inputEmail'];
$pass = $_POST['inputPass'];

$sentencia = "SELECT * FROM usuarios WHERE email = '$email' AND contraseña = '$pass'";
$rs = mysqli_query($con, $sentencia);

if(mysqli_num_rows($rs) == 1) {
    session_start();
    header('Location: panelAdmin.html');
    exit();
} else {
    echo "Puto";
}

echo "Hola mundo " . $email . " " . $pass;

?>
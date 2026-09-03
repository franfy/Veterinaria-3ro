<?php
  include "conection.php";
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];
  $query = "SELECT * FROM persona WHERE Email = '$usuario' AND Contrasenia = '$contrasena'";
  $resultado = mysqli_query($con, $query);

  if (mysqli_num_rows($resultado) == 1) {
    // Inicio de sesión exitoso
    session_start();
    header('Location: index.html');
    exit();
  } else {
    // Credenciales incorrectas
    echo '<script>alert("Usuario o contraseña incorrectos"); window.location.href = "ingresar.html";</script>';
  }
  
?>
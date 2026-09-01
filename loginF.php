<?php

require "conexion.php";

$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];

if ($usuario == "funcionario" && $contrasena == "1234") {

    header("Location: funcionario.php");
    exit();

} else {

    echo "Usuario o contraseña incorrectos.";

}

?>
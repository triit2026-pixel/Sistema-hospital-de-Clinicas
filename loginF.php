<?php
require "conexion.php";

$usuario = $_POST["usuario"] ?? '';
$contrasena = $_POST["contrasena"] ?? '';

try {
    
    $sql = "SELECT * FROM funcionarios WHERE usuario = :usuario AND activo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['usuario' => $usuario]);
    $funcionario = $stmt->fetch();


    if ($funcionario && $contrasena === $funcionario['contrasena']) {
        session_start();
        $_SESSION['usuario'] = $funcionario['nombre'];
        $_SESSION['rol'] = $funcionario['rol'];

     
        header("Location: funcionario.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
        echo '<br><a href="loginF.html">Volver</a>';
    }

} catch (PDOException $e) {
    echo "Error en el sistema: " . $e->getMessage();
}
?>

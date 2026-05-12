<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    $estado = 'activo';

    $query = "INSERT INTO usuarios (nombre_usuario, contrasena, rol, estado) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $usuario, $password, $rol, $estado);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: registro.php?success=1");
    } else {
        header("Location: registro.php?error=1");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>

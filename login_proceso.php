<?php
session_start();
include('conexion.php');

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Usamos una consulta preparada para mayor seguridad
$query = "SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ? AND estado = 'activo'";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "ss", $usuario, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['id_usuario'] = $row['id_usuario'];
    $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
    $_SESSION['rol'] = $row['rol'];
    header("Location: home.php");
} else {
    header("Location: index.php?error=1");
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
// Módulo de acceso
